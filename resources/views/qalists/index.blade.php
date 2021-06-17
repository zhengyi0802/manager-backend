@extends('adminlte::page')

@section('title', __('qalists.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('qalists.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('qalists.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('qalists.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('qalists.id') }}</th>
            <th>{{ __('qalists.catagory') }}</th>
            <th>{{ __('qalists.question') }}</th>
            <th>{{ __('qalists.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($qalists as $qalist)
        <tr>
            <td>{{ $qalist->id }}</td>
            <td>{{ $qalist->catagory }}</td>
            <td>{{ $qalist->question }}</td>
            <td>{{ ($qalist->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('qalists.destroy',$qalist->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('qalists.show',$qalist->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('qalists.edit',$qalist->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $qalists->links() !!}
@endsection
