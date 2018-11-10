<?php

?>
<?php
session_start();
require_once './_assets/php/connection.php';
require_once './_assets/php/helper.php';

$session_id = session_id();
$loggedcheck = $con->query("SELECT id FROM mdt_sessions WHERE session_id = '{$session_id}'");

if($loggedcheck->num_rows > 0){
    header("location: index.php");
    exit;
}

$collar = $password = "";
$collar_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["collar"]))){
        $collar_err = 'Please enter username.';
    } else{
        $collar = trim($_POST["collar"]);
    }
    
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    if(empty($collar_err) && empty($password_err)){
        $check = LogUserIn($collar, $password, $session_id);

        if($check == true){
            header("location: index.php");
            exit;
        }else{
            $password_err = 'Your username number or password was incorrect.';
            $collar_err = 'Your username number or password was incorrect.';
        }
    }

}
?>
<html>
<head>
	<title> PDRP Network MDT - Homepage </title>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="_assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/custom.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="login-content-holder">
        <div class="login-form-holder">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <h4 style="text-align: center;">Log In</h4>
	      						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		      					    <div class="form-group <?php echo (!empty($collar_err)) ? 'has-error' : ''; ?>">
                                        <b>Username:</b>
                				        <input type="text" name="collar"class="form-control" value="<?php echo $collar; ?>">
                				        <span class="help-block"><?php echo $collar_err; ?></span>
            					   </div>    
            					   <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <b>Password:</b>
                				        <input type="password" name="password" class="form-control">
                				        <span class="help-block"><?php echo $password_err; ?></span>
            				        </div>
            				        <div class="form-group">
                				        <input type="submit" class="btn btn-success btn-block" value="Login">
           		 			        </div>
							    </form>
						    </div>
                            <br>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <h4 style="text-align: center;">Information</h4>
                                <p>This Community portal is managed by PDRP Network™ and only authorized personnel can continue. <br><br> Please note your IP is <?php echo $_SERVER['REMOTE_ADDR']; ?> and all login attempts are recorded and closely monitored.</p>
                                <p>If you require an account please contact a member of Administration team.</p>
                            </div>
                        </div>
					</div>
				</div>
                <br />
                <div id="copyright" class="text-center text-white">
					<small>OM Solutions©2018</small></br>
                    <small>PDRP Network™ <?php echo date("Y"); ?></small>
                </div>
			</center>
		</div>
	</div>
</body>