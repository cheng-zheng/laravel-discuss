@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">
                    <img src="{{Auth::user()->avatar}}" width="120" class="img-circle">
                    {!! Form::open(['url'=>'/user/avatar','files'=>true]) !!}
                    {!! Form::file('avatar') !!}
                    <div>
                        {!! Form::submit('上传头像',['class'=>'btn btn-primary pull-right']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop