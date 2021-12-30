<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Laratrust\Laratrust;
use Laravolt\Avatar\Facade as Avatar;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

// pa migrate:fresh --seed

// avatar
//$avatar = Avatar::create('cherki hamza')->toBase64();

class UserController extends Controller
{

    // load permission for every user by role and by permission
    public function __construct()
    {
      $this->middleware(['permission:read_users'])->only('index');
      $this->middleware(['permission:create_users'])->only('create');
      $this->middleware(['permission:update_users'])->only('update');
      $this->middleware(['permission:delete_users'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // methode 1
        /* if($request->search){
            $users = User::Where('first_name' , 'like' , '%'.$request->search.'%')
                        ->orWhere('last_name' , 'like' , '%'.$request->search.'%')
                        ->get();
        }else{
            $users = User::WhereRoleIs('admin')->get();
        } */

        // methode 2
        $users = $users = User::WhereRoleIs('admin')->Where(function($q) use ($request){

                    return  $q->when($request->search , function($query) use ($request){

                            return $query->Where('first_name' , 'like' , '%'.$request->search.'%')
                                         ->orWhere('last_name' , 'like' , '%'.$request->search.'%');

                    });

        })->latest()->paginate(5);

        //Alert::success('Success Title', 'Success Message');

         //if($users){
            //notify()->success('Hello from '.Auth::user()->first_name.' developer web full stack');
            //smilify('success', 'Hello from '.Auth::user()->first_name.' developer web full stack');
            //toast('Hello from '.Auth::user()->first_name.' developer web full stack','success','top-right')->showCloseButton();
            // example:
           /* alert()->padding('70px')->width('720px')->question('Are you sure?','You won\'t be able to revert this!')
                  ->showCancelButton()
                  ->showConfirmButton()
                  ->focusConfirm(true)
                  //->iconHtml('<i class="far fa-thumbs-up"></i>');
                  ->iconHtml('<i class="far fa-credit-card"></i>'); */
            //toast('Hello from '.Auth::user()->first_name.' developer web full stack','info','top-right')->showCloseButton();
         //}


        return view('backend.dashboard.users.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('backend.dashboard.users.create' ,['users'=>$users]);
    }

    /** pa migrate:refresh --seed
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $role = $request->validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required|email|unique:users',
          'image' => 'image|mimes:png,jpg,gif,jpeg',
          'password' => 'required|confirmed',
          'permissions'  =>  'required|min:1',

       ]);

       $request_data = $request->except(['password','password_confirmation','permissions','image']);
       $request_data['password'] = bcrypt($request->password);

       //get the image with resize
       if($request->hasFile('image')){

        $image = Image::make($request->image)->resize(200, null, function ($constraint) {
              $constraint->aspectRatio();
        })
          ->save(public_path('assets/backend/images/users/' . $request->image->hashName()));

          $request_data['image'] = $request->image->hashName();


       }


       $user = User::create($request_data);
       $user->attachRole('admin');

       $user->syncPermissions($request->permissions);

       toast( __('words.add_successfoly'),'success','top-right')->showCloseButton();
       //Alert::success('Success Title', 'Success Message');


       return redirect()->route('users.index')->with('success' , __('words.add_successfoly'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //$user = User::where('id',$user->id)->first();
        return view('backend.dashboard.users.edit' , ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $role = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            //'image' => 'mimes:png,jpg,jpeg,gif',
            'email' => ['required', 'email' ,Rule::unique('users')->ignore($user->id),],
            'permissions'  =>  'required|min:1',
         ]);

         $request_data = $request->except(['permissions' , 'image']);

         //get the image with resize
       if($request->hasFile('image')){

           // check if user not has a default.png image from database
           if($user->image != 'default.png'){
            $img = Storage::disk('public_uploads')->delete('/users/'.$user->image);
           }

            $image = Image::make($request->image)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('assets/backend/images/users/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

       }


         $user->update($request_data);

         $user->syncPermissions($request->permissions);

         toast( 'the user '.$user->first_name.' '.__('words.updated_successfoly'),'success','top-right')->showCloseButton();


         return redirect()->route('users.index')->with('success' , __('words.updated_successfoly'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $img = false;

        if($user->image != 'default.png'){

           $img = Storage::disk('public_uploads')->delete('/users/'.$user->image);

        }

            $user->delete();



        //alert()->warning('The User '.__('words.deleted_successfoly'));


        return redirect()->route('users.index')->with('danger' , __('words.deleted_successfoly'));
    }
}
