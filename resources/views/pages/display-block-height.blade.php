@extends('pages.layout')


@section('content')
<br>

<div class="container">
  <br/><br/>


@if (isset($result))
<div id="" class="col-md-8">

  <div class="">
    <h3> Hash of block number {{ $request->block_height }} is: <h3/>
  </div>



<pre id="jsondata" class="jsondata" style=""> {{ $result }}</pre>
<!-- <button id="generate-pdf">Download as PDF</button> -->

</div>

	<div id="" class="col-md-4">


	</div>

@endif

</div>






@stop

