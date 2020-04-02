<?php

namespace App\Command;

use App\Service\SocketServer;
use Ratchet\Server\IoServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class ServerCommand extends Command
{
    protected static $defaultName = 'server:run';

    /**
     * @var SocketServer
     */
    private $server;

    /**
     * @param SocketServer $server
     */
    public function __construct(SocketServer $server)
    {
        parent::__construct(self::$defaultName);

        $this->server = $server;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $server = IoServer::factory($this->server, 8080);

        $server->run();
    }
}