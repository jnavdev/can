<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageNotification extends Model
{
    protected $fillable = [
        'user_id', 'message_id', 'saw'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
