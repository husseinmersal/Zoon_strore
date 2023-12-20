<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description', 'logo_image', 'status', 'cover_image'
    ];
        // Store hasMany Product relationship  

    public function products()
    {
        return $this->hasMany(Product::class,'store_id','id');
    }
}
