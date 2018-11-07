<?php

?>
<?php

session_start();
$session_id = session_id();

// require_once( "./_assets/php/connection.php" );
require("./_assets/php/helper.php");

date_default_timezone_set('America/New_York');

$sessionQuery = $con->query("SELECT id,user_id FROM mdt_sessions WHERE session_id = '{$session_id}'");
$sessionArray = mysqli_fetch_assoc($sessionQuery);

if($sessionQuery->num_rows == 0){
    header("location: login.php");
    exit;
}

$UserArray = getUserInfo($sessionArray['user_id']);

?>
<html>
<head>
	<link rel="stylesheet" href="./_assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./_assets/css/custom.css">
	<link rel="stylesheet" href="./_assets/css/status.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
	<script src="_assets/js/bootstrap.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
	<nav class="navbar main-nav navbar-expand-lg fixed-top">
		<div class="container">
			<button class="navbar-toggler m1-1" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
				<span class="navbar-toggler-icon"><i style="margin-top: 5px; color: white;" class="fa fa-list"></i></span>
			</button>
			<button class="navbar-toggler m1-1" type="button">
				<span class="navbar-toggler-icon"><a href="./"><i style="margin-top: 5px; color: white;" class="fa fa-home"></i></a></span>
				<span class="navbar-toggler-icon"><a href="./signOn.php"><i style="margin-top: 5px; color: white;" class="fa fa-user"></i></a></span>
				<span class="navbar-toggler-icon"><a href="./signOut.php"><i style="margin-top: 5px; color: white;" class="fa fa-sign-out-alt"></i></a></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="m1-1 navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="./">DASHBOARD</a>
					</li>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 2);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							DISPATCH
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./control-operator.php">Call Overview</a>
							<?php
								$permCheck = haveGeneralPerm($UserArray['userid'], 4);
								if($permCheck == true){
							?>
							<a class="dropdown-item" href="./control-dispatcher.php">Assign Calls</a>
							<?php
								}
							?>
							<?php
								$permCheck = haveGeneralPerm($UserArray['userid'], 8);
								if($permCheck == true){
							?>
							<a class="dropdown-item" href="./control-tacad.php">Dismiss Calls</a>
							<?php
								}
							?>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 16);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							CIVILIAN
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./civilian-civs.php">Create Civilian</a>
							<a class="dropdown-item" href="./civilian-vehicles.php">Create Vehicle</a>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 32);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							BOLO
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./intel-pois.php">Persons of Interest</a>
							<a class="dropdown-item" href="./intel-vois.php">Vehicles of Interest</a>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 64);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							REPORTS
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./cad-reports.php">Submit a Incident Report</a>
							<a class="dropdown-item" href="./phone999.php">Submit 911 Call Report</a>
							<a class="dropdown-item" href="./intel-cad-reports.php">Incident Report Log</a>
							<a class="dropdown-item" href="./cad-history.php">Call Report Log</a>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 128);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							CAD
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./signOn.php">Go On Duty</a>
							<a class="dropdown-item" href="./pnc-check-search.php">Civilian Lookup</a>
							<a class="dropdown-item" href="./vrm-check-search.php">License Plate Lookup</a>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 256);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							ADMIN
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./manage-users.php">Manage Accounts</a>
							<a class="dropdown-item" href="./newUser.php">New Account</a>
							<hr>
							<?php
							if(haveGeneralPerm($UserArray['userid'], 1024) == true){
							?>
							<a class="dropdown-item panic" href="./admin-logs.php">View Logs</a>
							<a class="dropdown-item panic" href="./admin-groups.php">View Groups</a>
							<?php
							}
							?>
						</div>
					</li>
					<?php
						}
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php echo strtoupper($UserArray['collar']); ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./profile.php">Profile</a>
							<a class="dropdown-item" href="./user-settings.php">Settings</a>
							<a class="dropdown-item" href="./signOut.php">Sign Out</a>
						</div>
					</li>
      			</ul>
			</div>
		</div>
	</nav>