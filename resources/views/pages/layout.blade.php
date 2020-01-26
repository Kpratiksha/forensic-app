<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="/css/app.css" >
		<link rel="stylesheet" href="/plugins/bootstrap-social/bootstrap-social.min.css" >
		<link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css" >
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	</head>
	<body>

	<!-- Nav Container -->
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">

				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-head-collapse">
						<span class="sr-only"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Forensic App</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-head-collapse">
					<ul class="nav navbar-nav">

						<li class=""><a href="/">Block Height</a></li>
						<li class=""><a href="/block-hash">Block Hash</a></li>
						<li class=""><a href="/transaction">Transaction</a></li>
						<li class=""><a href="/address">Wallet Address</a></li>

					</ul>
				</div><!-- /.navbar-collapse -->



			</div>
		</nav>


<!-- Header Container -->
	<noscript><div class="container"><br/><div class="nonoscript alert alert-danger">JavaScript has been disabled on this browser. This website cannot function without JavaScript, therefore please enable it inorder to use the website.</div> </div> </noscript>

<div class="">
	<div class="">

	</div>
</div>



<!-- Body Container -->
<div class="">
	@yield('content')
</div>


<script src="https://code.jquery.com/jquery-2.2.3.min.js"  ></script>
<script src="https://github.com/zachofalltrades/jquery.format/blob/master/jquery.format.js"  ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>

<script type="text/javascript">

    var jsonObj = JSON.parse(document.getElementById("jsondata").innerHTML);
    document.getElementById("jsondata").innerHTML = JSON.stringify(jsonObj, undefined, 4);
    document.getElementById("jsondata").style.display = 'block';


	var doc = new jsPDF();
	var specialElementHandlers = {
	    '#jsondata': function (element, renderer) {
	        return true;
	    }
	};

	$('#generate-pdf').click(function () {
	    doc.fromHTML($('#jsondata').html(), 15, 15, {
	        'width': 170, 'elementHandlers': specialElementHandlers
	    });
	    doc.save('sample-file.pdf');
	});


</script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

	</body>
</html>


