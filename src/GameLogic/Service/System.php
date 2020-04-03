<?php

namespace App\GameLogic\Service;

use App\GameLogic\DataTransfer\RequestInterface;
use App\GameLogic\DataTransfer\ResponseInterface;
use App\GameLogic\DataTransfer\System\SystemResponse;
use App\GameLogic\DataTransfer\Worlds\SystemGetRequest;
use App\GameLogic\Exception\ActionNotFoundException;
use App\GameLogic\Exception\DomainObjectNotFoundException;
use App\GameLogic\GameServiceInterface;
use App\Repository\SystemRepository;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class System implements GameServiceInterface
{
    private const ACTION_GET = "get";

    /**
     * @var SystemRepository
     */
    private $repository;

    /**
     * @param SystemRepository $repository
     */
    public function __construct(SystemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $action
     * @param RequestInterface|null $request
     * @return ResponseInterface
     *
     * @throws ActionNotFoundException
     * @throws DomainObjectNotFoundException
     */
    public function run(string $action, RequestInterface $request = null): ResponseInterface
    {
        switch ($action) {
            case self::ACTION_GET:
                return $this->getSystem($request->id);
        }

        throw new ActionNotFoundException(sprintf("Action `%s` was not found in service `world`", $action));
    }

    /**
     * @param int $id
     * @return SystemResponse
     *
     * @throws DomainObjectNotFoundException
     */
    public function getSystem(int $id): SystemResponse
    {
        $system = $this->repository->find($id);
        if (!$system) {
            throw new DomainObjectNotFoundException("system was not found");
        }

        return new SystemResponse($system);
    }

    /**
     * @param string|null $action
     * @return string
     */
    public function getRequestClass(string $action = null): string
    {
        return SystemGetRequest::class;
    }
}