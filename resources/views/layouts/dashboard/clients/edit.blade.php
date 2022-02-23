@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>@lang('site.clients')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a></li>
            <li><a href="{{route('dashboard.clients.index')}}">@lang('site.clients')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>

        <h3 class="card-title">@lang('site.edit')</h3>

    </section>

    <section class="content">
        @include('partials._errors')
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
                <form action="{{route('dashboard.clients.update',$client->id)}}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                    @csrf
                    @method('put')

                    <div class="form-group">
                    <label for="name">@lang('site.name')</label>
                    <input type="text" name="name" value="{{$client->name}}" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="phone">@lang('site.phone')</label>
                    <input type="text" name="phone" value="{{$client->phone}}" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="address">@lang('site.address')</label>
                    <input type="text" name="address" value="{{$client->address}}" class="form-control">
                    </div>
                          <!-- ./card -->
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary"  ><i class="fa fa-edit" style="padding: 0 10px"></i>@lang('site.update')</button>
                    </div>

                </div>
                </form>
            </div>
    </section><!-- end of content -->
</div><!-- end of content wrapper -->

@endsection('content')
