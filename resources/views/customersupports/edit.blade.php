@extends('adminlte::page')

@section('title', __('customersupportss.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('customersupports.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customersupports.index') }}">{{ __('tables.back') }}</a>
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

    <form action="{{ route('customersupports.update',$customersupport->id) }}" method="POST">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('customersupports.project') }} :</strong>
                    <select id="proj_id" name="proj_id">
                        @foreach($projects as $project)
                           <option value="{{ $project->id }}" {{ ($project->id == $customersupport->project_id) ? "selected" : null }} >{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('customersupports.qrcode_type') }} :</strong>
                    <select id="qrcode_type" name="qrcode_type">
                           <option value="line" {{ ($customersupport->qrcode_type == "line") ? "selected" : null }} >{{ __('customersupports.type_line') }}</option>
                           <option value="url" {{ ($customersupport->qrcode_type == "url") ? "selected" : null }} >{{ __('customersupports.type_url') }}</option>
                           <option value="null" {{ ($customersupport->qrcode_type == "null") ? "selected" : null }} > {{ __('customersupports.type_null') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('customersupports.qrcode_content') }} :</strong>
                    <input type="text" name="qrcode_content" value="{{ $customersupport->qrcode_content }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('customersupports.rcapp') }} :</strong>
                    <input type="text" name="rcapp" value="{{ $customersupport->rcapp }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('customersupports.rcapp_url') }} :</strong>
                    <input type="text" name="rcapp_url" value="{{ $customersupport->rcapp_url }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('customersupports.status') }} :</strong>
                    <input type="radio" name="status" value="1" {{ ($customersupport->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($customersupport->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
