<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    use HasFactory;
    protected $fillable=[
        'stuff'
    ];
    public function product(){
        return $this-> hasMany(product::class,'stuff_id');
    }
}
