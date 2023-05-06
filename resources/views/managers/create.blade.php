@extends('adminlte::page')

@section('title', __('managers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('managers.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
        </div>
        @include('layouts.back')
    </div>
</div>

@if ($message = Session::get('error'))
<div class="alert alert-danger col-md-4">
    <p>{{ __('managers.user_create_error') }}</p>
</div>
@endif

<style>
  .error {
     color       : red;
     margin-left : 5px;
     font-size   : 14px;
  }
  label.error {
     display     : inline;
  }
  span.must {
     color     : red;
     font-size : 12px;
  }
</style>
<form action="{{ route('managers.store') }}" method="POST" id="manager-form">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('managers.name') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('managers.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('managers.line_id') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="line_id" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('managers.password') }} :<span class="must">{{ __('tables.password') }}</span></strong>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('managers.company') }} :</strong>
                <input type="text" name="company" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('managers.cid') }} :</strong>
                <input type="text" name="cid" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('managers.pid') }} :</strong>
                <input type="text" name="pid" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.address') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="address" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.memo') }} :</strong>
                <textarea class="form-control" style="height:150px" name="memo"></textarea>
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
        $('#manager-form').validate({
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
               password: {
                  required: true,
                  minlength: 8
               },
               address: {
                  required: true,
                  minlength: 20
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
               password: {
                  required: '密碼必須填寫',
                  minlength: '密碼設置至少8個字元'
               },
               address: {
                  required: '地址必須填寫',
                  minlength: '請詳細填寫地址',
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
