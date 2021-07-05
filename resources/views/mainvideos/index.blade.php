@extends('adminlte::page')

@section('title', __('elearnings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('elearnings.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('elearnings.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('elearnings.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('elearnings.id') }}</th>
            <th>{{ __('elearnings.catagory') }}</th>
            <th>{{ __('elearnings.name') }}</th>
            <th>{{ __('elearnings.preview') }}</th>
            <th>{{ __('elearnings.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($elearnings as $elearning)
        <tr>
            <td>{{ $elearning->id }}</td>
            <td>{{ $elearning->catagory }}</td>
            <td>{{ $elearning->name }}</td>
            <td><img src="{{ $elearning->preview }}" width="320px" height="180px"></td>
            <td>{{ ($elearning->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('elearnings.destroy',$elearning->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('elearnings.show',$elearning->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('elearnings.edit',$elearning->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $elearnings->links() !!}
@endsection
