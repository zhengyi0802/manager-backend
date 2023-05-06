@extends('adminlte::page')

@section('title', __('admins.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('admins.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            @include('layouts.back')
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admins.update',$admin->id) }}" method="POST">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('admins.name') }} :</strong>
                    {{ $admin->name }}
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('admins.phone') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="phone" value="{{ $admin->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('admins.line_id') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="line_id" value="{{ $admin->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('admins.email') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="email" value="{{ $admin->email }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('admins.password') }} :</strong>
                    <input type="password" name="newpassword" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('admins.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($admin->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($admin->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#admin-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
               phone: {
                  required: true
               },
               line_id: {
                  required: true
               },
               email: {
                  required: true
               },
               status: {
                  required: true,
               },
           },
           messages: {
               name: {
                  required: '姓名必填'
               },
               phone: {
                  required: '電話必填'
               },
               line_id: {
                  required: 'Line ID必填'
               },
               email: {
                  required: '電子信箱必填',
               },
               status: {
                  required:  ''
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
@section('plugins.jqueryValidation', true)

@endsection
