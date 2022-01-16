@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a>   </li>
            <li class="active" >@lang('site.users') </li>
        </ol>

        <h3 class="card-title">@lang('site.users')</h3>

        <form action="">
            <div class="row">

                <div class="col-md-4">
                    <input type="text" name="Search" class="form-control" placeholder=@lang('site.search')>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" style="padding:0px 10px"></i>@lang('site.search')</button>
                    <a href="{{route('dashboard.users.create')}}" class="btn btn-primary" > <i class="fa fa-plus" style="padding:0px 10px"></i> @lang('site.add') </a>
                </div>

            </div>
        </form>

    </section>

    <section class="content">

        <div class="card card-primary">
            <div class="card-header">
            </div><!-- end card-header -->

            <div class="card-body">

                @if ($users->count()>0)
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>@lang('site.first_name')</th>
                        <th>@lang('site.last_name')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.action')</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $index=>$user)
                        <tr>
                            <td>{{$index}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{route('dashboard.users.edit',$user->id)}}">@lang('site.edit')</a>
                                <form action="{{route('dashboard.users.destroy',$user->id)}}" method="POST" style="display: inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">@lang('site.delete')</button>
                                </form>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                  <h2>@lang('site.no_data_found')</h2>
                @endif


            </div><!-- end card-body -->
        </div>




    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection('content')
