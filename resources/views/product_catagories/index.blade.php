@extends('adminlte::page')

@section('title', __('product_catagories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('product_catagories.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('product_catagories.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product_catagories.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('product_catagories.id') }}</th>
            <th>{{ __('product_catagories.name') }}</th>
            <th>{{ __('product_catagories.description') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($productCatagories as $productCatagory)
        <tr>
            <td>{{ $productCatagory->id }}</td>
            <td>{{ $productCatagory->name }}</td>
            <td>{{ $productCatagory->descriptions }}</td>
            <td>
                <form action="{{ route('product_catagories.destroy',$productCatagory->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('product_catagories.show',$productCatagory->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('product_catagories.edit',$productCatagory->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $productCatagories->links() !!}
@endsection
