<?php

namespace App\Http\Notifications\Types;

use App\Http\Notifications\NotificationBase;

class Push extends NotificationBase
{
    /**
     * @var int
     */
    protected int $notificationTypeId = 3;
}
