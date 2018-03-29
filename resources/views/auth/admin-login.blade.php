@extends('layouts.app')

@section('content')
<div id="particles-js"></div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="loginHead">
                <h4><i class="fa fa-lock"></i> &nbsp;Admin Login</h4>
            </div>
            <div class="panel panel-default" id="loginForm">
            

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.login.submit') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label"><i class="fa fa-envelope"></i></label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter Email">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-2 control-label"><i class="fa fa-eye"></i></label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                           <div class="col-md-8 col-md-offset-2">
                               <div class="checkbox">
                                   <label>
                                       <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                   </label>
                               </div>
                           </div>
                       </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                  <i class="fa fa-sign-in"></i>  Login
                                </button>                        
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <a class="btn btn-link" href="{{ url('/login') }}">
                                    You Are user?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
