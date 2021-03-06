@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>@lang('site.products')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a></li>
            <li><a href="{{route('dashboard.products.index')}}">@lang('site.products')</a></li>
            <li class="active">@lang('site.update')</li>
        </ol>

        <h3 class="card-title">@lang('site.update')</h3>

    </section>

    <section class="content">
        @include('partials._errors')
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
                <form action="{{route('dashboard.products.update' ,$product )}}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                    @csrf
                    @method('put')


                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label for="{{$locale}}[name]">@lang('site.'.$locale.'.name')</label>
                            <input type="text" name="{{$locale}}[name]" value="{{$product->translate($locale)->name}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="{{$locale}}[description]">@lang('site.'.$locale.'.description')</label>
                            <textarea  name="{{$locale}}[description]"  class="form-control ckeditor" >{{ $product->description }}</textarea>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label for="category_id">@lang('site.category')</label>
                        <select type="text" name="category_id" class="form-control" value="{{$product->category_id}}">
                            <option value="">@lang('site.categories')</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="purchase_price">@lang('site.purchase_price')</label>
                        <input type="text" step="0.01" name="purchase_price"  class="form-control" value="{{$product->purchase_price}}">
                    </div>

                    <div class="form-group">
                        <label for="sale_price">@lang('site.sale_price')</label>
                        <input type="text" step="0.01" name="sale_price" class="form-control" value="{{$product->sale_price}}">
                    </div>


                    <div class="form-group">
                        <label for="stock">@lang('site.stock')</label>
                        <input type="text" step="0.01"  name="stock" class="form-control" value="{{$product->stock}}">
                    </div>


                    <div class="form-group">
                        <label for="image">@lang('site.image')</label>
                        <input type="file" name="image"  class="form-control image" value="{{$product->image}}">
                    </div>

                    <div class="form-group">
                        <img src="{{asset($product->image_path)}}" alt="" style="width: 100px" class="img-thumbnail image-preview">
                    </div>

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>@lang('site.edit')</button>
                    </div>

                </div>
                </form>
            </div>
    </section><!-- end of content -->
</div><!-- end of content wrapper -->

@endsection('content')
