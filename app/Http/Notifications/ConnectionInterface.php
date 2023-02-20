<?php

namespace App\Http\Notifications;

interface ConnectionInterface
{
    function setMessage(string $message):void;

    function send():bool;
}
