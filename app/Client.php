<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rut', 'full_name', 'address', 'activity', 'observation', 'phone', 'payment_method_id',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function paymentMethod()
    {
    	return $this->belongsTo(PaymentMethod::class);
    }

    public function deals()
    {
    	return $this->hasMany(Deal::class);
    }

    public function sales()
    {
    	return $this->hasMany(Sale::class);
    }
}
