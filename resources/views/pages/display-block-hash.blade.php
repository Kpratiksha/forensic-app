@extends('pages.layout')


@section('content')
<br>

<div class="container">
  <br/><br/>


@if (isset($result))
<div id="" class="col-md-8">
  <div class="">
   <h3>Details of block: <h3/>
	 <h4>{{ $request->block_hash }} <h4/>
  </div>

<pre id="jsondata" class="jsondata" style=""> {{ $result }}</pre>
<button id="generate-pdf">Download as PDF</button>

</div>

	<div id="" class="col-md-4">

  <br/><br/><br/><br/><br/>

    @if(count($metadata) > 0)
    <div id="" class="well" style="">
      <ol>
      @foreach($metadata as $data)
        <li>{{ $data->metadata }}</li>
      @endforeach
      </ol>
      </div>
    @endif



	<div id="" class="" style="">
		{!! Form::open(array('url' => 'block-hash/add', 'class' => 'well')) !!}

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
          <input required="required" name="block_hash" type="hidden" value="{{ $request->block_hash }}" />
     </div>


      <div class="form-group">
          {!! Form::label('Block Metadata', '') !!}
          {!! Form::text( 'metadata', null, array( 'class' => 'form-control', 'id' => 'metadata', 'placeholder' => 'eg. This block has transactions that have been involved in illicit activities.', 'required')) !!}
     </div>


      <div class="form-group">
        {!! Form::submit( 'Add metadata', array( 'class' => 'form-control btn btn-info', 'id' => '',  )) !!}
      </div>

  {!! Form::close() !!}



	 </div>


	</div>

@endif

</div>






@stop

