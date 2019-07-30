<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

	protected $dates = [
        'deleted_at'
    ];

    public function clients()
    {
        return $this->hasMany(User::class);
    }
}
