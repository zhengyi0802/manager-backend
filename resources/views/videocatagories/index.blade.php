@extends('adminlte::page')

@section('title', __('videocatagories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('videocatagories.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('videocatagories.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('videocatagories.id') }}</th>
            <th>{{ __('videocatagories.user') }}</th>
            <th>{{ __('videocatagories.parent') }}</th>
            <th>{{ __('videocatagories.name') }}</th>
            <th>{{ __('videocatagories.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($catagories as $catagory)
        <tr>
            <td>{{ $catagory->id }}</td>
            <td>{{ $catagory->user }}</td>
            <td>{{ $catagory->parent ? $catagory->parent : __('videocatagories.root') }}</td>
            <td>{{ $catagory->name }}</td>
            <td>{{ ($catagory->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('videocatagories.destroy', $catagory->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('videocatagories.show', $catagory->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('videocatagories.edit', $catagory->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $catagories->links() !!}
@endsection

