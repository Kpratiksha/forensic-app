@extends('pages.layout')


@section('content')

<div class="container">

  <span class="page-header">
      <h1>Forgot Password</h1>
    <hr/>
  </span>

  <div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-4 change-password-panel">
  

<div class="panel panel-default">

  <div class="panel-body">


    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="login">
       <form method="POST" action="/forgot-password" accept-charset="UTF-8" class="login-form">
          

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
          <label for="email">Enter your emaill address</label>
          <input class="form-control" id="email" placeholder="Enter your email" required="required" name="email" type="text">
        </div>


        <div class="form-group">
          {!! Form::submit( 'Submit', array( 'class' => 'form-control btn btn-large btn-primary', 'id' => 'submit-message',  )) !!}
        </div>
        </form>
  </div>


</div>


</div>
</div>
</div>

  <br/><br/><br/> 

@stop


