@extends('pages.layout')


@section('content')

<div class="container">
  <br/><br/>
  <div class="col-md-8">
    {!! Form::open(array('url' => 'transaction/search', 'class' => 'contact-us-form')) !!}

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
          {!! Form::label('Transaction Id', '') !!}
          {!! Form::text( 'tx_id', null, array( 'class' => 'form-control', 'id' => 'tx_id', 'placeholder' => 'Transaction ID eg. 1075db55d416d3ca199f55b6084e2115b9345e16c5cf302fc80e9d5fbf5d48d', 'required')) !!}
     </div>



      <div class="form-group">
        {!! Form::submit( 'Search Block', array( 'class' => 'form-control btn btn-large btn-danger', 'id' => 'submit-message',  )) !!}
      </div>

  {!! Form::close() !!}
  </div>
</div>






@stop

