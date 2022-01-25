@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a>   </li>
            <li class="active" >@lang('site.categories') </li>
        </ol>

        <h3 class="card-title">@lang('site.categories')</h3>

        <form action="{{route('dashboard.categories.index')}}" method="get">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="Search" class="form-control" placeholder=@lang('site.search') value="{{request()->Search}}">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" style="padding:0px 10px"></i>@lang('site.search')</button>
                    @if (auth()->user()->hasPermission('categories_create'))
                    <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary" > <i class="fa fa-plus" style="padding:0px 10px"></i> @lang('site.add') </a>
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
                @if ($categories->count()>0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.category')</th>
                            <th>@lang('site.products_count')</th>
                            <th>@lang('site.related_products')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $index=>$category)
                            <tr>
                                <td>{{$index +1}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->products->count()}}</td>
                                <td><a href="{{route('dashboard.products.index' ,['category'=>$category->id])}}" class="btn btn-info btn-sm">@lang('site.related_products')</a></td>
                                <td>
                                    @if (auth()->user()->hasPermission('categories_update'))
                                        <a class="btn btn-info btn-sm" href="{{route('dashboard.categories.edit',$category->id)}}"><i class="fa fa-edit" style="padding: 0 5px"></i>@lang('site.edit')</a>
                                    @else
                                        <button type="submit" class="btn btn-info btn-sm disabled"><i class="fa fa-edit" style="padding: 0 5px"></i>@lang('site.edit')</button>
                                    @endif

                                    @if (auth()->user()->hasPermission('categories_delete'))
                                        <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="POST" style="display: inline">
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
                    {{$categories->appends(request()->query())->links()}}
                    @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif
            </div><!-- end card-body -->
        </div>
    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection('content')
