@extends('adminlte::page')

@section('title', __('accounters.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('accounters.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
        </div>
        @include('layouts.back')
    </div>
</div>

@if ($message = Session::get('error'))
<div class="alert alert-danger col-md-4">
    <p>{{ __('accounters.user_create_error') }}</p>
</div>
@endif

<style>
   span.must {
      color     : red;
      font-size : 12px;
   }
</style>
<form action="{{ route('accounters.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('accounters.name') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('accounters.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('accounters.line_id') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="line_id" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('accounters.password') }} :<span class="must">{{ __('tables.password') }}</span></strong>
                <input type="password" name="password" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>
@endsection
