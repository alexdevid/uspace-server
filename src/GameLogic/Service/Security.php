<?php

namespace App\GameLogic\Service;

use App\Entity\User;
use App\GameLogic\DataTransfer\RequestInterface;
use App\GameLogic\DataTransfer\ResponseInterface;
use App\GameLogic\DataTransfer\Security\AuthRequest;
use App\GameLogic\DataTransfer\Security\LoginRequest;
use App\GameLogic\DataTransfer\Security\LoginResponse;
use App\GameLogic\Exception\ActionNotFoundException;
use App\GameLogic\Exception\TokenNotValidException;
use App\GameLogic\Exception\WrongCredentialsException;
use App\GameLogic\GameServiceInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class Security implements GameServiceInterface
{
    private const ACTION_LOGIN = 'login';
    private const ACTION_AUTH = 'auth';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UserRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UserRepository $repository, EntityManagerInterface $em)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @param string $action
     * @param RequestInterface|null $request
     * @return ResponseInterface|null
     *
     * @throws ActionNotFoundException
     * @throws WrongCredentialsException
     * @throws TokenNotValidException
     */
    public function run(string $action, RequestInterface $request = null): ResponseInterface
    {
        switch ($action) {
            case self::ACTION_LOGIN:
                return $this->login($request->getUsername(), $request->getPassword());
            case self::ACTION_AUTH:
                return $this->auth($request->getToken());
        }

        throw new ActionNotFoundException(sprintf("Action `%s` was not found in service `security`", $action));
    }

    /**
     * @param string $token
     * @return LoginResponse
     *
     * @throws TokenNotValidException
     */
    public function auth(string $token): LoginResponse
    {
        $user = $this->repository->findOneBy(['token' => $token]);
        if (!$user) {
            throw new TokenNotValidException(sprintf("token not valid `%s`", $token));
        }

        return $this->authorizeAndGetResponse($user);
    }

    /**
     * @param string $username
     * @param string $password
     * @return LoginResponse
     *
     * @throws WrongCredentialsException
     */
    public function login(string $username, string $password): LoginResponse
    {
        $user = $this->repository->findOneBy(['username' => $username]);
        if (!$user) {
            throw new WrongCredentialsException(sprintf("invalid username %s", $username));
        }
        if (!$this->passwordEncoder->isPasswordValid($user, $password)) {
            throw new WrongCredentialsException("wrong credentials");
        }

        return $this->authorizeAndGetResponse($user);
    }

    private function authorizeAndGetResponse(User $user): LoginResponse
    {
        $user->setToken($this->generateToken());
        $this->em->persist($user);
        $this->em->flush();

        return new LoginResponse($user);
    }

    /**
     * @return string
     */
    private function generateToken(): string
    {
        $time = \DateTime::createFromFormat(DATE_ATOM, 'now');

        return sha1($time);
    }

    /**
     * @param string|null $action
     * @return string
     */
    public function getRequestClass(string $action = null): string
    {
        return $action === self::ACTION_LOGIN ? LoginRequest::class : AuthRequest::class;
    }
}
