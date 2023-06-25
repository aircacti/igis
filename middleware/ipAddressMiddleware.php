<?php

namespace Middleware;

use \App\requestManager;
use \App\exceptionManager;

class ipAddressMiddleware
{

    public function run()
    {
        $this->checkIpAddress();
    }

    public function checkIpAddress()
    {
        $requestManager = requestManager::getInstance();
        $exceptionManager = exceptionManager::getInstance();

        if ($requestManager->getUserIp() == "192.168.0.99") {
            $exceptionManager->throw(5000, 'Sorry but you are not welcome :(');
        }
    }
}
