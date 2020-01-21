@extends('pages.layout')


@section('content')

<div class="container">

  <span class="page-header">
      <h1>Change Password</h1>
    <hr/>
  </span>

  <div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-4 change-password-panel">
  

<div class="panel panel-default">

  <div class="panel-body">


    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="login">
       <form method="POST" action="/change-password" accept-charset="UTF-8" class="login-form">
          

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
          <label for="password">Enter new password</label>
          <input class="form-control" id="password" placeholder="Enter new password" required="required" name="password" type="password">
        </div>

        <div class="form-group">
          <label for="password">Confirm password</label>
          <input class="form-control" id="confirm_password" placeholder="Confirm password" required="required" name="confirm_password" type="password">
        </div>

        <div class="form-group">
          {!! Form::submit( 'Change Password', array( 'class' => 'form-control btn btn-large btn-primary', 'id' => 'submit-message',  )) !!}
        </div>
        </form>
  </div>


</div>


</div>
</div>
</div>

  <br/><br/><br/> 

<script>
    $('#flash-overlay-modal').modal();
</script>

@stop


