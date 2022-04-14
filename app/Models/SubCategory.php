<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function getCategory() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getAllDirections() {
        return $this->hasMany(SubCategoryDirection::class, 'sub_category_id');
    }
}