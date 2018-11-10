<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 1024);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$logs = getAdminLogs();
?>


<title>PDRP Network - View Logs</title>


<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-2">
					<div class="btn state99 btn-block" onclick="filter('Admin')">Admin Logs</div>
				</div>
				<div class="col-md-2">
					<div class="btn state97 btn-block" onclick="filter('Session')">Session Logs</div>
				</div>
				<div class="col-md-2">
					<div class="btn state6 btn-block" onclick="filter('Security')">Failed Logins</div>
				</div>
				<div class="col-md-2">
					<div class="btn state9 btn-block" onclick="filter('Civilian-Management')">Civilian Logs</div>
				</div>
				<div class="col-md-2">
					<div class="btn state23 btn-block" onclick="filter('Calls')">Call Logs</div>
				</div>
				<div class="col-md-2">
					<div class="btn state11 btn-block" onclick="filter('All')">Show All</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
        <div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card custom-card">
				<div class="card-header">
					Admin Logs
				</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
   						<tr>
   							<th scope="col">Reference</th>
                <th scope="col">User</th>
   							<th scope="col">Type</th>
	     					<th scope="col">Action</th>
   							<th scope="col">Dateline</th>
 						</tr>
					</thead>
	  				<tbody>
	  					<?php
	  					foreach($logs as $log){
	  					?>
    					<tr id="<?php echo preg_replace("/[\s_]/", "-", $log['category']); ?>" 
    						<?php if($log['category'] == 'Admin'){ ?> class="state99" 
    						<?php }elseif($log['category'] == 'User Management'){ ?> class="state97" 
    						<?php }elseif($log['category'] == 'Tag Management'){ ?> class="state7" 
    						<?php }elseif($log['category'] == 'Security' && substr(getUserInfo($log['user'])['collar'],0,3) == '221'){ ?> class="GCSecurity" 
    						<?php }elseif($log['category'] == 'Security'){ ?> class="state6" 
    						<?php }elseif($log['category'] == 'Calls'){ ?> class="state23" 
    						<?php }elseif($log['category'] == 'Civilian Management'){ ?> class="state9" 
    						<?php }else{ ?> class="state97" 
    					<?php } ?>>
    						<th scope="row"><?php echo $log['logid']; ?></th>
    						<th><?php if($log['user'] == 0) { ?>SYSTEM<?php }else{ ?><?php echo getUserInfo($log['user'])['first_name'] . ' ' . getUserInfo($log['user'])['surname']; ?><?php } ?></th>
    						<th><?php echo $log['category']; ?></th>
    						<td><?php echo $log['content']; ?></td>
                <td><?php echo date('m\/d\/Y \a\t G\:i', $log['dateline']); ?></td>
    					</tr>
    					<?php
    					}
    					?>
  					</tbody>
				</table>
			</div>
		</div>
	</div>

<script> 
function filter(category){
	if(category == 'All'){
		$('#admin, #security, #session, #civilian-management, #calls').show();
	}else if(category == 'Admin'){
		$('#admin, #security, #session, #civilian-management, #calls').show();
		$('#security, #session, #civilian-management, #calls').hide();
	}else if(category == 'Session'){
		$('#admin, #security, #session, #civilian-management, #calls').show();
		$('#security, #Admin, #civilian-management, #calls').hide();
	}else if(category == 'Security'){
		$('#admin, #security, #session, #civilian-management, #calls').show();
		$('#admin, #session, #civilian-management, #calls').hide();
	}else if(category == 'Civilian-Management'){
		$('#admin, #security, #session, #civilian-management, #calls').show();
		$('#admin, #session, #security, #calls').hide();
	}else if(category == 'Calls'){
		$('#admin, #security, #session, #civilian-management, #calls').show();
		$('#admin, #session, #security, #civilian-management').hide();
	}
}
</script>