<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**  pa migrate:fresh --seed
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->search,function($q) use ($request){

          return $q->whereTranslationLike('category_name' ,  '%'.$request->search.'%');

        })->latest()->paginate(5);

        return view('backend.dashboard.categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $role = $request->validate([
           'category' => 'required|unique:categories,category_name|min:3|max:30',
        ]); */

        $role = $request->validate([
            'en.category' => 'required|unique:category_translations,category_name|min:3|max:30',
            'fr.category' => 'required|unique:category_translations,category_name|min:3|max:30',
            'ar.category' => 'required|unique:category_translations,category_name|min:3|max:30',
         ]);



        if($role >0){
          $data = [
            'en'=> ['category_name' => $request->en['category']],
            'fr'=> ['category_name' => $request->fr['category']],
            'ar'=> ['category_name' => $request->ar['category']],
          ];

          Category::create($data);
          toast('the category '.__('words.add_successfoly'))->showCloseButton();
        }

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.dashboard.categories.edit' , compact('category') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        /* $role = $request->validate([
            'category' => 'required|unique:categories,category_name,'.$category->id.'|min:3|max:30',
         ]); */

         $roles = $request->validate([
            'en.category' => 'required|unique:category_translations,category_name,'.$category->id.'|min:3|max:30',
            'fr.category' => 'required|unique:category_translations,category_name,'.$category->id.'|min:3|max:30',
            'ar.category' => 'required|unique:category_translations,category_name,'.$category->id.'|min:3|max:30',
         ]);

         /* $roles = [];

         foreach(config('translatable.locales') as $locale){
            // $roles += [$locale. '.category_name' => 'required|unique:category_translations,category_name,'.$category->id.'|min:3|max:30'];

            $roles += [$locale. '.category' =>  ['required' ,Rule::unique('category_translations' , 'category')->ignore($category->id , 'category_id')] ];

         } */

         //$request->validate($roles);

         if($roles >0){
            $update_data = [
              'en'=> ['category_name' => $request->en['category']],
              'fr'=> ['category_name' => $request->fr['category']],
              'ar'=> ['category_name' => $request->ar['category']],
            ];
            $category->update($update_data);
            toast('the category '.__('words.updated_successfoly'))->showCloseButton();
        }
         /* if($role >0){
           $category->update(['category_name' => $request->category]);
           toast('the category '.__('words.updated_successfoly'))->showCloseButton();
         } */

         return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $result =  $category->delete();

       /*  if($result){
           alert()->warning('The User '.__('words.deleted_successfoly'));
        } */

        return redirect()->route('categories.index')->with('danger' , __('words.deleted_successfoly'));
    }
}
