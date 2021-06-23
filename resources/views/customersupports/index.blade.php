@extends('adminlte::page')

@section('title', __('customersupports.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('customersupports.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('customersupports.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('customersupports.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('customersupports.id') }}</th>
            <th>{{ __('customersupports.project') }}</th>
            <th>{{ __('customersupports.qrcode_type') }}</th>
            <th>{{ __('customersupports.qrcode_content') }}</th>
            <th>{{ __('customersupports.rcapp') }}</td>
            <th>{{ __('qalists.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($customersupports as $customersupport)
        <tr>
            <td>{{ $customersupport->id }}</td>
            <td>{{ $customersupport->project }}</td>
            <td>{{ $customersupport->qrcode_type }}</td>
            <td>{{ $customersupport->qrcode_content }}</td>
            <td>{{ $customersupport->rcapp }}</td>
            <td>{{ ($customersupport->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('customersupports.destroy',$customersupport->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('customersupports.show',$customersupport->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('customersupports.edit',$customersupport->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $customersupports->links() !!}
@endsection
