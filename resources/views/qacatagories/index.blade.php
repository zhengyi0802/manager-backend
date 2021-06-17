@extends('adminlte::page')

@section('title', __('qacatagories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('qacatagories.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('qacatagories.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('qacatagories.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('qacatagories.id') }}</th>
            <th>{{ __('qacatagories.name') }}</th>
            <th>{{ __('qacatagories.descriptions') }}</th>
            <th>{{ __('qacatagories.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($qacatagories as $qacatagory)
        <tr>
            <td>{{ $qacatagory->id }}</td>
            <td>{{ $qacatagory->name }}</td>
            <td>{{ $qacatagory->descriptions }}</td>
            <td>{{ ($qacatagory->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('qacatagories.destroy',$qacatagory->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('qacatagories.show',$qacatagory->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('qacatagories.edit',$qacatagory->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $qacatagories->links() !!}
@endsection
