<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'state', 'client_id', 'expiration_date'
    ];

	protected $dates = [
        'deleted_at', 'expiration_date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
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
        return $this->belongsToMany(Purchase::class)->withTimestamps();
    }
}
