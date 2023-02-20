<?php

namespace App\Http\Notifications;

class Connection implements ConnectionInterface
{
    /**
     * @param string $message
     * @return void
     */
    function setMessage(string $message): void
    {
        // TODO: Implement setMessage() method.
    }

    /**
     * @return bool
     */
    function send(): bool
    {
        // TODO: Implement send() method. By now return true.
        return true;
    }
}
