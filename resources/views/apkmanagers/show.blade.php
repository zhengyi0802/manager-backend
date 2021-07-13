@extends('adminlte::page')

@section('title', __('apkmanagers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('apkmanagers.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('apkmanagers.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.label') }} : </strong>
                {{ $apkmanager->label }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.package_name') }} : </strong>
                {{ $apkmanager->package_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.package_version_name') }} : </strong>
                {{ $apkmanager->package_version_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.package_version_code') }} : </strong>
                {{ $apkmanager->package_version_code }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.sdk_version') }} : </strong>
                {{ $apkmanager->sdk_version }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.description') }} : </strong>
                {{ $apkmanager->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.icon') }} : </strong>
                <img src="{{ $apkmanager->icon }}" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.path') }} : </strong>
                {{ $apkmanager->path }}
            </div>
        </div>
        <div class="col-xs-12 col-sn-12 col-nd-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.launcher_id') }} </strong>
                @if ($apkmanager->launcher_id == -1)
                     {{ __('apkmanagers.launcher_false') }}
                @elseif ($apkmanager->launcher_id == 1)
                     {{ __('apkmanagers.launcher_magicviewer') }}
                @elseif ($apkmanager->launcher_id == 2)
                     {{ __('apkmanagers.launcher_mundi') }}
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.types') }} : </strong>
                {{ $apkmanager->type_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.projects') }} : </strong>
                {{ $apkmanager->proj_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('apkmanagers.status') }}:</strong>
                {{ ($apkmanager->status==1) ? __('tables.status_on') : __('tables.status_off') }}
            </div>
        </div>
     </div>
@endsection
