<?php

namespace App\Http\Controllers\dashboard\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\client;
use App\Models\order;
use Illuminate\Http\Request;

class orderController extends Controller
{

    public function index()
    {
        //
    }

    public function create(client $client)
    {
        $categories = Category::with('products')->get();
        return view('layouts.dashboard.clients.orders.create',compact('client','categories'));
    }


    public function store(Request $request,client $client)
    {
        dd($request->all());
    }


    public function show(order $order)
    {
        //
    }


    public function edit(order $order,client $client)
    {
        //
    }


    public function update(Request $request, order $order, client $client)
    {
        //
    }


    public function destroy(order $order,client $client)
    {
        //
    }
}
