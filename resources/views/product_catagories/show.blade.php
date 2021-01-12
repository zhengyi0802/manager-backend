@extends('adminlte::page')

@section('title', __('product_catagories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('product_catagories.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('product_catagories.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('product_catagories.name') }} :</strong>
                {{ $productCatagory->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('product_catagories.description') }}:</strong>
                {{ $productCatagory->descriptions }}
            </div>
        </div>
     </div>
@endsection
