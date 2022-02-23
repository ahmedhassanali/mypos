@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>@lang('site.clients')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a></li>
            <li><a href="{{route('dashboard.clients.index')}}">@lang('site.clients')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>

        <h3 class="card-title">@lang('site.add')</h3>

    </section>

    <section class="content">
        @include('partials._errors')
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
                <form action="{{route('dashboard.clients.store')}}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                    @csrf
                    @method('post')

                    <div class="form-group">
                    <label for="name">@lang('site.name')</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="address">@lang('site.address')</label>
                    <input type="text" name="address" value="{{old('address')}}" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="phone">@lang('site.phone')</label>
                    <input type="phone" name="phone" value="{{old('phone')}}" class="form-control">
                    </div>

                    </div>
                    </div>  <!-- ./card -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>@lang('site.add')</button>
                    </div>

                </div>
                </form>
            </div>
    </section><!-- end of content -->
</div><!-- end of content wrapper -->

@endsection('content')
