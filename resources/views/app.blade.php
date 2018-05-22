<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/css/style.css">
    {{--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.5/styles/default.min.css">--}}
    <link href="{{url('css/monokai_sublime.min.css')}}" rel="stylesheet">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jquery.form.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.js"></script>
    <script src="{{url('js/highlight.min.js')}}"></script>
    {{--<meta id="token" name="token" value="{{csrf_token()}}">--}}
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Laravel App</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">首页</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li>
                        <a id="dLabel" type="button" data-toggle="dropdown" >{{Auth::user()->name}}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel" >
                            <li><a href="/user/avatar"><i class="fa fa-user"></i> 更换头像</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> 更换密码</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> 特别感谢</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/logout"><i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>

                    </li>
                    {{--<li><a href="/logout">退出</a></li>--}}
                    <li><img src="{{Auth::user()->avatar}}" class="img-circle" width="50"></li>
                @else
                <li><a href="/user/login">登录 </a></li>
                <li><a href="/user/register">注册 </a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
@yield('content')

{{--<script src="/js/jquery.js"></script>--}}
{{--<script src="/js/bootstrap.js"></script>--}}
<script>
    hljs.initHighlightingOnLoad();
    $.ajaxSetup({ //这段话的意思使用ajax,会将csrf加入请求头中
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>