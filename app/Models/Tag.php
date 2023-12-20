<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];
    public $timestamps = false;


    public function products()
    {
        return $this->belongsToMany(
            Product::class,  //related model
            'product_tag',  // pivote table name
            'tag_id',   //FK in pivot table of current model 
            'product_id',  //FK in pivot table of related model 
            'id',   // primary key of current model 
            'id'    // primary key of realated model 
        );
    }

}
