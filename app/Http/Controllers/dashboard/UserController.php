<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:users_read']  )  ->only('index');
        $this->middleware(['permission:users_update'])  ->only('edit');
        $this->middleware(['permission:users_delete'])  ->only('destroy');
        $this->middleware(['permission:users_create'])  ->only('create');
    }//end of construct


    public function index(Request $request)
    {

        if($request->Search){
            $users= User::whereRoleIs('admin')->
            where('first_name' ,'like','%' .$request->Search. '%')
            ->orwhere('last_name' ,'like','%' .$request->Search. '%')
            ->latest()->paginate(3);
        }
        else{
            $users =User::whereRoleIs('admin')->latest()->paginate(3);
        }
        return view('layouts.dashboard.users.index',compact('users'));

    }//end of index


    public function create()
    {

        return view('layouts.dashboard.users.create');

    }//end of create


    public function store(Request $request)
    {

        $request ->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required | unique:users',
            'password' => 'required | confirmed',
            'image' => 'image',
            'permissions' => 'required | min:1',

        ]);
        $request_data = $request->except('password','image','password_confirmation','permissions');
        $request_data['password'] = bcrypt($request->password);

        if($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/user_images/' . $request->image->hashName()));

        $request_data['image'] = $request->image->hashName();
        }


        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.users.index');

    }//end of store



    public function edit(User $user)
    {

        return view('layouts.dashboard.users.edit',compact('user'));

    }//end of edit


    public function update(Request $request, User $user)
    {

        $request ->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id),],
            'image' => 'image',
            'permissions' => 'required | min:1',
        ]);
        $request_data = $request->except(['permissions']);


        if($request->image){
            if($user->image != 'defult.png'){
                storage::disk('public_uploads')->delete('/user_images/'.$user->image);
            }

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/user_images/' . $request->image->hashName()));

        $request_data['image'] = $request->image->hashName();
        }

        $user->update($request_data);
        $user->syncPermissions($request->permissions);


        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');

    } //end of update


    public function destroy(User $user)
    {

        if($user->image != 'defult.png'){
            storage::disk('public_uploads')->delete('/user_images/'.$user->image);
        }

        $user->delete();
        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');

    }//end of destroy
}
