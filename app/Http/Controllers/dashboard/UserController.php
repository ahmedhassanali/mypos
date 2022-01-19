<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:users_read'])  ->only('index');
        $this->middleware(['permission:users_update'])  ->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');
        $this->middleware(['permission:users_create'])   ->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->Search){
            $users= User::whereRoleIs('admin')->where('first_name' ,'like','%' .$request->Search. '%')
            ->orwhere('last_name' ,'like','%' .$request->Search. '%') ->latest()->paginate(3);
        }
        else{
            $users =User::whereRoleIs('admin')->latest()->paginate(3);
        }
        return view('layouts.dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.dashboard.users.create');
    }//end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request ->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required | confirmed',
        ]);
        $request_data = $request->except('password','image','password_confirmation','permissions');
        $request_data['password'] = bcrypt($request->password);

        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.users.index');

    }//end of store


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('layouts.dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request ->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        $request_data = $request->except(['permissions']);

        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
