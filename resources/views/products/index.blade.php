@extends('adminlte::page')

@section('title', __('products.title') )

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('products.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('products.id') }}</th>
            <th>{{ __('products.type') }}</th>
            <th>{{ __('products.serialno') }}</th>
            <th>{{ __('products.project') }}</th>
            <th>{{ __('products.ether_mac') }}</th>
            <th>{{ __('products.wifi_mac') }}</th>
            <th>{{ __('products.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->type_name }}</td>
            <td>{{ $product->serialno }}</td>
            <td>{{ $product->project_name }}</td>
            <td>{{ $product->ether_mac }}</td>
            <td>{{ $product->wifi_mac }}</td>
            <td>{{ $product->status_name }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $products->links() !!}
@endsection
