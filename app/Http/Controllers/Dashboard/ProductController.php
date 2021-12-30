<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\product\ProductRequest;
use App\Http\Requests\backend\product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        // searsh query
        $products = Product::when($request->search , function($q) use($request){

           return $q->whereTranslationLike('name' , '%'. $request->search . '%');

        })->when($request->category_id , function($q) use ($request) {

           return $q->where('category_id' , $request->category_id);

        })->latest()->paginate(5);

        return view('backend.dashboard.products.index' , compact('products' , 'categories') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.dashboard.products.create' , compact('categories') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $request_data = [];
        $request_data = $request->except(['image']);

         //get the image and  resize and store to the products directory
       if($request->hasFile('image')){
        // make directory if not exist
        if(!is_dir(public_path('assets/backend/images/products'))) {

            mkdir(public_path('assets/backend/images/products'), 0777, true);
            //echo 'directory products created with success';
        }
        // make image and resize it and store it in to database
        $image = Image::make($request->image)->resize(200, null, function ($constraint) {
              $constraint->aspectRatio();
        })
          ->save(public_path('assets/backend/images/products/' . $request->image->hashName()));

          $request_data['image'] = $request->image->hashName();

       }else{
        $request_data['image'] = 'default-product.png';
       }



          Product::create($request_data);

          toast('the category '.__('words.add_successfoly'))->showCloseButton();

          return redirect()->route('products.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.dashboard.products.edit', ['product'=>$product , 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
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

            //$roles += [$locale. '.name' => 'required|unique:product_translations,name'];
            $roles += [$locale. '.name' =>  ['required' ,Rule::unique('product_translations' , 'name')->ignore($product->id , 'product_id')] ];
            $roles += [$locale. '.description' => 'required'];

         }
        $request->validate($roles);

        $request_data = [];
        $request_data = $request->except(['image']);

         //get the image and  resize and store to the products directory
       if($request->hasFile('image')){
        // make directory if not exist
        if(!is_dir(public_path('assets/backend/images/products'))) {

            mkdir(public_path('assets/backend/images/products'), 0777, true);
            //echo 'directory products created with success';
        }

        // check if image not default
        if($product->image != "default-product.png"){
            // delete the curent image
             Storage::disk('public_uploads')->delete('/products/'.$product->image);
             toast('the image '.__('words.deleted_successfoly'))->showCloseButton();
             // make image and resize it and store it in to database
             $image = Image::make($request->image)->resize(200, null, function ($constraint) {
             $constraint->aspectRatio();
        })
        ->save(public_path('assets/backend/images/products/' . $request->image->hashName()));

        $request_data['image'] = $request->image->hashName();
        }


       }

       $product->update($request_data);

          toast('the category '.__('words.updated_successfoly'))->showCloseButton();

          return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


}
