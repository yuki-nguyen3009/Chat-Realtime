@extends('layouts.app')


@section ('additional_css')

    <style>
        body{
            background-color: #1cbb9b;
        }
        .login-box{
            position:relative;
            margin: 10px auto;
            width: 500px;
            height: auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 3px;
            -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.33);
            -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.33);
            box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.33);
        }
        .lb-header{
            position:relative;
            color: #00415d;
            margin: 5px 5px 10px 5px;
            padding-bottom:10px;
            border-bottom: 1px solid #eee;
            text-align:center;
            height:28px;
        }
        .lb-header a{
            margin: 0 25px;
            padding: 0 20px;
            text-decoration: none;
            color: #666;
            font-weight: bold;
            font-size: 15px;
            -webkit-transition: all 0.1s linear;
            -moz-transition: all 0.1s linear;
            transition: all 0.1s linear;
        }
        .lb-header .active{
            color: #029f5b;
            font-size: 18px;
        }
        .social-login{
            position:relative;
            float: left;
            width: 100%;
            height:auto;
            padding: 10px 0 15px 0;
            border-bottom: 1px solid #eee;
        }
        .social-login a{
            position:relative;
            float: left;
            width:calc(40% - 8px);
            text-decoration: none;
            color: #fff;
            border: 1px solid rgba(0,0,0,0.05);
            padding: 12px;
            border-radius: 2px;
            font-size: 12px;
            text-transform: uppercase;
            margin: 0 3%;
            text-align:center;
        }
        .social-login a i{
            position: relative;
            float: left;
            width: 20px;
            top: 2px;
        }
        .social-login a:first-child{
            background-color: #49639F;
        }
        .social-login a:last-child{
            background-color: #DF4A32;
        }

        .u-form-group input[type="email"],
        .u-form-group input[type="password"]{
            width: calc(50% - 22px);
            height:45px;
            outline: none;
            border: 1px solid #ddd;
            padding: 0 10px;
            border-radius: 2px;
            color: #333;
            font-size:0.8rem;
            -webkit-transition:all 0.1s linear;
            -moz-transition:all 0.1s linear;
            transition:all 0.1s linear;
        }
        .u-form-group input:focus{
            border-color: #358efb;
        }
        .u-form-group button{
            width:50%;
            background-color: #1CB94E;
            border: none;
            outline: none;
            color: #fff;
            font-size: 14px;
            font-weight: normal;
            padding: 14px 0;
            border-radius: 2px;
            text-transform: uppercase;
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <div class="login-box">
            <div class="lb-header">
                <a href="#" class="active" id="login-box-link">Login</a>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="social-login">
                    <a href="#">
                        <i class="fa fa-facebook fa-lg"></i>
                        Login in with facebook
                    </a>
                    <a href="#">
                        <i class="fa fa-google-plus fa-lg"></i>
                        log in with Google
                    </a>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                            Forgot Your Password?
                        </a>
                    </div>


                </div>
                <div class="form-group">

                    <p class="col-md-8 col-md-offset-4">
                        Have no account?? <a class="btn btn-link" href="{{ url('/register') }}">
                            Register
                        </a>
                    </p>

                </div>


            </form>
        </div>
    </div>

@endsection
