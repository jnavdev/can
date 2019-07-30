<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'name'
    ];

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class)->withTimestamps();
    }

    public function deals()
    {
        return $this->belongsToMany(Deal::class, 'purchase_deal')->withTimestamps();
    }
}
