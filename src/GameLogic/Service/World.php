<?php

namespace App\GameLogic\Service;

use App\GameLogic\DataTransfer\RequestInterface;
use App\GameLogic\DataTransfer\ResponseInterface;
use App\GameLogic\DataTransfer\Worlds\WorldListRequest;
use App\GameLogic\DataTransfer\Worlds\WorldGetRequest;
use App\GameLogic\DataTransfer\Worlds\WorldResponse;
use App\GameLogic\DataTransfer\Worlds\WorldsListResponse;
use App\GameLogic\Exception\ActionNotFoundException;
use App\GameLogic\GameServiceInterface;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class World implements GameServiceInterface
{
    private const ACTION_LIST = "list";
    private const ACTION_GET = "get";

    /**
     * @param string $action
     * @param RequestInterface|null $request
     * @return ResponseInterface
     *
     * @throws ActionNotFoundException
     */
    public function run(string $action, RequestInterface $request = null): ResponseInterface
    {
        switch ($action) {
            case self::ACTION_GET:
                return $this->getWorld($request->id);
            case self::ACTION_LIST:
                return $this->getWorldList();
        }

        throw new ActionNotFoundException(sprintf("Action `%s` was not found in service `world`", $action));
    }

    /**
     * @param int $id
     * @return WorldResponse
     */
    private function getWorld(int $id): WorldResponse
    {
        return self::getWorldFixture($id);
    }

    /**
     * @return WorldsListResponse
     */
    private function getWorldList(): WorldsListResponse
    {
        $response = new WorldsListResponse();

        $response->worlds[] = self::getWorldFixture(1);
        $response->worlds[] = self::getWorldFixture(2);

        return $response;
    }

    /**
     * @param int $id
     * @return WorldResponse
     */
    private static function getWorldFixture(int $id): WorldResponse
    {
        $world1 = new WorldResponse();
        $world1->name = "Eva";
        $world1->id = 1;

        $world2 = new WorldResponse();
        $world2->name = "Adam";
        $world2->id = 2;

        return $id === 1 ? $world1 : $world2;
    }

    /**
     * @param string|null $action
     * @return string
     */
    public function getRequestClass(string $action = null): string
    {
        return $action === self::ACTION_LIST ? WorldListRequest::class : WorldGetRequest::class;
    }

}