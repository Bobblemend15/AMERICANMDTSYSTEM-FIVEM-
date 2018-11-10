<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 256);

if($permCheck == false OR !isset($_GET['uid'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}

	//if(!isset($_GET['uid'])){
	//	echo '<meta http-equiv="refresh" content="0; url=error.php" />';
	//}

	$user = getUserInfo($_GET['uid']);

	 if(memberOfGroup($_GET['uid'],14) == true && memberOfGroup($UserArray['userid'],14) == false){
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
	};
?>

<title>PDRP Network - Edit User: <?php echo $user['first_name']; ?> <?php echo $user['surname']; ?></title>

	<div class="container" style="margin-top: 25px;">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="card custom-card">
					<div class="card-header">
						Edit User: <?php echo $user['first_name']; ?> <?php echo $user['surname']; ?>
					</div>
					<div class="card-body">
						<?php
						if(isset($_POST['updateBasic'])) { 
							$steamid = $con->escape_string($_POST['steamid']);
							updateUser($UserArray['userid'],$user['userid'],$_POST['first_name'],$_POST['surname'],$steamid,$_POST['email'],$_POST['collar'],$_POST['password']);
						?>
						<div class="alert alert-success" role="alert"><b>User Updated</b> This user has been updated.</div>
						<?php
						}
						?>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?uid=<?php echo $user['userid']; ?>" method="post">
							<div class="row">
                            	<div class="form-group col-md-6">
                                	<label for="channel">First Name</label>
                                	<input type="text" class="form-control" name="first_name" value="<?php echo $user['first_name']; ?>" required>
                            	</div>
                            	<div class="form-group col-md-6">
                                	<label for="channel">Last Name</label>
                                	<input type="text" class="form-control" name="surname" value="<?php echo $user['surname']; ?>" required>
                            	</div>
                            	<div class="form-group col-md-6">
                                	<label for="channel">Username</label>
                                	<input type="text" class="form-control" name="collar" value="<?php echo $user['collar']; ?>" required>
                            	</div>
                            	<div class="form-group col-md-6">
                                	<label for="channel">Steamid</label>
                                	<input type="text" class="form-control" name="steamid" value="<?php echo $user['steamid']; ?>">
                            	</div>
                            	<div class="form-group col-md-12">
                                	<label for="channel">Email</label>
                                	<input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                            	</div>
                            	<div class="form-group col-md-12">
                                	<label for="channel">Password (Empty if not changing)</label>
                                	<input type="password" class="form-control" name="password">
                            	</div>
                            </div>
                            <div class="form-group" style="width: 100%;">
                       	    	<input type="submit" name='updateBasic' class="btn btn-success btn-block" value="Update Basic Info">
                        	</div>
                        </form>
					</div>
				</div>
				<br>
				<div class="card custom-card">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="channel">Last IP:</label>
								<input type="text" class="form-control" value="<?php echo $user['last_ip']; ?>" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="card custom-card">
					<div class="card-header">
						Usergroups
					</div>
					<div class="card-body">
						<?php
						if(isset($_POST['updateGroups'])) { 
							$groups    = getUserGroups();
							$ugroups = '';
					
							foreach($groups as $group){
					
								if( isset($_POST['ugroup-' . $group['id']]) ) {
							
									$ugroups .= $group['id'] . ",";

								}
							}

							updateUsersGroups($UserArray['userid'],$user['userid'],$ugroups);
						?>
						<div class="alert alert-success" role="alert"><b>User Updated</b> This user has been updated.</div>
						<?php
						}
						?>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?uid=<?php echo $user['userid']; ?>" method="post">
							<div class="row">
								<div class="form-group col-md-12">
									<?php
										$groups = getUserGroups();
										foreach($groups as $group){
											if($group['id'] == 14){
												if(memberOfGroup($UserArray['userid'],14) == true){
									?>
									<input type="checkbox" name="ugroup-<?php echo $group['id']; ?>" value="<?php echo $group['id']; ?>" class="usergroupscheck" <?php if(memberOfGroup($user['userid'], $group['id']) == true){ ?> checked="" <?php } ?> /> <?php echo $group['name']; ?> <br />
									<?php
												}
											}else{
									?>
									<input type="checkbox" name="ugroup-<?php echo $group['id']; ?>" value="<?php echo $group['id']; ?>" class="usergroupscheck" <?php if(memberOfGroup($user['userid'], $group['id']) == true){ ?> checked="" <?php } ?> /> <?php echo $group['name']; ?> <br />
									<?php
											}
										}
									?>
								</div>
							</div>
							<div class="form-group" style="width: 100%;">
                       	    	<input type="submit" name='updateGroups' class="btn btn-success btn-block" value="Update Groups">
                        	</div>
						</form>
			</div>
		</div>
	</div>