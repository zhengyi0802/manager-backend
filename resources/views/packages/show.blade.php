@extends('adminlte::page')

@section('title', __('packages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('packages.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('packages.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('packages.name') }} : </strong>
                {{ $package->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('packages.app_url') }} : </strong>
                {{ $package->app_path }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('packages.description') }} : </strong>
                {{ $package->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('packages.icon') }} : </strong>
                <img src="{{ $package->icon_url }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('packages.package_version') }} : </strong>
                {{ $package->package_version }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('packages.sdk_version') }} : </strong>
                {{ $package->sdk_version }}
            </div>
        </div>
        <div class="col-xs-12 col-sn-12 col-nd-12">
            <div class="form-group">
                <strong>{{ __('packages.launcher_id') }} </strong>
                @if ($package->launcher_id == -1)
                     {{ __('packages.launcher_false') }}
                @elseif ($package->launcher_id == 1)
                     {{ __('packages.launcher_magicviewer') }}
                @elseif ($package->launcher_id == 2)
                     {{ __('packages.launcher_mundi') }}
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('packages.types') }} : </strong>
                {{ $package->type_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('packages.projects') }} : </strong>
                {{ $package->proj_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('packages.status') }}:</strong>
                {{ ($package->status==1) ? __('tables.status_on') : __('tables.status_off') }}
            </div>
        </div>
     </div>


@endsection
