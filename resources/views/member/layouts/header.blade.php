<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('static/lib/html5shiv.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/lib/respond.min.js')}}"></script>
    <![endif]-->
    <link href="{{ asset('static/static/h-ui/css/H-ui.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('static/static/h-ui.admin/css/H-ui.admin.css')}}" />
    <link href="{{asset('static/lib/Hui-iconfont/1.0.8/iconfont.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{asset('static/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
    <link rel="stylesheet" type="text/css" href="{{asset('static/static/h-ui.admin/css/style.css')}}" />
    <!--[if IE 6]>
    <script type="text/javascript" src="{{asset('static/lib/DD_belatedPNG_0.0.8a-min.js')}}" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->


    <title>龙泽三郎后台系统</title>
    <meta name="keywords" content="龙泽三郎后台系统">
    <meta name="description" content="龙泽三郎后台系统 admin v3.1 ">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

@yield('content')
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('static/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('static/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/static/h-ui.admin/js/H-ui.admin.js')}}"></script>
<!--/_footer 作为公共模版分离出去-->
@yield('script')
</body>
</html>
