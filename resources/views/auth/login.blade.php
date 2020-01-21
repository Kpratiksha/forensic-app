@extends('pages.layout')


@section('content')

<div class="container">

  <span class="page-header">
      <h1>Authentication</h1>
    <hr/>
  </span>

  <div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-4 login-panel">
  

<div class="panel panel-default">

  <div class="panel-body">
    <div class="login-register">
      <ul class="nav nav-tabs" id="myTabs">
        <li role="presentation" class="active"><a href="#login"><span>Login</span></a></li>
        <li role="presentation"  class=""><a href="#register"><span>Register</span></a></li>
      </ul>
    </div>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="login">
       <form method="POST" action="/login" accept-charset="UTF-8" class="login-form">
          
        <br/><br/>
        @if ( $errors->any() )
         <ul class="alert alert-danger">
            @foreach( $errors->all() as $message )
              <li>{{ $message }}</li>
            @endforeach
          </ul>
        @endif

      @if (session()->has('flash_notification.message'))
          <div class="alert alert-{{ session('flash_notification.level') }}">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {!! session('flash_notification.message') !!}
          </div>
      @endif
      
        {!! csrf_field() !!}
        
        <div class="form-group">
          <label for="login-email">Email Address</label>
          <input class="form-control" id="login-email" placeholder="Enter your email" required="required" name="email" type="text" value="{{ old('login-email') }}">
        </div>
      
        <div class="form-group">
          <label for="login-password">Password</label>
          <input class="form-control" id="login-password" placeholder="Enter your password" required="required" name="password" type="password">
        </div>

        <div class="form-group">
          {!! Form::submit( 'Login', array( 'class' => 'form-control btn btn-large btn-primary', 'id' => 'submit-message',  )) !!}
        </div>

      <div  class="forgot-password">
        <a href="/forgot-password">Forgot Password?</a>
        </div>

        </form>
  </div>

  <div role="tabpanel" class="tab-pane" id="register">
    <form method="POST" action="/register" accept-charset="UTF-8" class="login-form">
        <br/><br/>
        @if ( $errors->any() )
         <ul class="alert alert-danger">
            @foreach( $errors->all() as $message )
              <li>{{ $message }}</li>
            @endforeach
          </ul>
        @endif

        {!! csrf_field() !!}
        
        <div class="form-group">
            <label for="fullname">Your Fullname</label>
            <input class="form-control" id="fullname" placeholder="Enter your fullname" required="required" name="fullname" type="text" value="{{ old('fullname') }}">
       </div>

        <div class="form-group">
          <label for="register-email">Email Address</label>
          <input class="form-control" id="register-email" placeholder="Enter your email" required="required" name="email" type="text" value="{{ old('register-email') }}">
        </div>
      
        <div class="form-group">
          <label for="register-password">Password</label>
          <input class="form-control" id="register-password" placeholder="Enter your password" required="required" name="password" type="password">
        </div>

        <div class="form-group">
          <label for="register-password">Password Confirmation</label>
          <input class="form-control" id="register-password" placeholder="Enter your password" required="required" name="password_confirmation" type="password">
        </div>

        <div class="form-group">
          {!! Form::submit( 'Register', array( 'class' => 'form-control btn btn-large btn-primary', 'id' => 'submit-message',  )) !!}
        </div>
    </form>
  </div>

   
</div>


</div>
</div>
</div>

  <br/><br/><br/> 

@stop


