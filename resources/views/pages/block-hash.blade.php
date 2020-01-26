@extends('pages.layout')


@section('content')

<div class="container">
  <br/><br/>
  <div class="col-md-8">
    {!! Form::open(array('url' => 'block-hash/search', 'class' => 'contact-us-form')) !!}

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
          {!! Form::label('block_hash', '') !!}
          {!! Form::text( 'block_hash', null, array( 'class' => 'form-control', 'id' => 'block_hash', 'placeholder' => 'Block Hash eg. 0000000000000000000a8eea6fec94fbc227334f50ed92611bdafcfead4b6493', 'required')) !!}
     </div>



      <div class="form-group">
        {!! Form::submit( 'Search Block', array( 'class' => 'form-control btn btn-large btn-danger', 'id' => 'submit-message',  )) !!}
      </div>

  {!! Form::close() !!}
  </div>
</div>






@stop

