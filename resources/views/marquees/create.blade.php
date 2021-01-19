@extends('adminlte::page')

@section('title', __('marquees.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('marquees.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('marquees.index') }}">{{ __('tables.back') }}</a>
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

<form action="{{ route('marquees.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.name') }} : </strong>
                <input type="text" name="name" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.type') }} : </strong>
                <select id="type" name="type" >
                    <option value="1" selected>{{ __('marquees.type_single') }}</option>
                    <option value="2">{{ __('marquees.type_project') }}</option>
                    <option value="3">{{ __('marquees.type_all') }}</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div name="project_group" id="project_group" class="form-group">
                <strong>{{ __('marquees.project') }} : </strong>
                <select id="proj_id" name="proj_id" >
                      <option value="0" selected>{{ __('marquees.project_none') }}</option>
                    @foreach($projects as $project)
                       <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div name="product_group" id="product_group" class="form-group">
                <strong>{{ __('marquees.serialno') }} : </strong>
                <select id="product_id" name="product_id" >
                       <option value="0" selected>{{ __('marquees.product_none') }}</option>
                    @foreach($products as $product)
                       <option value="{{ $product->id }}">{{ $product->serialno }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.content') }} : </strong>
                <input type="text" name="content" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.url') }} : </strong>
                <input type="text" name="url" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.status') }} : </strong>
                <input type="radio" name="status" value="1" checked>{{ __('tables.status_on') }}
                <input type="radio" name="status" value="0">{{ __('tables.status_off') }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>
@endsection
