<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function getCategories() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getSubCategories() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
