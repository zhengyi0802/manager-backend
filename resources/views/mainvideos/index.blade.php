@extends('adminlte::page')

@section('title', __('mainvideos.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mainvideos.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('mainvideos.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mainvideos.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('mainvideos.id') }}</th>
            <th>{{ __('mainvideos.project') }}</th>
            <th>{{ __('mainvideos.type') }}</th>
            <th>{{ __('mainvideos.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($mainvideos as $mainvideo)
        <tr>
            <td>{{ $mainvideo->id }}</td>
            <td>{{ $mainvideo->project }}</td>
            <td>{{ $mainvideo->type }}</td>
            <td>{{ ($mainvideo->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('mainvideos.destroy',$mainvideo->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('mainvideos.show',$mainvideo->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('mainvideos.edit',$mainvideo->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $mainvideos->links() !!}
@endsection
