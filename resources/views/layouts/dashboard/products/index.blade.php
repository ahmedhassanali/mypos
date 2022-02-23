@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a>   </li>
            <li class="active" >@lang('site.products') </li>
        </ol>

        <h3 class="card-title">@lang('site.products')</h3>

        <form action="{{route('dashboard.products.index')}}" method="get">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="Search" class="form-control" placeholder=@lang('site.search') value="{{request()->Search}}">
                </div>

                <div class="col-md-4">
                    <select name="category" class="form-control" placeholder=@lang('site.category') >
                        <option value="">@lang('site.categories')</option>
                        @foreach ($categories as $cat)
                        <option value="{{$cat->id}}" {{request()->category == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" style="padding:0px 10px"></i>@lang('site.search')</button>
                    @if (auth()->user()->hasPermission('products_create'))
                    <a href="{{route('dashboard.products.create')}}" class="btn btn-primary" > <i class="fa fa-plus" style="padding:0px 10px"></i> @lang('site.add') </a>
                    @else
                    <button type="submit" class="btn btn-primary  disabled"> <i class="fa fa-plus" style="padding:0px 10px"></i> @lang('site.add')</button>
                    @endif
                </div>
            </div>
        </form>

    </section>

    <section class="content">

        <div class="card card-primary">
            <div class="card-header">
            </div><!-- end card-header -->

            <div class="card-body">
                @if ($products->count()>0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.category')</th>
                            <th>@lang('site.purchase_price')</th>
                            <th>@lang('site.sale_price')</th>
                            <th>@lang('site.profit')</th>
                            <th>@lang('site.profit_percent')</th>
                            <th>@lang('site.stock')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $index=>$product)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$product->name}}</td>
                                <td>{!!$product->description!!}</td>
                                <td><img src="{{$product->Image_Path}}" alt="" style="width: 70px" class="img-thumbnail"></td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->purchase_price}}</td>
                                <td>{{$product->sale_price}}</td>
                                <td>{{$product->profit}}</td>
                                <td>{{$product->profit_percent . '%'}}</td>
                                <td>{{$product->stock}}</td>
                                <td>
                                    @if (auth()->user()->hasPermission('products_update'))
                                        <a class="btn btn-info btn-sm" href="{{route('dashboard.products.edit',$product->id)}}"><i class="fa fa-edit" style="padding: 0 5px"></i>@lang('site.edit')</a>
                                    @else
                                        <button type="submit" class="btn btn-info btn-sm disabled"><i class="fa fa-edit" style="padding: 0 5px"></i>@lang('site.edit')</button>
                                    @endif

                                    @if (auth()->user()->hasPermission('products_delete'))
                                        <form action="{{route('dashboard.products.destroy',$product->id)}}" method="POST" style="display: inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class=" delete btn btn-danger btn-sm"><i class="fa fa-trash" style="padding: 0 5px"></i>@lang('site.delete')</button>
                                        </form>
                                    @else
                                        <button type="submit" class=" btn btn-danger btn-sm disabled"><i class="fa fa-trash" style="padding: 0 5px"></i>@lang('site.delete')</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$products->appends(request()->query())->links()}}
                    @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif
            </div><!-- end card-body -->
        </div>
    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection('content')
