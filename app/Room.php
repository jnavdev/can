<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'deal_id'
    ];

	protected $dates = [
        'deleted_at'
    ];

    public function deal()
    {
    	return $this->belongsTo(Deal::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
