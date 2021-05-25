<?php

namespace App\JsonRpc\DemoTwo;

use App\JsonRpc\Demo\Server\DemoMSServer;
use Hyperf\Server\Event;
use Hyperf\Server\Server;
use Whyperf\Rpc\Annotation\AbstractMicroService;

/**
 * rpc-tcp protocol demo
 * @Annotation
 * @Target({"CLASS"})
 * @package App\JsonRpc\DemoTwo
 * @author WANG RUNXIN
 */
class DemoTwo extends AbstractMicroService{

    function getRegistry(): array
    {
        return [];
    }

    function getName(): string
    {
        return "DemoTwo";
    }

    function getHost(): string
    {
        return "127.0.0.1";
    }

    function getProtocol(): string
    {
//        return self::PROTOCOL_HTTP;
        return self::PROTOCOL_HTTP;
    }

    function getPort(): int
    {
        return "9504";
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
//            Event::ON_RECEIVE => [\App\JsonRpc\DemoTwo\Server\DemoTwoServer::class, 'onReceive'],
            Event::ON_REQUEST => [\App\JsonRpc\DemoTwo\Server\DemoTwoServer::class, 'onRequest'],
        ];
    }
}

