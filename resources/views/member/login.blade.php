<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('static/H-ui.ucenter/lib/html5.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/H-ui.ucenter/lib/respond.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/H-ui.ucenter/lib/PIE_IE678.js')}}"></script>
    <![endif]-->
    <link href="{{asset('static/H-ui.ucenter/static/h-ui/css/H-ui.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('static/H-ui.ucenter/static/h-ui.ucenter/css/H-ui.ucenter.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('static/H-ui.ucenter/lib/Hui-iconfont/1.0.8/iconfont.css')}}" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <link href="{{asset('static/H-ui.ucenter/static/h-ui/css/H-ui.ie.css')}}" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!--[if IE 6]>
    <script type="text/javascript" src="{{asset('static/H-ui.ucenter/lib/DD_belatedPNG_0.0.8a-min.js')}}" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>用户登录 - 正版企业网站模版 - H-ui出品</title>
    <meta name="keywords" content="正版企业网站模版,H-ui.qiye,H5企业网站模版,移动端企业网站模版,兼容手机企业网站模版">
    <meta name="description" content="H-ui出品正版企业网站模版H-ui.qiye，使用H-ui前端框架，采用响应式设计，兼容PC、平板（pad）、移动端（手机）三大平台！">
</head>
<body>
<div class="login-wraper">
    <div class="login-form radius box-shadow">
        <div class="clearfix pt-20">
            <i class="iconpic iconpic-logo"></i>
        </div>
        <div class="row clearfix form-title">网站登录</div>
        @if(session()->has('warning'))
            {{ session('warning') }}
        @endif
        @if(session()->has('success'))
            {{ session('success') }}
        @endif

        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif
        <form class="form form-horizontal" method="post" action="login" id="form-login">
            @csrf
            <div class="row clearfix">
                <input type="name" class="input-text radius size-L" name="name" id="name" value="" placeholder="name">
            </div>
            <div class="row clearfix">
                <input type="password" class="input-text radius size-L" name="password" id="password" value="" placeholder="password">
            </div>
            <div class="row clearfix">
                <button class="btn btn-primary btn-block radius size-L">登 录</button>
            </div>
            <div class="row clearfix f-12">
                <a href="/password/reset/">忘记密码?</a>
                <div class="line mt-20"></div>
            </div>

            <div class="row clearfix">没有账户? <a href="registered"><strong>注 册</strong></a></div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{asset('static/H-ui.ucenter/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/H-ui.ucenter/static/h-ui/js/H-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('static/H-ui.ucenter/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('static/H-ui.ucenter/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
<script type="text/javascript" src="{{asset('static/H-ui.ucenter/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $("#form-login").validate({
            rules: {
                name: {
                    required: true,
                    name: true,
                },
                password: {
                    required: true,
                    rangelength: [6, 16]
                },
            },
            messages: {
                name: {
                    required: "邮箱不能为空",
                    name: "邮箱格式不正确",
                },
                password: {
                    required: "密码不能为空",
                    rangelength: "6-16个字符"
                }
            },
            onkeyup: false,
            focusCleanup: false,
            submitHandler: function(form) {
                $(".label.error").hide();
                //在这里执行表单提交
            }
        });
    });
</script>
</body>
</html>
<!--H-ui前端框架提供前端技术支持 h-ui.net @2016-03-20 -->
