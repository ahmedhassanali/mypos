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
        <form action="{{route('dashboard.users.store')}}" method="POST">
            @csrf
            @method('post')
            <label for="first_name">@lang('site.first_name')</label>
            <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control">

            <label for="last_name">@lang('site.last_name')</label>
            <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control">

            <label for="email">@lang('site.email')</label>
            <input type="email" name="email" value="{{old('email')}}" class="form-control">

            <label for="password">@lang('site.password')</label>
            <input type="password" name="password" class="form-control" >

            <label for="password_confirmation">@lang('site.password_confirmation')</label>
            <input type="password" name="password_confirmation" class="form-control" >

            <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>@lang('site.add')</button>


        </form>

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection('content')
