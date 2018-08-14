@extends('layouts.app')


@section('additional_css')
    <style>

        body{
            background-color: #1cbb9b;
        }

        
        .panel-body{
            height: 50vh;
            overflow-y: scroll;
        }
    </style>
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    @foreach($users as $user)
                        <div class="row">
                        <div class="col-md-6">
                        {{$user->name}}
                        </div>
                        <div class="col-md-6">
                        {{Form::open(['url'=>route('conversation.store')])}}
                        {{Form::hidden('user_id',$user->id)}}
                        {{Form::submit('Add friend',['class'=>'btn btn-primary'])}}
                            <hr>
                        {{Form::close()}}
                        </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Friends</div>

                <div class="panel-body">
                    @foreach($conversations as $conversation)
                        <a href="{{route('conversation.show',$conversation->id)}}">
                            {{($conversation->user1()->first()->id==Auth::user()->id)?$conversation->user2()->first()->name:$conversation->user1()->first()->name}}
                        </a>
                        <hr/>
                    @endforeach
                </div>
            </div>
        </div>  

    </div>
</div>
@endsection
