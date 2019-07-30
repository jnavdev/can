<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class)->withTimestamps();
    }

    public function deals()
    {
        return $this->belongsToMany(Deal::class)->withTimestamps();
    }
}
