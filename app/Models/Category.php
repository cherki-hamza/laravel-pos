<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{

    use Translatable;

    public $translatedAttributes = ['category_name'];

    protected $fillable = [
        'category_name',
    ];

    // relation between category and product ==> the category hase many products
    public function products(){
        return $this->hasMany(Product::class);
    }
}
