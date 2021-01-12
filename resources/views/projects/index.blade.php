@extends('adminlte::page')

@section('title', __('projects.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('projects.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('projects.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('projects.id') }}</th>
            <th>{{ __('projects.name') }}</th>
            <th>{{ __('projects.description') }}</th>
            <th>{{ __('projects.status') }}</th>
            <th>{{ __('projects.start_time') }}</th>
            <th>{{ __('projects.stop_time') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($projects as $project)
        <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->descriptions }}</td>
            <td>{{ ($project->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>{{ $project->start_time }}</td>
            <td>{{ $project->stop_time }}</td>
            <td>
                <form action="{{ route('projects.destroy',$project->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('projects.show',$project->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('projects.edit',$project->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $projects->links() !!}
@endsection
