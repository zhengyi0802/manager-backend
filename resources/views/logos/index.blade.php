@extends('adminlte::page')

@section('title', __('logos.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('logos.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('logos.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('logos.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('logos.id') }}</th>
            <th>{{ __('logos.project') }}</th>
            <th>{{ __('logos.name') }}</th>
            <th>{{ __('logos.image') }}</th>
            <th>{{ __('logos.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($logos as $logo)
        <tr>
            <td>{{ $logo->id }}</td>
            <td>{{ $logo->project }}</td>
            <td>{{ $logo->name }}</td>
            <td><img src="{{ $logo->image }}" width="320px" height="180px"></td>
            <td>{{ ($logo->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('logos.destroy', $logo->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('logos.show', $logo->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('logos.edit', $logo->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $logos->links() !!}
@endsection
