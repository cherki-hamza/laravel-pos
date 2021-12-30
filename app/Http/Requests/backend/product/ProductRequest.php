<?php

namespace App\Http\Requests\backend\product;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $roles = [];
        $roles = [
                'category_id' => 'required',
                 'image' => 'mimes:png,jpg,jpeg',
                 'purchase_price'  => 'required',
                 'sale_price'  => 'required',
                 'stock'  => 'required',
                ];


        foreach(config('translatable.locales') as $locale){

            $roles += [$locale. '.name' => 'required|unique:product_translations,name'];
            $roles += [$locale. '.description' => 'required'];

         }

        return $roles;
    }
}
