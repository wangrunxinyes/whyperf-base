<?php

namespace App\Datebase;

use Whyperf\MultiTenant\DbConnection\DbConnectionConfig;

class TenantDbConfig extends DbConnectionConfig {

    function __construct(string $name)
    {
        parent::__construct($name);
        $this->init();
    }

    function getDatebaseName(): string
    {
        // TODO: Implement getDatebaseName() method.
        return "tenant215_transaction";
    }

    function getUsername(): string
    {
        // TODO: Implement getUsername() method.
        return "tester";
    }

    function getPassword(): string
    {
        // TODO: Implement getPassword() method.
        return "test123";
    }

    function getHost(): string
    {
        // TODO: Implement getHost() method.
        return "nas.wangrunxin.com";
    }

    function init(){

    }
}