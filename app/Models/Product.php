<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name','description'];

    protected $fillable = [
        'name','description','category_id','purchase_price','sale_price','stock' , 'image'
    ];

    // relation between category and product ==> the category hase many products
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // method for show the path of product image
    public function image_path(){

        return asset('public/assets/backend/images/products/'.$this->image);

    }

    // function to get profit of product
    public function profit_percent(){

        $profit = ($this->sale_price - $this->purchase_price);
        $profit_percent = ( ($profit*100)/$this->purchase_price );

        return number_format($profit_percent , 2);

    }

    // function to get profit of product
    public function profit(){

      return ($this->sale_price - $this->purchase_price);

    }
}
