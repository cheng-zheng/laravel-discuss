@extends('app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" alt="64x64" src="{{$discussion->user->avatar}}" width="64px">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{$discussion->title}}</h4>
                    {{$discussion->user->name}}
                </div>
                @if(Auth::check() && Auth::user()->id == $discussion->user_id)
                <a class="btn btn-primary btn-lg pull-right" href="/discussions/{{$discussion->id}}/edit" role="button">修改帖子</a>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main" id="post">
                <div class="blog-nost">
                    {!! $html !!}
                </div>
                <hr>
                @foreach($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" alt="64x64" src="{{$comment->user->avatar}}" width="64px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->user->name}}</h4>
                            {{$comment->body}}
                        </div>
                    </div>
                @endforeach
                <div class="media" v-for="comment in comments">

                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" alt="64x64" :src="comments.avatar" width="64px">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">@{{comments.name}}</h4>
                        @{{comments.body}}
                    </div>
                </div>
                <hr>
                @if(Auth::check())
                {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitForm']) !!}
                {!! Form::hidden('discussion_id',$discussion->id) !!}
                <div class="form-group">
                    {!! Form::textarea('body', null, ['class'=>'form-control','v-model'=>'newComment.body']) !!}
                </div>
                <div>
                    {!! Form::submit('发表评论',['class'=>'btn btn-success pull-right']) !!}
                </div>
                {!! Form::close() !!}
                @else
                    <a href="/user/login" class="btn btn-block btn-success">登录评论</a>
                @endif
            </div>
        </div>
    </div>
    
    <script>
        var User = {id:0,name:'0',avatar:'0'};
        @if(Auth::check() && Auth::user()->id == $discussion->user_id)
            var User = {
                name  : '{{Auth::user()->name}}',
                avatar: '{{Auth::user()->avatar}}'
            }
            
        @endif
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
        new Vue({
            el:'#post',
            data:{
                comments:[],
                newComment:{
                    name  : User.name,
                    avatar: User.avatar,
                    body  : ''
                },
                newPost:{
                    discussion_id : '{{$discussion->id}}',
                    user_id       : User.id,
                    body          : ''
                }
            },
            methods:{
                onSubmitForm:function(e){
                    e.preventDefault();
                    var comment = this.newComment;
                    var post = this.newPost;
                    post.body = comment.body;
                    this.$http.post('/comment',post,function(){
                        this.comments.push(comment);
                    });
                    this.newComment = {
                        name  : User.name,
                        avatar: User.avatar,
                        body  : ''
                    }
                }
            }
        })
    </script>
@stop