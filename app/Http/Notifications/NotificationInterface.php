<?php

namespace App\Http\Notifications;

/**
 * Interface Notification
 */
interface NotificationInterface
{
    function setConnection(ConnectionInterface $connection):void;

    function setMessage(string $text):void;

    function sendMessage():bool;
}
