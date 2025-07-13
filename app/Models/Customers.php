<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use SoftDeletes;
    protected $fillable = ['customer_name', 'phone', 'address'];

    public function orders()
    {
        return $this->hasMany(TransOrders::class, 'id_customer');
    }

    public function pickups()
    {
        return $this->hasMany(TransLaundryPickup::class, 'id_customer');
    }
}
