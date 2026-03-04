<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/helpers.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

function getLogger(string $channel = 'app'): Logger {
    static $loggers = [];

    if (!isset($loggers[$channel])) {
        $logger = new Logger($channel);

        $logger->pushHandler(new StreamHandler(
            __DIR__ . "/../logs/{$channel}.log",
            Logger::DEBUG
        ));

        $loggers[$channel] = $logger;
    }

    return $loggers[$channel];
}

?>