<?php

namespace App\GameLogic;

use App\GameLogic\DataTransfer\RequestInterface;
use App\GameLogic\DataTransfer\ResponseInterface;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
interface GameServiceInterface
{
    public function run(string $action, RequestInterface $request = null): ResponseInterface;
    public function getRequestClass(string $action = null): string;
}