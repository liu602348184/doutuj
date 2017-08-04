<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <title>{{ $title }} | 斗图界</title>
        <meta name="description" content="斗图界是一个专注于表情包斗图的网站，快速帮你生成表情包，让你在斗图大战中反败为胜！"/>
        <meta name="keywords" content="表情包下载,快速生成表情包,在线生成表情包,聊天图片大全,斗图终结者,张学友表情,熊猫头表情,金馆长表情,在线表情包制作,表情包,斗图在线制作,斗图表情包在线制作,斗图网站,斗图制作网站,表情包图片,表情图,斗图,金馆长,斗图大会"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="renderer" content="webkit">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
        <link rel="shortcut icon" href="{{ url('/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/docs.css') }}">
        <!--[if lt IE 9]>
            <script src="{{ env('APP_URL') }}/js/html5.js"></script>
            <script src="{{ env('APP_URL') }}/js/respond.src.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default">
                <div class="container-fluid container">
                <!-- Brand and toggle get grouped for better mobile display -->
                
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- <a class="navbar-brand" href="#">Brand</a> -->
                    </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px">
                        <ul class="nav navbar-nav">
                            <li class="@yield('home')"><a href="{{ url('') }}">首页 <span class="sr-only">(current)</span></a></li>
                            <li class="@yield('article')"><a href="{{ url('article') }}">表情包下载</a></li>
                            @foreach ($navs as $nav)
                            <li class="@if(isset($navid) && $nav->id==$navid) active @endif"><a href='{{ url("face/{$nav->id}") }}'>{{ $nav->title }}</a></li>
                            @endforeach
                        </ul>
                        <!-- <form class="navbar-form navbar-left">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="搜索">
                            </div>
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        </form> -->
                        <div class="h_logo pull-right">
                        </div>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
    
