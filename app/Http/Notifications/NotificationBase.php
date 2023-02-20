<?php

namespace App\Http\Notifications;

use App\Http\Models\Message;
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
    public function __construct(array $info)
    {
        $this->notificationType = Channel::find($this->notificationTypeId);
        $this->setConnection(new Connection());
    }

    /**
     * Save log and set message in notification parameter.
     * @param array $info
     * @return void
     */
    function saveLog(array $info): void
    {
        // Set current notification type id
        if(!isset($info['notification_type_id'])){
            $info['notification_type_id'] = $this->notificationType->id;
        }
        Message::create($info);
        $this->setMessage($info['message']);
    }

    /**
     * @param array $info
     * @return bool
     */
    public static function notificate(array $info){
        /** @var  $notification */
        $notification = new static($info);
        $notification->saveLog($info);
        return $notification->sendMessage();
    }
}
