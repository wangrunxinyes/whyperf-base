<?php

namespace App\JsonRpc\Demo;

use Hyperf\JsonRpc\TcpServer;
use Hyperf\Server\Event;
use Hyperf\Server\Server;
use Whyperf\Rpc\Annotation\AbstractMicroService;

/**
 * rpc-http protocol demo
 * @Annotation
 * @Target({"CLASS"})
 */
class DemoMS extends AbstractMicroService {

    function getHost(): string
    {
        return "127.0.0.1";
    }

    function getPort(): int
    {
        return "9503";
    }

    function getName(): string
    {
        return "DemoMS";
    }

    function getRegistry(): array
    {
        return [];
    }

    function getProtocol(): string
    {
        return self::PROTOCOL_HTTP;
    }


    function getHostList(): array
    {
        return [];
    }

    static function isDisabled(): bool
    {
        return false;
    }

    function getCallBacks(): array
    {
        return [
//            Event::ON_RECEIVE => [\App\JsonRpc\Demo\Server\DemoMSServer::class, 'onReceive'],
            Event::ON_REQUEST => [\App\JsonRpc\Demo\Server\DemoMSServer::class, 'onRequest'],
        ];
    }
}