<?php

namespace App\Http\Notifications\Types;

use App\Http\Notifications\NotificationBase;

class Email extends NotificationBase
{
    /**
     * @var int
     */
    protected int $notificationTypeId = 2;
}
