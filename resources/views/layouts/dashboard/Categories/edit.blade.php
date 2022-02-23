@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>@lang('site.categories')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a></li>
            <li><a href="{{route('dashboard.categories.index')}}">@lang('site.categories')</a></li>
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
                <form action="{{route('dashboard.categories.update',$category->id)}}" method="POST">
                    <div class="card-body">
                    @csrf
                    @method('put')



                    @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label for="{{$locale}}[name]">@lang('site.'.$locale.'.name')</label>
                        <input type="text" name="{{$locale}}[name]" value="{{$category->translate($locale)->name}}" class="form-control">
                        </div>
                    @endforeach


                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>@lang('site.edit')</button>
                    </div>

                </div>
                </form>
            </div>
    </section><!-- end of content -->
</div><!-- end of content wrapper -->

@endsection('content')
