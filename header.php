<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>NewBee</title>
	<link rel="icon" type="image/jpg" href="logo.jpg">
  	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="crossorigin="anonymous">
		</script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
		<nav class="navbar navbar-inverse fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">NewBee</a>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>	    
	
				</div>

				<div id="mynavbar" class="collapse navbar-collapse">
					<form class="navbar-form navbar-center" style="color: white; font-family: Comic Sans MS; font-size: 1.3em;">
			      <div class="input-group">				
				<?php
					if (isset($_SESSION['u_id'])) {
						echo "Welcome"." ";
						echo ucfirst($_SESSION['u_first'])." ".ucfirst($_SESSION['u_last']);
					}
				?>
			</div></form>
			<div class="input-group" style="float: right;">
				<?php
					if (!isset($_SESSION['u_id'])) {
						echo '<button class="navbar-form btn btn-primary" style="padding: 0.5em;" onclick="signup()"> Sign up</button>';		
					}
				?>		
			 </div>
					<div class="navbar-form input-group">
					<?php
						if (isset($_SESSION['u_id'])) {
							echo '<form action="logout.inc.php" method="POST">
							<button class="btn btn-primary" type="submit" name="submit">Logout</button>
							</form>';		
						} else {
							echo '<form action="login.inc.php" method="POST">
							<input type="text" name="uid" placeholder="username/email" required>
							<input type="password" name="pwd" placeholder="password" required>
							<button class="btn btn-primary" type="submit" name="submit">Login</button>
							</form>';		
						}
					?>	
					</div>
			    
					

			    <ul class="nav navbar-nav">
					<li class="active"><a href="index.php">
						<span class="glyphicon glyphicon-home"></span> Home</a>
					</li>
			<!--	<li class="dropdown active">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="index.php">
				        <span class="glyphicon glyphicon-bell"></span> Notifications<span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          <li><a href="#">Sudhenndra is great</a></li>
				          <li><a href="#">Sudheendra is RLB</a></li>
				          <li><a href="#">Sudheendra is ultimate</a></li>
				        </ul>
				    </li>
			-->		
				<?php
						if (isset($_SESSION['u_id'])) {
							echo '<li class="active"><a href="notifications.php">
							<span class="glyphicon glyphicon-bell"></span> Notifications</a>
							</li>';		
						}
				?>
					<li class="active"><a href="about.php">
						<span class="glyphicon glyphicon-stats"></span> About</a>
					</li>
				</ul>
			   
				<?php
						if (isset($_SESSION['u_id'])) {
							echo '<form class="navbar-form navbar-right" method="POST" action="search.php">
			      <div class="input-group">
			        <input type="text" class="form-control" placeholder="Search for Users" name="search">
			        <div class="input-group-btn">
			          <button class="btn btn-default" name="searchuser" type="submit">
			            <i class="glyphicon glyphicon-search"></i>
			          </button>
			        </div>
			      </div>
			    </form>';
			}
?>		
				</div>
			
				


		</div>
	</nav>

<section class="main-container" style="background-color: silver">
						<div  id="signupform" class="main-wrappper" style="display: none; background-color: gainsboro; text-align: center; padding: 0.5em; width: auto;border-radius: 3em;">
							<h2>Sign up</h2>
							<form action="signup.inc.php" method="POST" style="padding: 0.1em; text-align: center; font-size: 1.2em;">
								<label for="first">First Name: </label> <br>
								<input type="text" name="first" style="text-transform: capitalize;" placeholder="Firstname" required> <br>
								<label for="first">Last Name: </label> <br>
								<input type="text" name="last" style="text-transform: capitalize;" placeholder="Lastname" required> <br>
								<label for="first">Email ID: </label> <br>
								<input type="text" name="email" placeholder="E-mail" required> <br>
								<label for="first">Username: </label> <br>
								<input type="text" name="uid" placeholder="Username" required> <br>
								<label for="first">Password: </label> <br>
								<input type="password" name="pwd" placeholder="Password" required> <br>
								<button class="navbar-form btn btn-primary" style="padding: 1em;" type="submit" name="submit">Sign up</button>
							</form>
						</div>
						</section>


	
<script type="text/javascript">
	function signup() {
		document.getElementById('signupform').style.display = "block";
	}
	if (history.previous)
{
    document.location="index.php";
}
	
</script>