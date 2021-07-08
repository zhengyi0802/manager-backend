@extends('adminlte::page')

@section('title', __('menus.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('menus.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('menus.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('menus.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('menus.id') }}</th>
            <th>{{ __('menus.project') }}</th>
            <th>{{ __('menus.name') }}</th>
            <th>{{ __('menus.icon') }}</th>
            <th>{{ __('menus.tag') }}</th>
            <th>{{ __('menus.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($menus as $menu)
        <tr>
            <td>{{ $menu->id }}</td>
            <td>{{ $menu->project }}</td>
            <td>{{ $menu->name }}</td>
            <td><img src="{{ $menu->icon }}" width="320px" height="180px"></td>
            <td>{{ $menu->icon }}</td>
            <td>{{ ($menu->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('menus.destroy',$menu->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('menus.show',$menu->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('menus.edit',$menu->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $menus->links() !!}
@endsection
