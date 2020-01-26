@extends('pages.layout')


@section('content')
<br>

<div class="container">
  <br/><br/>


@if (isset($result))
<div id="" class="col-md-8">
  <h3>Wallets Address: {{ $request->address }} <h4/>


<pre id="jsondata" class="jsondata" style=""> {{ $result }}</pre>
<button id="generate-pdf">Download as PDF</button>

</div>

	<div id="" class="col-md-4">


	<div id="" class="well" style=""> Flagged information </div>

	<div id="" class="" style="">
		{!! Form::open(array('url' => 'flag-information/submit', 'class' => 'well')) !!}

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
          {!! Form::label('transaction_id', '') !!}
          {!! Form::text( 'transaction_id', null, array( 'class' => 'form-control', 'id' => 'transaction_id', 'placeholder' => 'Transaction ID eg. 1075db55d416d3ca199f55b6084e2115b9345e16c5cf302fc80e9d5fbf5d48d', 'required')) !!}
     </div>



      <div class="form-group">
        {!! Form::submit( 'Search Block', array( 'class' => 'form-control btn btn-info', 'id' => '',  )) !!}
      </div>

  {!! Form::close() !!}



	 </div>


	</div>

@endif

</div>






@stop

