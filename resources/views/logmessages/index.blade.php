@extends('adminlte::page')

@section('title', __('appmenus.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appmenus.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('appmenus.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('appmenus.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('appmenus.id') }}</th>
            <th>{{ __('appmenus.project') }}</th>
            <th>{{ __('appmenus.position') }}</th>
            <th>{{ __('appmenus.name') }}</th>
            <th>{{ __('appmenus.thumbnail') }}</th>
            <th>{{ __('appmenus.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($appmenus as $appmenu)
        <tr>
            <td>{{ $appmenu->id }}</td>
            <td>{{ $appmenu->project }}</td>
            <td>{{ $appmenu->position }}</td>
            <td>{{ $appmenu->name }}</td>
            <td><img src="{{ $appmenu->thumbnail }}" width="320px" height="180px"></td>
            <td>{{ ($appmenu->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('appmenus.destroy',$appmenu->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('appmenus.show',$appmenu->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('appmenus.edit',$appmenu->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $appmenus->links() !!}
@endsection
