<?php

namespace App\Http\Models;

class User extends \App\Models\User
{
    /**
     * The categories that belong to the user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    /**
     * The channels that belong to the user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function channels(){
        return $this->belongsToMany(Channel::class);
    }

    /**
     * The messages already sent sorted from newest to oldest.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages(){
        return $this->hasMany(Message::class)->orderBy('created_at', 'desc');
    }
}
