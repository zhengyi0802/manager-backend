@extends('adminlte::page')

@section('title', __('logmessages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('logmessages.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('logmessages.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('logmessages.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('logmessages.id') }}</th>
            <th>{{ __('logmessages.version_code') }}</th>
            <th>{{ __('logmessages.version_name') }}</th>
            <th>{{ __('logmessages.mac_eth') }}</th>
            <th>{{ __('logmessages.mac_wifi') }}</th>
            <th>{{ __('logmessages.date') }}</th>
            <th width="100px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($logmessages as $logmessage)
        <tr>
            <td>{{ $logmessage->id }}</td>
            <td>{{ $logmessage->version_code }}</td>
            <td>{{ $logmessage->version_name }}</td>
            <td>{{ $logmessage->mac_eth }}</td>
            <td>{{ $logmessage->mac_wifi }}</td>
            <td>{{ $logmessage->date }}</td>
            <td>
                <form action="{{ route('appmenus.destroy',$appmenu->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('appmenus.show',$appmenu->id) }}">{{ __('tables.details') }}</a>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $logmessages->links() !!}
@endsection
