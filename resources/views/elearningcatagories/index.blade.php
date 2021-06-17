@extends('adminlte::page')

@section('title', __('elearningcatagories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('elearningcatagories.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('elearningcatagories.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('elearningcatagories.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('elearningcatagories.id') }}</th>
            <th>{{ __('elearningcatagories.project') }}</th>
            <th>{{ __('elearningcatagories.name') }}</th>
            <th>{{ __('elearningcatagories.preview') }}</th>
            <th>{{ __('elearningcatagories.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($elearningcatagories as $elearningcatagory)
        <tr>
            <td>{{ $elearningcatagory->id }}</td>
            <td>{{ $elearningcatagory->project }}</td>
            <td>{{ $elearningcatagory->name }}</td>
            <td><img src="{{ $elearningcatagory->preview }}" width="320px" height="180px"></td>
            <td>{{ ($elearningcatagory->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('elearningcatagories.destroy',$elearningcatagory->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('elearningcatagories.show',$elearningcatagory->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('elearningcatagories.edit',$elearningcatagory->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $elearningcatagories->links() !!}
@endsection
