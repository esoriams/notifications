<?php

namespace App\Http\Notifications\Types;

use App\Http\Notifications\NotificationBase;

class Sms extends NotificationBase
{
    /**
     * @var int
     */
    protected int $notificationTypeId = 1;
}
