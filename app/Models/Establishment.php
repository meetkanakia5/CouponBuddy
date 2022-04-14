<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    public function getCategory() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getSubCategory() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function getAllDirections() {
        return $this->hasMany(EstablishmentDirection::class, 'establishment_id');
    }
}
