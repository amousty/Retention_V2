<?php
	header('content-type: application/xhtml+xml;charset=utf-8');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>Retention</title>

		<!-- CSS -->
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Kreon:300,400,700' rel='stylesheet' type='text/css'/>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="fonts/css/font-awesome.min.css"/>

		<!-- javascript -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		 <!--[if lt IE 9]>
		     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="footer_bg" id="signin-div"><!-- start signin -->
		<div class="container">
			<div class="row footer">
				<div class="col-md-8 contact_left">
					<h3>Get connected</h3>
					<p>You have to be logged in in order to play with your friends at Retention</p>
					<form method="get" id="signin-form" action="php/login.php">
						<input id="login-signin" type="text" value="Jean" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}"/>
						<input id="pwd-signin" type="password" value="pass" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}"/>
						<span class="pull-right"><input type="submit" value="Sign in"></input></span>
					</form>
				</div>
				<div class="col-md-4  contact_right">
					<img src="images/logo-ret.png" alt="" class="responsive" />
				</div>
			</div>
		</div>
		</div>

		<div class="footer_bg" id="signup-div"><!-- start signup -->
		<div class="container">
			<div class="row footer">
				<div class="col-md-8 contact_left">
					<h3>Create your account</h3>
					<p>You have to be registered and logged in in order to play with your friends at Retention</p>
					<form method="post" id="signup-form" action="php/register.php">
						<input id="login-signup" type="text" value="Email (Required)" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}"/>
						<input id="pwd-signup" type="text" value="Password (1) (Required)" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password (1)';}"/>
						<input id="pwd2-signup" type="text" value="Password (2) (Required)" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password (2)';}"/>
						<span class="pull-right"><input type="submit" value="Sign up"></input></span>
					</form>
				</div>
				<div class="col-md-4  contact_right">
					<img src="images/logo-ret.png" alt="" class="responsive" />
				</div>
			</div>
		</div>
		</div>


		<script type="text/javascript" src="js/index.js"></script>
	</body>
</html>
