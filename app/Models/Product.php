<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
'category_id','subcategory_id','size_id','color_id','stuff_id','name','stock','price','image','description',

    ];
        public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
      public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
     public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
    public function color(){
        return $this->belongsTo(Color::class,'color_id');
    }
    public function stuff(){
        return $this->belongsTo(Stuff::class,'stuff_id');
    }
     public function images(){
        return $this->hasMany(Productimages::class,'product_id');
    }
}
