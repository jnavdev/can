<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'title', 'creator_id', 'deal_state_id', 'client_id'
    ];

	protected $dates = [
        'deleted_at'
    ];

    public function creator()
    {
    	return $this->belongsTo(User::class, 'creator_id');
    }

    public function dealState()
    {
    	return $this->belongsTo(DealState::class);
    }

    public function client()
    {
    	return $this->belongsTo(Client::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function bills()
    {
        return $this->belongsToMany(Bill::class)->withTimestamps();
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_deal')->withTimestamps();
    }
}
