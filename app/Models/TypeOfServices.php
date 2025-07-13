<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeOfServices extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'service_name',
        'price',
        'description'
    ];

    public function detail()
    {
        return $this->hasOne(TransOrderDetails::class, 'id_service');
    }
}
