@extends('pages.layout')


@section('content')
<br>

<div class="">
  <br/><br/>
  <div class="container text-center site-header">
    {!! Form::open(array('url' => 'contact-us/submit', 'class' => 'contact-us-form')) !!}

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
          {!! Form::label('fullname', 'Search Bitcoin Address, Public Key or Transactions') !!}
          {!! Form::text( 'fullname', null, array( 'class' => 'form-control', 'id' => 'fullname', 'placeholder' => 'Transaction Id', 'required')) !!}
     </div>



      <div class="form-group">
        {!! Form::submit( 'Search Transactions', array( 'class' => 'form-control btn btn-large btn-danger', 'id' => 'submit-message',  )) !!}
      </div>

  {!! Form::close() !!}
  </div>
</div>






@stop

