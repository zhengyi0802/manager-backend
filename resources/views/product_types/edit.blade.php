@extends('adminlte::page')

@section('title', __('product_types.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('product_types.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('product_types.index') }}">{{ __('tables.back') }}</a>
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

    <form action="{{ route('product_types.update',$productType->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('product_types.catagory') }}:</strong>
                    <select name="catagory_id" id="catagory_id">
                        @foreach($productCatagories as $productCatagory)
                           <option value="{{ $productCatagory->id }}" {{ ($productCatagory->id == $productType->catagory_id) ? "selected" : null }}>{{ $productCatagory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('product_types.name') }} :</strong>
                    <input type="text" name="name" value="{{ $productType->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('product_types.description') }} :</strong>
                    <textarea class="form-control" style="height:150px" name="descriptions" placeholder="Descriptions">{{ $productType->descriptions }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>狀態:  </strong>
                    <input type="radio" name="status" value="1" {{ ($productType->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($productType->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
