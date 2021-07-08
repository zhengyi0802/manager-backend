@extends('adminlte::page')

@section('title', __('voicesettings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('voicesettings.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('voicesettings.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('voicesettings.project') }} :</strong>
                {{ $voicesetting->project }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('voicesettings.keywords') }} :</strong>
                {{ $voicesetting->keywords }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('voicesettings.package') }} :</strong>
                {{ $voicesetting->package }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('voicesettings.link_url') }} :</strong>
                {{ $voicesetting->link_url }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('voicesettings.status') }} :</strong>
                {{ ($voicesetting->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </div>
         </div>
     </div>
@endsection
