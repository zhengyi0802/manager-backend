@extends('adminlte::page')

@section('title', __('packages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('packages.header') }}</h1>
@stop

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>{{ __('packages.id') }}</th>
            <th>{{ __('packages.name') }}</th>
            <th>{{ __('packages.icon') }}</th>
            <th>{{ __('packages.package_version') }}</th>
            <th>{{ __('packages.sdk_version') }}</th>
            <th>{{ __('packages.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($packages as $package)
        <tr>
            <td>{{ $package->id }}</td>
            <td>{{ $package->name }}</td>
            <td><img src="{{ $package->icon_url }}" width="80px" height="80px"></td>
            <td>{{ $package->package_version }}</td>
            <td>{{ $package->sdk_version }}</td>
            <td>{{ ($package->status==1) ?  __('tables.status_on') : __('tables.status_off') }}</td>
            <td>
                <form action="{{ route('packages.destroy',$package->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('packages.show',$package->id) }}">{{ __('tables.details') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $packages->links() !!}
@endsection
