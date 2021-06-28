@extends('adminlte::page')

@section('title', __('bulletins.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletins.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('bulletins.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bulletins.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('bulletins.id') }}</th>
            <th>{{ __('bulletins.project') }}</th>
            <th>{{ __('bulletins.ftitle') }}</th>
            <th>{{ __('bulletins.status') }}</th>
            <th>{{ __('bulletins.date') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($bulletins as $bulletin)
        <tr>
            <td>{{ $bulletin->id }}</td>
            <td>{{ $bulletin->project }}</td>
            <td>{{ $bulletin->title }}</td>
            <td>{{ ($bulletin->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>{{ $bulletin->date }}</td>
            <td>
                <form action="{{ route('bulletins.destroy',$bulletin->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('bulletins.show',$bulletin->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('bulletins.edit',$bulletin->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $bulletins->links() !!}
@endsection
