@extends('adminlte::page')

@section('title', __('members.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('members.header') }}</h1>
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

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('members.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('members.introducer') }} : {{ __('tables.must') }}</strong>
                <input type="text" name="introducer" class="form-control">
            </div>
             <div class="form-group col-md-4">
                <strong>{{ __('members.name') }} : {{ __('tables.must') }}</strong>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('members.line_id') }} : {{ __('tables.must') }}</strong>
                <input type="text" name="line_id" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('members.phone') }} : {{ __('tables.must') }}</strong>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('members.address') }} : {{ __('tables.must') }}</strong>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('members.password') }} : {{ __('tables.must') }}</strong>
                <input type="text" name="password" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('members.pidnumbers') }} : {{ __('tables.must') }}</strong>
                <input type="text" name="pid" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('members.pid_image_1') }} : {{ __('tables.must') }}</strong>
                <input type="file" name="pid_image_1" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('members.pid_image_2') }} : {{ __('tables.must') }}</strong>
                <input type="file" name="pid_image_2" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('members.creadit_card') }} : {{ __('tables.must') }}</strong>
                <input type="text" name="creadit_card" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('members.creadit_expire') }} : {{ __('tables.must') }}</strong>
                <input type="date" name="creadit_expire" class="form-control">
            </div>
            <div class="form-group">
                <strong>{{ __('managers.memo') }}:</strong>
                <textarea class="form-control" style="height:150px" name="memo" ></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>
@endsection
