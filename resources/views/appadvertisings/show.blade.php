@extends('adminlte::page')

@section('title', __('appadvertisings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appadvertisings.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('appadvertisings.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('appadvertisings.project') }} :</strong>
                {{ $appadvertising->project }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('appadvertisings.interval') }} :</strong>
                {{ $appadvertising->interval }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('appadvertisings.thumbnail') }} :</strong>
                <img src="{{ $appadvertising->thumbnail }}">
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('appadvertisings.link_url') }} :</strong>
                {{ $appadvertising->link_url }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('appadvertisings.status') }} :</strong>
                {{ ($appadvertising->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </div>
         </div>
     </div>
@endsection
