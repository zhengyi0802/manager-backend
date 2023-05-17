@extends('adminlte::page')

@section('title', __('resellers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('resellers.header') }}</h1>
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
    <form id="reseller-form" action="{{ route('resellers.update',$reseller->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.name') }} :</strong>
                    <input type="text" name="name" value="{{ $reseller->user->name }}" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.introducer') }} :</strong>
                    <input type="text" name="introducer" value="{{ $reseller->introducer->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="phone" value="{{ $reseller->user->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.line_id') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="line_id" value="{{ $reseller->user->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.email') }} :</strong>
                    <input type="text" name="email" value="{{ $reseller->user->email }}"
                     class="form-control" placeholder="user@email.com">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.password') }} :<span class="must">{{ __('tables.password') }}</span></strong>
                    <input type="password" name="newpassword" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.address') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="address" value="{{ $reseller->address }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.pidnumbers') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="pid" value="{{ $reseller->pid }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.pid_image_1') }} : {{ __('tables.must') }}</strong>
                    <input type="file" name="pid_image_1" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <img id="preview1" name="preview1">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.pid_image_2') }} : {{ __('tables.must') }}</strong>
                    <input type="file" name="pid_image_2" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <img id="preview2" name="preview2">
                </div>
                <script>
                    var loadImage1 = function(event) {
                        var output = document.getElementById('preview1');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                           URL.revokeObjectURL(output.src) // free memory
                        }
                   };
                    var loadImage2 = function(event) {
                        var output = document.getElementById('preview2');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                           URL.revokeObjectURL(output.src) // free memory
                        }
                   };
                </script>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.bank') }} :</strong>
                    <input type="text" name="bank" value="{{ $reseller->bank }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.bank_name') }} :</strong>
                    <input type="text" name="bank_name" value="{{ $reseller->bank_name }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.account') }} :</strong>
                    <input type="text" name="account" value="{{ $reseller->account }}" class="form-control">
                </div>
                @if (auth()->user()->role <= App\Enums\UserRole::Manager)
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.bonus') }} :</strong>
                    <input type="number" name="bonus" value="{{ $reseller->bonus }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.share') }} :</strong>
                    <input type="number" name="share" value="{{ $reseller->share }}" class="form-control">
                </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.memo') }}:</strong>
                    <textarea class="form-control" style="height:150px" name="memo" >{{ $reseller->memo }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($reseller->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($reseller->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
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
               address: {
                  required: true,
                  minlength: 10
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
               address: {
                  required: '地址必須填寫',
                  minlength: '地址填寫錯誤'
               },
               pid: {
                  required: '身份證字號必填',
                  minlength: '身份證字號長度錯誤'
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
