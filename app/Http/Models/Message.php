<?php

namespace App\Http\Models;

use App\Http\Notifications\Types\Email;
use App\Http\Notifications\Types\Push;
use App\Http\Notifications\Types\Sms;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'channel_id',
        'message'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    /**
     * @param int $categoryId
     * @param string $message
     * @return \Illuminate\Support\Collection
     */
    public static function Send(int $categoryId, string $message){
        /** @var $logs */
        $logs = collect();
        /** @var Category $category */
        $category =  Category::FindOrFail($categoryId);
        /** @var Collection $users */
        $users = $category->users;
        $users->each(function(User $user) use ($categoryId, $message, $logs){
            /** @var array $logInfo */
            $logInfo = [
                'category_id' => $categoryId,
                'user_id' => $user->id,
                'message' => $message,
            ];
            /** @var Collection $channel */
            $channel = $user->channels;
            $channel->each(function(Channel $channel) use ($message, $logInfo, $logs){
                $logInfo['channel_id'] = $channel->id;
                /** @var Message $log */
                $log = self::create($logInfo);
                $logs->add($log);
                $log->NotifyByChannel();
            });
        });
        return $logs;
    }

    /**
     * @return bool|void
     */
    public function NotifyByChannel(){
        switch ($this->channel->id){
            case 1:
                return Sms::notificate($this->message);
            case 2:
                return Email::notificate($this->message);
            case 3:
                return Push::notificate($this->message);
        }
    }
}
