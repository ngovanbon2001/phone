<?php

namespace App\Logging;

use Monolog\Logger;

class TelegramLogger
{
    public function __invoke(): Logger
    {
        return new Logger(config('app.name'), [new TelegramHandler()]);
    }
}
