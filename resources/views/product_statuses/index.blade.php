@extends('adminlte::page')

@section('title', __('product_statuses.title') )

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('product_statuses.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>產品狀態</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product_statuses.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('product_statuses.id') }}</th>
            <th>{{ __('product_statuses.name') }}</th>
            <th>{{ __('product_statuses.detail') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($productStatuses as $productStatus)
        <tr>
            <td>{{ $productStatus->id }}</td>
            <td>{{ $productStatus->name }}</td>
            <td>{{ $productStatus->detail }}</td>
            <td>
                <form action="{{ route('product_statuses.destroy',$productStatus->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('product_statuses.show',$productStatus->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('product_statuses.edit',$productStatus->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $productStatuses->links() !!}
@endsection
