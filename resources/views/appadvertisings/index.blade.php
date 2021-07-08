@extends('adminlte::page')

@section('title', __('appadvertisings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appadvertisings.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('appadvertisings.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('appadvertisings.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('appadvertisings.id') }}</th>
            <th>{{ __('appadvertisings.project') }}</th>
            <th>{{ __('appadvertisings.interval') }}</th>
            <th>{{ __('appadvertisings.thumbnail') }}</th>
            <th>{{ __('appadvertisings.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($appadvertisings as $appadvertising)
        <tr>
            <td>{{ $appadvertising->id }}</td>
            <td>{{ $appadvertising->project }}</td>
            <td>{{ $appadvertising->interval }}</td>
            <td><img src="{{ $appadvertising->thumbnail }}" width="320px" height="180px"></td>
            <td>{{ ($appadvertising->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('appadvertisings.destroy', $appadvertising->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('appadvertisings.show', $appadvertising->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('appadvertisings.edit', $appadvertising->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $appadvertisings->links() !!}
@endsection
