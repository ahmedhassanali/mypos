<?php

namespace App\Http\Controllers\Dashboard;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{


    public function __construct()
    {
         $this->middleware('auth');

    }//end of construct

    public function index(Request $request)
    {
        $categories = Category::all();

        $products= product::when($request->Search,function($q1) use($request){
            return $q1->whereTranslationLike('name','%'.$request->Search.'%');
        })->when($request->category,function($q2) use($request){
            return $q2->where('category_id',$request->category);
        })->latest()->paginate(5);

        return view('layouts.dashboard.products.index',compact('products','categories'));
    }//end of index

    public function create()
    {
        $categories = Category::all();
        return view('layouts.dashboard.products.create',compact('categories'));
    }//end of create

    public function store(Request $request)
    {
        $roles = ['purchase_price' =>'required',
                  'sale_price'=>'required',
                  'stock'=>'required',
                  'category_id'=>'required',];

        foreach(config('translatable.locales') as $locale){
            $roles += [$locale . '.name' =>  ['required',Rule::unique('product_translations','name')]];
            $roles += [$locale . '.description' =>  ['required']];
        }

        $request->validate($roles);

        $request_data = $request->except('image');

        if($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/product_images/' . $request->image->hashName()));

        $request_data['image'] = $request->image->hashName();
        }

        product::create($request_data);
        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.products.index');
    }//end of stroe

    public function show(product $product)
    {

    }//end of show

    public function edit(product $product)
    {
        $categories = Category::all();
        return view('layouts.dashboard.products.edit',compact(['product','categories']));
    }//end of edit

    public function update(Request $request, product $product)
    {
        $roles = ['purchase_price' =>'required',
        'sale_price'=>'required',
        'stock'=>'required',
        'category_id'=>'required',];

        foreach(config('translatable.locales') as $locale){
        $roles += [$locale . '.name' =>  ['required',Rule::unique('product_translations','name')->ignore($product->id,'product_id')]];
        $roles += [$locale . '.description' =>  ['required']];
        }

        $request->validate($roles);

        $request_data = $request->except('image');

        if($request->image){
            if($request->image != 'default.png'){
                storage::disk('public_uploads')->delete('/product_images/'.$product->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
        })
        ->save(public_path('uploads/product_images/' . $request->image->hashName()));

        $request_data['image'] = $request->image->hashName();
        }

        $product->update($request_data);
        session()->flash('success',__('site.update_successfully'));
        return redirect()->route('dashboard.products.index');
    }//end of update

    public function destroy(product $product)
    {
        if($product->image != 'defult.png'){
            storage::disk('public_uploads')->delete('/product_images/'.$product->image);
        }

        $product->delete();
        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    } //end of Destroy
}
