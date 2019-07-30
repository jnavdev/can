<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'rut', 'full_name', 'email', 'password', 'profile_picture', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withTimestamps()->whereHas('deal', function ($query) {
            $query->where('deal_state_id', 2);
        });
    }

    public function messageNotifications()
    {
        return $this->hasMany(MessageNotification::class);
    }

    public function profilepicture()
    {
        if ($this->profile_picture == 'avatar.png') {
            return asset('uploads/users/avatar.png');
        } else {
            return asset("uploads/users/{$this->id}/{$this->profile_picture}");
        }
    }
}
