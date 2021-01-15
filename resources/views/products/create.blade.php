@extends('adminlte::page')

@section('title', __('products.title') )

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('products.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}">{{ __('tables.back') }}</a>
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

<form action="{{ route('products.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('products.type') }} : </strong>
                <select name="type_id">
                   @foreach($productTypes as $productType)
                   <option value="{{ $productType->id }}">{{ $productType->name }}</option>
                   @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('products.serialno') }} : </strong>
                <input type="text" name="serialno" class="form-control" placeholder="A1234567890">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('products.project') }} :</strong>
                <select name="proj_id">
                   <option value="0">--------</optiion>
                   @foreach($projects as $project)
                   <option value="{{ $project->id }}">{{ $project->name }}</option>
                   @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('products.mac_address') }}: </strong>
                <input type="text" name="mac_address" class="form-control" placeholder="11:22:33:44:55:66">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('products.status') }} :  </strong>
                <select name="status_id">
                   @foreach($productStatuses as $productStatus)
                   <option value="{{ $productStatus->id }}">{{ $productStatus->name }}</option>
                   @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>
@endsection
