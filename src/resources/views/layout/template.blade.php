<!DOCTYPE html>
<html>
    <head>
    	<meta name="csrf-token" content="{{ csrf_token() }}" />
        <?php
            //set headers to NOT cache a page
            header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT'); 
            header("Cache-Control:no-store, no-cache, must-revalidate"); //HTTP 1.1
            header("Cache-Control:post-check=0, pre-check=0", false); 
            header("Pragma: no-cache"); //HTTP 1.0
            //header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        ?>

        <?php //========== Website Meta Data =========== ?>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="content-language" content="en" />
        <title>@yield('title')</title>
        <meta name="author" content="DynEd">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google" value="notranslate" content="notranslate">
        <meta name="robots" content="noindex, nofollow">

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
        <link rel="apple-touch-icon" href="{{asset('icon/icon.png')}}"/>

        <?php //========== Render CSS =========== ?>
        @foreach($data['css'] as $key => $asset)
            {!! Html::style($asset) !!}
        @endforeach

        <?php //========== Render Js in Header =========== ?>
        @if(!empty($data['js_assets_head']))
            @foreach($data['js_assets_head'] as $key => $asset)
                {!! Html::script($asset) !!}
            @endforeach
        @endif
        <?php //========== Header Script =========== ?>
        @yield('header_script')

    </head>
    <body class='fixed sidebar-mini @yield('class-body')' @yield('id-body')>
        <?php //========== Start Content =========== ?>
        @yield('content')

        <?php //========== Render Js =========== ?>
        @if(isset($data['js']))
        @foreach($data['js'] as $key => $asset)
            {!! Html::script($asset) !!}
        @endforeach
        @endif

        <?php //========== Render App_js =========== ?>
        @include('layout/app_js')

        <?php //========== Footer Script =========== ?>
        @yield('footer_script')
        
    </body>
</html>