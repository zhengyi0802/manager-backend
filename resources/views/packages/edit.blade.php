@extends('adminlte::page')

@section('title', __('packages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('packages.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('packages.index') }}">{{ __('tables.back') }}</a>
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

    <form action="{{ route('packages.update',$package->id) }}" method="POST">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.name') }} : </strong>
                    <input type="text" name="name" value="{{ $package->name }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.app_url') }} : {{ $package->app_path }}</strong>
                    <input type="file" name="app_file">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.icon') }} : {{ $package->icon_url }}</strong>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.description') }} :</strong>
                    <textarea class="form-control" style="height:150px" name="description" >{{ $package->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.package_version') }} : </strong>
                    <input type="text" name="package_version" class="form-control" value="{{ $package->package_version }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.sdk_version') }} : </strong>
                    <input type="text" name="sdk_version" class="form-control" value="{{ $package->sdk_version }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.launcher_id') }} : </strong>
                    <select name="launcher_id" >
                       <option value="-1" {{ ($package->launcher_id == -1) ? "selected" : null }} >{{ __('packages.launcher_false') }}</option>
                       <option value="1" {{ ($package->launcher_id == 1) ? "selected" : null }} >{{ __('packages.launcher_magicviewer') }}</option>
                       <option value="2" {{ ($package->launcher_id == 2) ? "selected" : null }} >{{ __('packages.launcher_mundi') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.types') }} : </strong>
                    @foreach($types as $type)
                       <input type="checkbox" name="type[]" value="{{ $type->name }}">
                       <lable for="{{ 'type-'.$type->id }}">{{ $type->name }}</label>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.projects') }} : </strong>
                    @foreach($projects as $project)
                       <input type="checkbox" name="project[]" class="form-control" value="{{ $project->name }}">
                       <lable for="{{ 'proj-'.$project->id }}">{{ $project->name }}</label>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.mac_addresses') }} : </strong>
                    <textarea class="form-control" style="height:150px" name="mac_addresses" ></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('packages.status') }} :  </strong>
                    <input type="radio" name="status" value="1" {{ ($package->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($package->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
