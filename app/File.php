<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'fileable_id', 'fileable_type'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
