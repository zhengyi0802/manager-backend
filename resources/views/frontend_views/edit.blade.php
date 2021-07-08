@extends('adminlte::page')

@section('title', __('frontend_views.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('frontend_views.header') }}</h1>
    {{ __('projects.name') }} {{ $project->name }}
@stop

@section('content')
    <style type="text/css">
      img {
         width  : 90%;
         height : 90%;
      }
      #view {
         width     : 100%;
         height    : 100%;
         background-image : url('/images/background.png');
      }
      #topside {
            width  : 100%;
            height : 80px;
      }
      #block1 {
            text-align: center;
            vertical-align: middle;
            width  : 15%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block2 {
            text-align: center;
            vertical-align: middle;
            width  : 70%;
            height : 100%;
            border : 1px #1010101 solid;
            float  : left;
      }
      #block3 {
            text-align: center;
            vertical-align: middle;
            background-image : url('');
            width  : 15%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
      #middleside {
            width  : 100%;
            height : 400px;
      }
      #leftside {
            width  : 15%;
            height : 400px;
            float  : left;
      }
      #rightside {
            width  : 15%;
            height : 400px;
            float  : left;
      }
      #block4 {
            text-align: center;
            background-image : url('');
            width  : 100%;
            height : 80px;
            border : 1px #101010 solid;
      }
      #block5 {
            text-align: center;
            width  : 70%;
            height : 400px;
            border : 1px #101010 solid;
            background-color : #101010;
            color : #F0F0F0;
            float  : left;
      }
      #block6 {
            text-align: center;
            background-image : url('');
            width  : 100%;
            height : 80px;
            border : 1px #101010 solid;
            float  : left;
      }
      #block7 {
            text-align: center;
            backgroud-image : url('');
            width  : 100%;
            height : 320px;
            border : 1px #101010 solid;
      }
      #block8 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block9 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block10 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block11 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block12 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block13 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block14 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block15 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block16 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #bottomside {
            width  : 100%;
            height : 80px;
      }
      #block17 {
            text-align: center;
            background-image : url('');
            width  : 15%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block18 {
            text-align: center;
            background-image : url('');
            width  : 70%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block19 {
            text-align: center;
            background-image : url('');
            width  : 15%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
   </style>
   <div id="view" name="view">
      <div id="topside">
          <div id="block1">
             <a href="{{ route('logos.edit2', ['project' => $project]) }}" ><img src="{{ ($frontend_view['logo'] != null) ? $frontend_view['logo'] : '/images/block01.png' }}"></a>
          </div>
          <div id="block2">
             <img src="/images/block02.png">
          </div>
          <div id="block3">
             <img src="/images/block03.png"></a>
          </div>
      </div>
      <div id="middleside">
          <div id="leftside">
              <div id="block4">
                 <a href="{{ route('businesses.edit2', ['project' => $project]) }}" ><img src="{{ ($frontend_view['customLogo'] != null) ? $frontend_view['customLogo'] : '/images/block04.png' }}"></a>
             </div>
             <div id="block7">
                 <a href="{{ route('advertisings.edit2', ['project' => $project]) }}" ><img src="{{ ($frontend_view['ad'] != null) ? $frontend_view['ad'] : '/images/block07.png' }}"></a>
              </div>
          </div>
          <div id="block5" class="block5">
             <a href="{{ route('mainvideos.edit2', ['project' => $project]) }}" ><img src="/images/block05.png"></a>
          </div>
          <div id="rightside">
              <div id="block6">
                 <a href="{{ route('bulletins.edit2', ['project' => $project]) }}" ><img src="/images/block06.png"></a>
              </div>
              <div id="block8">
                 <a href="{{ route('appmenus.edit2', ['project' => $project, 'position' => '1']) }}" ><img src="{{ ($frontend_view['apps'][0] != null) ? $frontend_view['apps'][0] : '/images/block08.png' }}"></a>
              </div>
              <div id="block9">
                 <a href="{{ route('appmenus.edit2', ['project' => $project, 'position' => '2']) }}" ><img src="{{ ($frontend_view['apps'][1] != null) ? $frontend_view['apps'][1] : '/images/block09.png' }}"></a>
              </div>
              <div id="block10">
                 <a href="{{ route('appmenus.edit2', ['project' => $project, 'position' => '3']) }}" ><img src="{{ ($frontend_view['apps'][2] != null) ? $frontend_view['apps'][2] : '/images/block10.png' }}"></a>
              </div>
              <div id="block11">
                 <a href="{{ route('appmenus.edit2', ['project' => $project, 'position' => '4']) }}" ><img src="{{ ($frontend_view['apps'][3] != null) ? $frontend_view['apps'][3] : '/images/block11.png' }}"></a>
              </div>
              <div id="block12">
                 <a href="{{ route('appmenus.edit2', ['project' => $project, 'position' => '5']) }}" ><img src="{{ ($frontend_view['apps'][4] != null) ? $frontend_view['apps'][4] : '/images/block12.png' }}"></a>
              </div>
              <div id="block13">
                 <a href="{{ route('appmenus.edit2', ['project' => $project, 'position' => '6']) }}" ><img src="{{ ($frontend_view['apps'][5] != null) ? $frontend_view['apps'][5] : '/images/block13.png' }}"></a>
              </div>
              <div id="block14">
                 <a href="{{ route('appmenus.edit2', ['project' => $project, 'position' => '7']) }}" ><img src="{{ ($frontend_view['apps'][6] != null) ? $frontend_view['apps'][6] : '/images/block14.png' }}"></a>
              </div>
              <div id="block15">
                 <a href="{{ route('appmenus.edit2', ['project' => $project, 'position' => '8']) }}" ><img src="{{ ($frontend_view['apps'][7] != null) ? $frontend_view['apps'][7] : '/images/block15.png' }}"></a>
              </div>
              <div id="block16">
                 <a href="{{ route('appmenus.edit2', ['project' => $project, 'position' => '9']) }}" ><img src="{{ ($frontend_view['apps'][8] != null) ? $frontend_view['apps'][8] : '/images/block16.png' }}"></a>
              </div>
          </div>
      </div>
      <div id="bottomside">
          <div id="block17">
             <img src="/images/block17.png">
          </div>
          <div id="block18">
             <img src="/images/block18.png">
          </div>
          <div id="block19">
             <img src="/images/block19.png">
          </div>
      </div>
    </div>
@endsection
