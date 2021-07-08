@extends('adminlte::page')

@section('title', __('voicesettings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('voicesettings.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('voicesettings.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('voicesettings.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('voicesettings.id') }}</th>
            <th>{{ __('voicesettings.project') }}</th>
            <th>{{ __('voicesettings.keywords') }}</th>
            <th>{{ __('voicesettings.package') }}</td>
            <th>{{ __('voicesettings.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($voicesettings as $voicesetting)
        <tr>
            <td>{{ $voicesetting->id }}</td>
            <td>{{ $voicesetting->project }}</td>
            <td>{{ $voicesetting->keywords }}</td>
            <td>{{ $voicesetting->package }}</td>
            <td>{{ ($voicesetting->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('voicesettings.destroy',$voicesetting->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('voicesettings.show',$voicesetting->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('voicesettings.edit',$voicesetting->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $voicesettings->links() !!}
@endsection
