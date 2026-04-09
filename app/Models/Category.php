<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];
    public function subCategories(){
        return $this->hasMany(SubCategory::class,'category_id');
    }
    public function product(){
        return $this-> hasMany(product::class,'category_id');
    }

}
