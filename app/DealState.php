<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealState extends Model
{
    use SoftDeletes;

	protected $fillable = [
        'name', 'description',
    ];

	protected $dates = [
        'deleted_at'
    ];

    public function deals()
    {
    	return $this->hasMany(Deal::class);
    }
}
