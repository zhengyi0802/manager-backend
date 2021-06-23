@extends('adminlte::page')

@section('title', __('startpages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('startpages.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('startpages.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('startpages.id') }}</th>
            <th>{{ __('startpages.name') }}</th>
            <th>{{ __('startpages.project_name') }}</th>
            <th>{{ __('startpages.url') }}</th>
            <th>{{ __('startpages.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($startpages as $startpage)
        <tr>
            <td>{{ $startpage->id }}</td>
            <td>{{ $startpage->name }}</td>
            <td>{{ ($startpage->proj_name) ? $startpage->proj_name : '--------'  }}</td>
            <td><img src="{{ $startpage->url }}" width="320" height="240" ></td>
            <td>{{ ($startpage->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('startpages.destroy',$startpage->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('startpages.show',$startpage->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('startpages.edit',$startpage->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $startpages->links() !!}
@endsection
