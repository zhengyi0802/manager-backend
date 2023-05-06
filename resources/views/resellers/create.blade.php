@extends('adminlte::page')

@section('title', __('resellers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('resellers.header') }}</h1>
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
<style>
  .error {
     color       : red;
     margin-left : 5px;
     font-size   : 12px;
  }
  label.error {
     display     : inline;
  }
  span.must {
     color     : red;
     font-size : 12px;
  }
</style>
<form id="reseller-form" action="{{ route('resellers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('resellers.manager') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                @if (auth()->user()->role == App\Enums\UserRole::Manager)
                    <input type="text" name="introducer" value="{{ auth()->user()->line_id }}" class="form-control" disabled>
                @else
                    <input type="text" name="introducer" class="form-control">
                @endif
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('resellers.name') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('resellers.line_id') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="line_id" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('resellers.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('resellers.email') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="email" class="form-control" placeholder="user@email.com">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.address') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="address" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('resellers.password') }} :<span class="must">{{ __('tables.password') }}</span></strong>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('resellers.pidnumbers') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="pid" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('resellers.bonus') }} :</strong>
                <input type="numbers" name="bonus" value="2500" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('resellers.share') }} :</strong>
                <input type="numbers" name="share" value="1000" class="form-control">
            </div>
            <div class="form-group">
                <strong>{{ __('managers.memo') }}:</strong>
                <textarea class="form-control" style="height:150px" name="memo" ></textarea>
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
        $('#reseller-form').validate({
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
               email: {
                  required: true,
                  email: true
               },
               address: {
                  required: true,
                  minlength: 20
               },
               pid: {
                  required: true,
                  minlength: 10
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
               email: {
                  required: '電子信箱必須填寫',
                  email: '電子信箱格式錯誤',
               },
               address: {
                  required: '地址必須填寫',
                  minlength: '地址填寫錯誤',
               },
               pid: {
                  required: '身份證字號必填',
                  minlength: '身份證字號長度錯誤',
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
