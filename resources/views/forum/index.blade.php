@extends('app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>Welcome discuss
                {{--@if(Auth::check())--}}
                <a class="btn btn-primary btn-lg pull-right" href="/discussions/create" role="button">发布新帖</a>
                {{--@endif--}}
            </h2>
        </div>
    </div>
    <!--    测试    -->
    {{--<div>
        <input class="weui-input" type="text" name="remarks" placeholder="">
        <button id="sbumit">sbumit</button>
    </div>--}}
    <script>

        window.onload = function(){

            $('#sbumit').on('click',function(){
                $.ajax({
                    type    : "POST",
                    url     : "/test",
                    data    : {
                        'remarks': $('input[name=remarks]').val(),
                        'test':'sb'
                    },
                    success : function(resource){

                        //console.log(resource);
                    }
                });
            });

        }
    </script>
    <!--    测试    -->
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-conversation-meta">
                                    <span class="media-conversation-replies">
                                        <a href="/discussion/154#reply">{{count($discussion->comments)}}</a>
                                        回复
                                    </span>
                        </div>
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" alt="32x32" src="{{$discussion->user->avatar}}" width="32px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="/discussions/{{$discussion->id}}">{{$discussion->title}}</a></h4>
                            <span class="media-name">{{$discussion->user->name}}</span>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop