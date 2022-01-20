<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
    }//end of construct

    public function index()
    {

    }//end of index


    public function create()
    {

    }//end of Creat


    public function store(Request $request)
    {

    }//end of store


    public function show(Category $category)
    {

    }//end of show


    public function edit(Category $category)
    {

    }//end of edit


    public function update(Request $request, Category $category)
    {

    }//end of update


    public function destroy(Category $category)
    {

    }//end of Destroy
}
