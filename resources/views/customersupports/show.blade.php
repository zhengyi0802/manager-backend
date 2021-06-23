@extends('adminlte::page')

@section('title', __('customersupports.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('customersupports.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customersupports.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('customersupports.project') }} :</strong>
                {{ $customersupport->project }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('customersupports.qrcode_type') }} :</strong>
                @if ($customersupport->qrcode_type == "line")
                    {{ __('customersupports.type_line') }}
                @elseif ($customersupport->qrcode_type == "url")
                    {{ __('customersupports.type_url') }}
                @else
                    {{ __('customersupports.type_null') }}
                @endif
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('customersupports.qrcode_content') }} :</strong>
                {{ $customersupport->qrcode_content }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('customersupports.rcapp') }} :</strong>
                {{ $customersupports.rcapp }}
            </div>
         </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('customersupports.rcapp_url') }} :</strong>
                {{ $customersupports.rcapp_url }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('customersupports.status') }} :</strong>
                {{ ($customersupport->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </div>
         </div>
     </div>
@endsection
