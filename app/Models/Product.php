<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'image', 'category_id',
        'store_id', 'price', 'compare_price', 'status'];


    // Product belognsTo Category relationship 
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Product belognsTo Store relationship 

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,  //related model
            'product_tag',  // pivote table name
            'product_id',   //FK in pivot table of current model 
            'tag_id',  //FK in pivot table of related model 
            'id',   // primary key of current model 
            'id'    // primary key of realated model 
        );
    }



    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
    }


    // Accessors

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://boschbrandstore.com/wp-content/uploads/2019/01/no-image.png';
        }
        if (Str::startsWith($this->image, ['https://', 'http://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }


    public function getSalePercentageAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }else{
            return intval(100 - (100 * $this->price / $this->compare_price));
        }
    }
}
