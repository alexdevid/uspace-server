<?php

namespace App\Service;

use App\GameLogic\DataTransfer\SocketRequest;
use App\GameLogic\Exception\BadParametersException;
use App\GameLogic\ServiceFactory;
use App\Service\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class SocketServer implements MessageComponentInterface
{
    /**
     * @var \SplDoublyLinkedList
     */
    private $clients;

    /**
     * @var NetworkLogger
     */
    private $logger;

    /**
     * @var ServiceFactory
     */
    private $factory;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @param NetworkLogger $logger
     * @param ServiceFactory $factory
     * @param Serializer $serializer
     */
    public function __construct(NetworkLogger $logger, ServiceFactory $factory, Serializer $serializer)
    {
        $this->logger = $logger;
        $this->factory = $factory;
        $this->serializer = $serializer;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->logger->info(sprintf('new connection from: %s', $conn->resourceId));
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $this->logger->info(sprintf('message from: %s', $from->resourceId));
        $this->logger->info($msg);
        if (empty($msg)) {
            $this->logger->warning(sprintf('empty request'));

            return;
        }

        try {
            $message = $this->getDataTransferObject($msg);
            $this->logger->info($msg);

            $this->logger->info(sprintf('action: `%s`', $message->getMethod()));

            if (!$message->getService()) {
                throw new BadParametersException("service name was not recognized");
            }
            if (!$message->getAction()) {
                throw new BadParametersException("action name was not recognized");
            }

            $response = $this->factory->run($message);
            $from->send($this->serializer->serialize($response));
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $from->send($this->serializer->serialize([
                'error' => (new \ReflectionClass($e))->getShortName(),
                'message' => $e->getMessage()
            ]));
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $conn->send("Bye client!");
        foreach ($this->clients as $key => $conn_element) {
            if ($conn === $conn_element) {
                unset($this->clients[$key]);
                break;
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->send("Error : " . $e->getMessage());
        $conn->close();
    }

    /**
     * @param string $message
     * @return SocketRequest|null
     */
    private function getDataTransferObject(string $message): ?SocketRequest
    {
        return $this->serializer->deserialize($message, SocketRequest::class);
    }
}