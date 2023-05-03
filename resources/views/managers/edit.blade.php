@extends('adminlte::page')

@section('title', __('managers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('managers.header') }}</h1>
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
       span.must {
          color     : red;
          font-size : 12px;
       }
    </style>
    <form action="{{ route('managers.update',$manager->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.name') }} :</strong>
                    {{ $manager->user->name }}
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="phone" value="{{ $manager->user->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.line_id') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="line_id" value="{{ $manager->user->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.company') }} :</strong>
                    <input type="text" name="company" value="{{ $manager->company }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.password') }} :<span class="must">{{ __('tables.password') }}</span></strong>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.address') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="address" value="{{ $manager->address }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.cid') }} :</strong>
                    <input type="text" name="cid" value="{{ $manager->cid }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.pid') }} :</strong>
                    <input type="text" name="pid" value="{{ $manager->pid }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.pid_image_1') }} : {{ __('tables.must') }}</strong>
                    <input type="file" name="pid_image_1" class="form-control" onchange="loadImage1(event)" >
                </div>
                <div class="form-group col-md-4">
                    <img id="preview1" name="preview1">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.pid_image_2') }} : {{ __('tables.must') }}</strong>
                    <input type="file" name="pid_image_2" class="form-control" onchange="loadImage2(event)">
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
                    <strong>{{ __('managers.bank') }} :</strong>
                    <input type="text" name="bank" value="{{ $manager->bank }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.bank_name') }} :</strong>
                    <input type="text" name="bank_name" value="{{ $manager->bank_name }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.account') }} :</strong>
                    <input type="text" name="account" value="{{ $manager->account }}" class="form-control">
                </div>
                @if (auth()->user()->role == App\Enums\UserRole::Administrator)
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.share') }} :</strong>
                    <input type="number" name="share" value="{{ $manager->share }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.bonus') }} :</strong>
                    <input type="number" name="bonus" value="{{ $manager->bonus }}" class="form-control">
               </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.share_status') }} : </strong>
                    <input type="checkbox" id="share_status" name="share_status" value="1" {{ ($manager->share_status) ? null : 'checked'  }}>
                    <label for="share_status">{{ __('managers.share_status') }}</label>
               </div>
               @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('managers.memo') }}:</strong>
                    <textarea class="form-control" style="height:150px" name="memo" >{{ $manager->memo }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('managers.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($manager->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($manager->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
