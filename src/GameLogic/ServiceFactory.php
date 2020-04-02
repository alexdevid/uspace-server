<?php

namespace App\GameLogic;

use App\GameLogic\DataTransfer\Request;
use App\GameLogic\DataTransfer\ResponseInterface;
use App\GameLogic\Exception\ServiceNotFoundException;
use App\GameLogic\Service\Security;
use App\Service\Serializer\Serializer;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class ServiceFactory
{
    private $services = [
        'security' => Security::class
    ];

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @param ContainerInterface $container
     * @param Serializer $serializer
     */
    public function __construct(ContainerInterface $container, Serializer $serializer)
    {
        $this->container = $container;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @return ResponseInterface
     * @throws ServiceNotFoundException
     */
    public function run(Request $request): ResponseInterface
    {
        $service = $this->container->get($this->services[$request->getService()]);
        if (!$service) {
            throw new ServiceNotFoundException(sprintf("service `%s` was not found", $request->getService()));
        }
        if ($service !== null && !$service instanceof GameServiceInterface) {
            throw new ServiceNotFoundException(sprintf("service `%s` was found but it does not implement `GameServiceInterface`", $request->getService()));
        }

        $serviceRequest = $this->serializer->deserialize(json_encode($request->getData()), $service->getRequestClass($request->getAction()));

        return $service->run($request->getAction(), $serviceRequest);
    }
}