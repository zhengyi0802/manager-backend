@extends('adminlte::page')

@section('title', __('logmessages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('logmessages.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('logmessages.index') }}">{{ __('tables.back') }}</a>
        </div>
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

<form name="logform" action="{{ route('logmessages.store') }}" method="POST" onsubmit="addfields()" >
     @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" hidden>
                <strong>{{ __('logmessages.timestamp') }} :</strong>
                <input type="text" name="timestamp" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.version_code') }} :</strong>
                <input type="text" name="version_code" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.version_name') }} :</strong>
                <input type="text" name="version_name" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.android') }} :</strong>
                <input type="text" name="android" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.mac_eth') }} :</strong>
                <input type="text" name="mac_eth" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.mac_wifi') }} :</strong>
                <input type="text" name="mac_wifi" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.sn') }} :</strong>
                <input type="text" name="sn" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.data') }} :</strong>
                <textarea class="form-control" style="height:150px" name="data" ></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
     </div>
     <script>
         function addfields() {
             document.forms['logform']['timestamp'].value = Date.now();
             return true;
         }
     </script>
</form>
@endsection
