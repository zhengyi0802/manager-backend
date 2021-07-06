@extends('adminlte::page')

@section('title', __('products.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('products.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
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

    <form action="{{ route('products.update',$product->id) }}" method="POST">
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('products.type') }} :</strong>
                    <select name="type_id">
                        @foreach($productTypes as $productType)
                           <option value="{{ $productType->id }}" {{ ($productType->id == $product->type_id) ? "selected" : null }} >{{ $productType->name ?? '' }}</option
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('products.serialno') }} : </strong>
                    <input type="text" name="serialno" value="{{ $product->serialno }}" class="form-control">
                </div>
            </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('products.project') }} : </strong>
                    <select name="proj_id">
                           <option value="0" {{ ($product->proj_id == 0) ? "selected" : null }} >--------</option>
                        @foreach($projects as $project)
                           <option value="{{ $project->id }}" {{ ($project->id == $product->proj_id) ? "selected" : null }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('products.ether_mac') }} : </strong>
                    <input type="text" name="ether_mac" value="{{ $product->ether_mac }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('products.wifi_mac') }} : </strong>
                    <input type="text" name="wifi_mac" value="{{ $product->wifi_mac }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('products.status') }} : </strong>
                    <select name="status_id">
                        @foreach($productStatuses as $productStatus)
                           <option value="{{ $productStatus->id }}" {{ ($productStatus->id == $product->status_id) ? "selected" : null }}>{{ $productStatus->name }}</option>
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
