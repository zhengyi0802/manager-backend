@extends('adminlte::page')

@section('title', __('apkmanagers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('apkmanagers.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('apkmanagers.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>{{ __('apkmanagers.id') }}</th>
            <th>{{ __('apkmanagers.label') }}</th>
            <th>{{ __('apkmanagers.icon') }}</th>
            <th>{{ __('apkmanagers.package_version_name') }}</th>
            <th>{{ __('apkmanagers.sdk_version') }}</th>
            <th>{{ __('apkmanagers.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($apkmanagers as $apkmanager)
        <tr>
            <td>{{ $apkmanager->id }}</td>
            <td>{{ $apkmanager->label }}</td>
            <td><img src="{{ $apkmanager->icon }}" width="80px" height="80px"></td>
            <td>{{ $apkmanager->package_version_name }}</td>
            <td>{{ $apkmanager->sdk_version }}</td>
            <td>{{ ($apkmanager->status==1) ?  __('tables.status_on') : __('tables.status_off') }}</td>
            <td>
                <form action="{{ route('apkmanagers.destroy',$apkmanager->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('apkmanagers.show',$apkmanager->id) }}">{{ __('tables.details') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $apkmanagers->links() !!}
@endsection
