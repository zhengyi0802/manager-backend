@extends('adminlte::page')

@section('title', __('advertisings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('advertisings.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('advertisings.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('advertisings.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('advertisings.id') }}</th>
            <th>{{ __('advertisings.project') }}</th>
            <th>{{ __('advertisings.index') }}</th>
            <th>{{ __('advertisings.thumbnail') }}</th>
            <th>{{ __('advertisings.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($advertisings as $advertising)
        <tr>
            <td>{{ $advertising->id }}</td>
            <td>{{ $advertising->project }}</td>
            <td>{{ $advertising->index }}</td>
            <td><img src="{{ $advertising->thumbnail }}" width="320px" height="180px"></td>
            <td>{{ ($advertising->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('advertisings.destroy', $advertising->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('advertisings.show', $advertising->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('advertisings.edit', $advertising->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $advertisings->links() !!}
@endsection
