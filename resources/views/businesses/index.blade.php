@extends('adminlte::page')

@section('title', __('businesses.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('businesses.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('businesses.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('businesses.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('businesses.id') }}</th>
            <th>{{ __('businesses.project') }}</th>
            <th>{{ __('businesses.logo') }}</th>
            <th>{{ __('businesses.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($businesses as $business)
        <tr>
            <td>{{ $business->id }}</td>
            <td>{{ $business->project }}</td>
            <td><img src="{{ $business->logo_url }}" width="320px" height="180px"></td>
            <td>{{ ($business->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('businesses.destroy', $business->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('businesses.show', $business->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('businesses.edit', $business->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $businesses->links() !!}
@endsection
