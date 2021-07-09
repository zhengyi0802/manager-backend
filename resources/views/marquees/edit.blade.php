@extends('adminlte::page')

@section('title', __('marquees.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('marquees.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
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

    <form action="{{ route('marquees.update',$marquee->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('marquees.name') }} : </strong>
                    <input type="text" name="name" value="{{ $marquee->name }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                 <div class="form-group">
                     <strong>{{ __('marquees.type') }} : </strong>
                     <select id="type" name="type" >
                        <option value="1" {{ ($marquee->type==1) ? "selected" : null }}>{{ __('marquees.type_single') }}</option>
                        <option value="2" {{ ($marquee->type==2) ? "selected" : null }}>{{ __('marquees.type_project') }}</option>
                        <option value="3" {{ ($marquee->type==3) ? "selected" : null }}>{{ __('marquees.type_all') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div name="project_group" id="project_group" class="form-group">
                    <strong>{{ __('marquees.project') }} : </strong>
                    <select id="proj_id" name="proj_id" >
                          <option value="0" {{ ($marquee->proj_id == 0) ? "selected" : null }}>{{ __('marquees.project_none') }}</option>
                        @foreach($projects as $project)
                           <option value="{{ $project->id }}" {{ ($marquee->proj_id == $project->id) ? "selected" : null }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div name="product_group" id="product_group" class="form-group">
                    <strong>{{ __('marquees.serialno') }} : </strong>
                    <select id="product_id" name="product_id" >
                           <option value="0" {{ ($marquee->product_id==0) ? "selected" : null }}>{{ __('marquees.product_none') }}</option>
                        @foreach($products as $product)
                           <option value="{{ $product->id }}" {{ ($marquee->product_id==$product->id) ? "selected" : null }}>{{ $product->serialno }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('marquees.content') }} : </strong>
                    <input type="text" name="content" class="form-control" value="{{ $marquee->content }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                     <strong>{{ __('marquees.url') }} : </strong>
                    <input type="text" name="url" class="form-control" value="{{ $marquee->url }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ _('marquees.status') }} :  </strong>
                    <input type="radio" name="status" value="1" {{ ($marquee->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($marquee->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
