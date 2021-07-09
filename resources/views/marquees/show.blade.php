@extends('adminlte::page')

@section('title', __('marquees.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('marquees.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('marquees.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.name') }} : </strong>
                {{ $marquee->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.type') }} : </strong>
                @if ($marquee->type == 1)
                    {{ __('marquees.type_single') }}
                @elseif ($marquee->type == 2) 
                    {{ __('marquees.type_project') }}
                @else
                    {{ __('marquees.type_all') }}
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.project') }} : </strong>
                {{ $marquee->project_name ?? __('marquees.project_none') }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.serialno') }} : </strong>
                {{ $marquee->serialno ?? __('marquees.product_none') }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.content') }} : </strong>
                {{ $marquee->content }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.url') }} : </strong>
                {{ $marquee->url }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('marquees.status') }}:</strong>
                {{ ($marquee->status==1) ? __('tables.status_on') : __('tables.status_off') }}
            </div>
        </div>
     </div>
@endsection
