@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>@lang('site.users')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li><a href="{{route('dashboard.users.index')}}">@lang('site.users')</a></li>
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
                <form action="{{route('dashboard.users.store')}}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                    @csrf
                    @method('post')

                    <div class="form-group">
                    <label for="first_name">@lang('site.first_name')</label>
                    <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="last_name">@lang('site.last_name')</label>
                    <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="email">@lang('site.email')</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="image">@lang('site.image')</label>
                        <input type="file" name="email"  class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="password">@lang('site.password')</label>
                    <input type="password" name="password" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="password_confirmation">@lang('site.password_confirmation')</label>
                    <input type="password" name="password_confirmation" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">@lang('site.permissions')</label>
                        <div class="nav-tabs-custom">
                            @php
                              $models=['users','category','proudects'];
                              $map=['read','create','delete','update'];
                            @endphp

                              <ul class="nav nav-pills ml-auto p-2">
                                @foreach ($models as $index=>$model)
                                  <li class="{{$index==0 ? 'active' : ''}}"><a class="nav-link" href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a></li>
                                @endforeach
                              </ul>
                              <div class="tab-content">
                                @foreach ($models as $index=>$model)
                                <div class="tab-pane {{$index==0 ? 'active' : ''}}" id="{{$model}}">
                                    @foreach ($map as $index=>$m)
                                    <input type="checkbox" name='permissions[]' value= '{{$model."_".$m}}' class="form-check-input" id="{{$m}}">
                                    <label class="form-check-label"  for="{{$m}}">@lang('site.'.$m)</label>
                                    @endforeach
                                </div>
                                @endforeach
                              </div>
                          </div>
                          <!-- ./card -->
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>@lang('site.add')</button>
                    </div>

                </div>
                </form>
            </div>
    </section><!-- end of content -->
</div><!-- end of content wrapper -->

@endsection('content')
