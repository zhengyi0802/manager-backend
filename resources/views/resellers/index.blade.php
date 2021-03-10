@extends('adminlte::page')

@section('title', __('resellers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('resellers.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('resellers.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('resellers.id') }}</th>
            <th>{{ __('resellers.company') }}</th>
            <th>{{ __('resellers.account') }}</th>
            <th>{{ __('resellers.contact') }}</th>
            <th>{{ __('resellers.cotype') }}</th>
            <th>{{ __('resellers.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($resellers as $reseller)
        <tr>
            <td>{{ $reseller->id }}</td>
            <td>{{ $reseller->company }}</td>
            <td>{{ $reseller->account }}</td>
            <td>{{ $reseller->contact }}</td>
            <td>{{ $reseller->cotype }}</td>
            <td>{{ ($reseller->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('resellers.destroy',$reseller->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('resellers.show',$reseller->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('resellers.edit',$reseller->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $resellers->links() !!}
@endsection
