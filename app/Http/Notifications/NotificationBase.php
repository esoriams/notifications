<?php

namespace App\Http\Notifications;

use App\Http\Models\Channel;

class NotificationBase implements NotificationInterface
{
    use Notifiable;

    /**
     * @var Channel
     */
    protected Channel $notificationType;

    /**
     * @var int
     */
    protected int $notificationTypeId;

    /**
     * Get the notification type model
     * Set a new connection instance
     */
    public function __construct()
    {
        $this->notificationType = Channel::find($this->notificationTypeId);
        $this->setConnection(new Connection());
    }

    /**
     * @param string $message
     * @return bool
     */
    public static function notificate(string $message){
        /** @var  $notification */
        $notification = new static();
        $notification->setMessage($message);
        return $notification->sendMessage();
    }
}
