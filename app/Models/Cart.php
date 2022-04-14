<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function getCoupon() {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
