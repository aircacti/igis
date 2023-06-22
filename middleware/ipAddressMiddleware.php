<?php

namespace Middleware;

use \App\requestManager;
use \App\errorsManager;

class ipAddressMiddleware
{

    public function run()
    {
        $this->checkIpAddress();
    }

    public function checkIpAddress()
    {
        $requestManager = requestManager::getInstance();
        $errorsManager = errorsManager::getInstance();

        if ($requestManager->getUserIp() == "192.168.0.99") {
            $errorsManager->throw(900, 'Sorry but you are not welcome :(');
        }
    }
}
