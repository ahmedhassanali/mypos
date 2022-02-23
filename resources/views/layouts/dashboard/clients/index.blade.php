@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a>   </li>
            <li class="active" >@lang('site.clients') </li>
        </ol>

        <h3 class="card-title">@lang('site.clients')</h3>

        <form action="{{route('dashboard.clients.index')}}" method="get">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="Search" class="form-control" placeholder=@lang('site.search') value="{{request()->Search}}">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" style="padding:0px 10px"></i>@lang('site.search')</button>
                    @if (auth()->user()->hasPermission('clients_create'))
                    <a href="{{route('dashboard.clients.create')}}" class="btn btn-primary" > <i class="fa fa-plus" style="padding:0px 10px"></i> @lang('site.add') </a>
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
                @if ($clients->count()>0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.address')</th>
                            <th>@lang('site.add_order')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($clients as $index=>$client)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->phone}}</td>
                                <td>{{$client->address}}</td>
                                @if(auth()->user()->hasPermission('orders_create'))
                                    <td><a href="{{route('dashboard.clients.orders.create',$client->id)}}" class="btn btn-primary btn-sm">@lang('site.add_order')</a></td>
                                @else
                                    <td><a href="" class="btn btn-primary btn-sm disabled">@lang('site.add_order')</a></td>
                                @endif
                                <td>
                                    @if (auth()->user()->hasPermission('clients_update'))
                                        <a class="btn btn-info btn-sm" href="{{route('dashboard.clients.edit',$client->id)}}"><i class="fa fa-edit" style="padding: 0 5px"></i>@lang('site.edit')</a>
                                    @else
                                        <button type="submit" class="btn btn-info btn-sm disabled"><i class="fa fa-edit" style="padding: 0 5px"></i>@lang('site.edit')</button>
                                    @endif

                                    @if (auth()->user()->hasPermission('clients_delete'))
                                        <form action="{{route('dashboard.clients.destroy',$client->id)}}" method="POST" style="display: inline">
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
                    {{-- {{$clients->appends(request()->query())->links()}} --}}
                    @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif
            </div><!-- end card-body -->
        </div>
    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection('content')
