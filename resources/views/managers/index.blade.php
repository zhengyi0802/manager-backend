@extends('adminlte::page')

@section('title', __('managers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('managers.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('managers.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('managers.id') }}</th>
            <th>{{ __('managers.name') }}</th>
            <th>{{ __('managers.account') }}</th>
            <th>{{ __('managers.job_title') }}</th>
            <th>{{ __('resellers.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($managers as $manager)
        <tr>
            <td>{{ $manager->id }}</td>
            <td>{{ $manager->name }}</td>
            <td>{{ $manager->account }}</td>
            <td>{{ $manager->job_title }}</td>
            <td>{{ ($manager->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('managers.destroy',$manager->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('managers.show',$manager->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('managers.edit',$manager->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $managers->links() !!}
@endsection
