<?php

?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 1);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>


<title>PDRP Network - Settings Page</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">User Information</div>
				<div class="card-body">
					<p class="col-md-12 text-danger">This Information cannot be updated by you!</p>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">First Name</label>
    						<input type="text" class="form-control" value="<?php echo $UserArray['first_name']; ?>" disabled>
  						</div>
                        <div class="form-group col-md-12">
                            <label for="channel">Username</label>
                            <input type="text" class="form-control" value="<?php echo $UserArray['collar']; ?>" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Signup Date</label>
                            <input type="text" class="form-control" value="<?php echo date('jS F Y', $UserArray['joindate']); ?>" disabled>
                        </div>
  						<div class="form-group col-md-12">
                            <label for="channel">Last IP</label>
                            <input type="text" class="form-control" value="<?php echo $UserArray['last_ip']; ?>" disabled>
                        </div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Change Password</div>
				<div class="card-body">
					<p class="col-md-12 text-danger">You will be signed out on update!</p>
					<?php
						if(isset($_POST['changePassword'])) { 
			  	  			changePassword($UserArray['userid'],$_POST['new_pass'],$_POST['confirm_pass']);
                    ?>
                    <div class="alert alert-success"><b>Account Updated</b> Your account has been updated.</div>
                    <?php
                        wait(5);
                         echo '<meta http-equiv="refresh" content="0; url=signOut.php" />';
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">Password</label>
    						<input type="password" class="form-control" name="new_pass">
  						</div>
                        <div class="form-group col-md-12">
                            <label for="channel">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_pass">
                        </div>
  						<div class="form-group col-md-12">
							<input type="submit" name='changePassword' class="btn btn-success btn-block" value="Update Account">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
