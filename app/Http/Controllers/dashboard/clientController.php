<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class clientController extends Controller
{
    public function index(Request $request)
    {
        $clients= client::when($request->Search,function($q1) use($request){
            return $q1->where('name','like','%'.$request->Search.'%')
            ->orwhere('phone','like','%'.$request->Search.'%')
            ->orwhere('address','like','%'.$request->Search.'%');
        })->latest()->paginate(5);
        return view('layouts.dashboard.clients.index',compact('clients'));
    }//end of index


    public function create()
    {
        return view('layouts.dashboard.clients.create');
    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'name'   =>  'required' ,
            'phone'  =>  'required | digits:11' ,
            'address'=>  'required' ,
        ]);

        client::create($request->all());

        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.clients.index');
    }//end of store

    public function show(client $client)
    {
        //
    }

    public function edit(client $client)
    {
        return view('layouts.dashboard.clients.edit',compact('client'));
    }

    public function update(Request $request, client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone'=>['required' , 'min:11' ],
            'address'=>'required',
        ]);

        $client->update($request->all());
        session()->flash('success',__('site.update_successfully'));
        return redirect()->route('dashboard.clients.index');
    }

    public function destroy(client $client)
    {
        $client->delete();
        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.clients.index');
    }
}
