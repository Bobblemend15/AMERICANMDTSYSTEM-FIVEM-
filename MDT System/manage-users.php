<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 256);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$users = getUsers();
?>

<title>PDRP Network - Manage Users</title>

<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
        <div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card custom-card">
				<div class="card-header">
					Manage Users
				</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
   						<tr>
   							<th scope="col">Reference</th>
   							<th scope="col">Username</th>
	     					<th scope="col">Name</th>
   							<th scope="col">Steamid</th>
   							<th scope="col">Last IP</th>
                            <th scope="col">Actions</th>
 						</tr>
					</thead>
	  				<tbody>
	  					<?php
	  					foreach($users as $user){
                  if(memberOfGroup($user['userid'],14) == false || (memberOfGroup($user['userid'],14) == true && memberOfGroup($UserArray['userid'],14) == true)){
	  					?>
    					<tr <?php if(haveGeneralPerm($user['userid'], 1) == false){ ?> class="state4" <?php }elseif(memberOfGroup($user['userid'],14) == true){ ?> class="state99" <?php }else{ ?> class="state2" <?php } ?>>
    						<th scope="row"><?php echo $user['userid']; ?></th>
    						<th><?php echo $user['collar']; ?></th>
    						<th><?php echo $user['first_name']; ?>.<?php echo $user['surname']; ?></th>
    						<th><?php echo $user['steamid']; ?></th>
                            <th><?php echo $user['last_ip']; ?></th>
	      					<td><a href="./editUser.php?uid=<?php echo $user['userid']; ?>">Edit User</a></td>
    					</tr>
    					<?php
                            }
    					}
    					?>
  					</tbody>
				</table>
			</div>
      <br>
		</div>
	</div>