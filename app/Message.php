<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'message', 'user_id', 'room_id'
    ];

	protected $dates = [
        'deleted_at'
    ];

    public function formattedDate()
    {
        return date('d/m/Y G:i', strtotime($this->created_at));
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function room()
    {
    	return $this->belongsTo(Room::class);
    }

    public function messageNotifications()
    {
        return $this->hasMany(MessageNotification::class);
    }
}
