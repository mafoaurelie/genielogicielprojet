<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Progressus - Free business bootstrap template by GetTemplate</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="home">
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header"  style="height=10 px;">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href=""><img  src="assets/images/logo.jpeg" alt="GESLOC" style="height:80px; width:200px; margin-top:-30px;  margin-left:-50px;"></a>
			</div>
			<div class="navbar-collapse collapse">
            @if (Route::has('login'))
				<ul class="nav navbar-nav pull-right">
				@auth
					<li class="active"><a  class="btn btn-alert"href="{{ url('/home') }}">Home</a></li>
				@else
					<li><a href="{{ route('login') }}">Connexion</a></li>
					@if (Route::has('register'))
					<li><a href="{{ route('register') }}">Créer Compte</a></li>
					<li><a class="btn" href="{{ route('admin') }}">Admin</a></li>
					@endif
					@endauth
				</ul>
			</div>
			@endif
<!--/.nav-collapse -->

		</div>
	</div> 
	<!-- /.navbar -->

	<!-- Header -->
	<header id="head">
		<div class="container">
			<div class="row">
				<h1 class="title m-b-md">  GESLOC</h1>
				<p class="tagline">GESLOC: Application de Gestion des Locations</p>
				<a href="/cities" class="btn btn-action btn-lg">Cité</a>
				<a class="btn btn-action btn-lg" role="button" href="/appartements">Appartements </a>
				<a class="btn btn-action btn-lg" role="button" href="/appartements">Studio </a>
			</div>
		</div>
	</header>
	<!-- /Header -->

	<!-- Intro -->
	<div class="container text-center">
		<br> <br>
		<h2 class="thin">Le meuilleur site en matierre de presentation de logement dans la ville de Dschang.</h2>
		<p class="text-muted">
			La différence avec d'autres application est que celle-ci vous donne les derniers informations sur l'actualitée des 
            logements dans la ville  de Dschang.Tout n'est que question de rapidité en informations.
        
		</p>
	</div>
	<!-- /Intro-->
		

	<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>+234 23 9873237<br>
								<a href="mailto:#">gildasamazonetsague@gmail.com</a><br>
								<br>
								234 
							</p>	
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Nous contacter</h3>
						<div class="widget-body">
							<p class="follow-me-icons">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								<a href=""><i class="fa fa-dribbble fa-2"></i></a>
								<a href=""><i class="fa fa-github fa-2"></i></a>
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>	
						</div>
					</div>


					<div class="col-md-6 widget">
						<h3 class="widget-title">Nos differents services:</h3>
						<div class="widget-body">
							<p>
							<ul>
							    Commerce générale
							</ul>
							<ul>
							    Batiment et travaux publics
							</ul>
							<ul>
							    promotion immolière
							</ul>
							<h3 class="widget-title">Nos differents services:</h3>


							</p>			
						</div>
						
					</div>
					

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Home</a> | 
								<a href="">About</a> |
								<a href="">Sidebar</a> |
								<a href="">Contact</a> |
								<b><a href="">Sign up</a></b>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2020, Your name. Designed by <a href="http://gettemplate.com/" rel="designer"></a> 
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

	</footer>	
		




	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>