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

    public function index(request $request)
    {
        if($request->Search){
            $categories= Category::whereTranslationLike('name' ,'%' .$request->Search. '%')
            ->latest()->paginate(5);
        }
        else{
            $categories = Category::latest()->paginate(5);
        }
        return view('layouts.dashboard.Categories.index',compact('categories'));
    }//end of index


    public function create()
    {
        return view('layouts.dashboard.Categories.create');

    }//end of Create


    public function store(Request $request)
    {
        $roles = [];

        foreach(config('translatable.locales') as $locale){

            $roles += [$locale . '.name' =>  ['required',Rule::unique('category_translations','name')]];

        }

        $request->validate($roles);

        Category::create($request->all());
        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
    }//end of store


    public function show(Category $category)
    {

    }//end of show


    public function edit(Category $category)
    {
        return view('layouts.dashboard.categories.edit',compact('category'));

    }//end of edit


    public function update(Request $request, Category $category)
    {

        $roles = [];

        foreach(config('translatable.locales') as $locale){

            $roles += [$locale . '.name' =>  ['required',Rule::unique('category_translations','name')->ignore($category->id,'category_id')]];

        }

        $request->validate($roles);

        $category->update($request->all());
        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.categories.index');

    }//end of update


    public function destroy(Category $category)
    {

        $category->delete();
        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');

    }//end of Destroy
}
