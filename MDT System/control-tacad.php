<?php
?>
<?php include('./resources/layout/head.php'); ?>

<script type="text/javascript">
function testing(area){
	if (!document.getElementById(area)) {
		return true;
	}else{
		return false;
	}
}
</script>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 8);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$calls = getActiveCalls('DESC');
	$availableUnits = getAvailableUnits();
?>


<title>PDRP Network - Dismiss Call</title>

<div class="container-fluid" style="margin-top: 25px;">
	<div id="panicSection">
		<?php
		$num = $con->query("SELECT * FROM units WHERE status = 0")->num_rows;

			if($num > 0){

				$unit = mysqli_fetch_assoc($con->query("SELECT * FROM units WHERE status = 0"));
		?>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="alert alert-danger state0" style="text-align: center;">
					<b>Panic Button Activation by <?php echo $unit['unit']; ?> (<?php echo $unit['collar']; ?>)</b><br><i>
				</div>
			</div>
		</div>
		<?php
			}
		?>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="card custom-card">
				<div class="card-body" style="padding: 5px !important;">
					<a href="#" data-toggle="modal" data-target="#endShift">End Shift</a> | <a href="#" data-toggle="modal" data-target="#sendGlobalMessage">Send Global Message</a>
				</div>
			</div>
		</div>
	</div>
	<Br>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-4">
			<div class="card custom-card">
				<div class="card-header">
					<a href="#" onclick="toggleDiv('editCAD')"><i class="fa fa-plus"></i></a> 
					Dismiss Call
				</div>
				<div class="card-body" id="editCAD">
					<?php
					if(isset($_POST['dismissCall'])) { 
			  	  		updateCallStatus($_POST['cad'], 4);
					}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">Select Report</label>
    						<div id="cads">
    							<select class="form-control" name="cad">
    								<?php
    								foreach($calls as $call){
    								?>
    								<option value="<?php echo $call['callid']; ?>"><?php echo $call['callid'] . "/" . $call['dateline'] . " - " . $call['type']; ?></option>
    								<?php
    								}
    								?>
    							</select>
    						</div>
  						</div>
  						<div class="form-group col-md-12">
  							<input type="submit" name='dismissCall' class="btn btn-success btn-block" value="Dismiss Call">
  						</div>
  					</form>
				</div>
			</div>
			<br>
			<div class="card custom-card">
				<div class="card-header">
					Active Units
				</div>
				<table class="table table-responsive-xl" id="availableUnits">
					<tbody>
						<?php
						foreach($availableUnits as $unit){
						?>
						<tr class="state<?php echo $unit['status']; ?>">
							<td><b><?php echo $unit['unit'] . " - " . $unit['collar'] . " - State " . $unit['status'] . " - Log " . $unit['callid']; ?></b></td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card custom-card">
				<div class="card-header">
					Recent Logs
				</div>
				<table class="table table-responsive-xl" id="refreshLogs">
					<tbody>
						<?php
						$logs = getLogs("Patrol");

						foreach($logs AS $log){
						?>
						<tr>
							<td><b><?php echo $log['user']; ?> (<?php echo date('d\/m\/Y \a\t G\:i', $log['dateline']); ?>)</b><br><?php echo $log['content']; ?></td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card custom-card">
				<div class="card-header">
					<a data-toggle="modal" data-target="#sendMessage"><i class="fa fa-comment-alt"></i></a> 
					Recent Messages
				</div>
				<table class="table table-responsive-xl" id="refreshMessages">
					<tbody>
						<?php
						$messages = getRecentMessages("DISPATCH");

						foreach($messages AS $message){
						?>
						<tr>
							<td><b><?php echo $message['post']; ?></b> to <i><?php echo $message['recive']; ?></i><br><?php echo $message['content']; ?></td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<div id="modal">
	<?php
	foreach($calls as $call){
		$continue = false;
		
	?>

	<div class="modal fade" id="updateCall<?php echo $call['callid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content" style="margin-top: 100px;">
      			<div class="modal-header">
        			<h5 class="modal-title" id="updateCall<?php echo $call['callid']; ?>">Close Call</h5>
      			</div>
      			<div class="modal-body">
      				<div class="container">
        				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="row">
								<div class="form-group" style="width: 100%;">
            	    				<input type="submit" name='dismissCall<?php echo $call['callid']; ?>' class="btn btn-danger btn-block" value="Dismiss Call">
           						</div>
           					</div>
						</form>
						<?php
							if(isset($_POST['assignUnit'.$call['callid']])) { 
			  	  				attachUnitToCall($call['callid'], $_POST['unit']);
							}
							if(isset($_POST['dismissCall'.$call['callid']])) { 
			  	  				updateCallStatus($call['callid'],4);
							}
						?> 
					</div>
      			</div>
    		</div>
  		</div>
	</div>

	<?php
	}

	?>
</div>
	<div class="modal fade" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content" style="margin-top: 100px;">
      			<div class="modal-header">
        			<h5 class="modal-title" id="sendMessage">Send Message</h5>
      			</div>
      			<div class="modal-body">
      				<div class="container">
        				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="row">
								<div class="form-group col-md-12">
    								<label for="channel">Select Unit</label>
    								<select name="unit" class="form-control">
    									<?php
    									foreach($availableUnits as $unit){
    									?>
    									<option value="<?php echo strtoupper($unit['unit']); ?>"><?php echo $unit['unit']; ?> (<?php echo $unit['collar']; ?>)</option>
    									<?php
    									}
    									?>
    								</select>
  								</div>
  								<div class="form-group col-md-12">
    								<label for="grade">Enter Message</label>
    								<input type="text" class="form-control" name="message">
  								</div>
								<div class="form-group" style="width: 100%;">
									<input type="submit" name='sendMessage' class="btn btn-success btn-block" value="Send Message">
           						</div>
           					</div>
						</form>
						<?php
							if(isset($_POST['sendMessage'])) { 
			  	  				sendMessage($_POST['unit'], 'CONTROL', $_POST['message']);
							}
						?> 
					</div>
      			</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="endShift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content" style="margin-top: 100px;">
      			<div class="modal-header">
        			<h5 class="modal-title" id="endShift">End Shift</h5>
      			</div>
      			<div class="modal-body">
      				<div class="container">
        				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="row">
								<div class="form-group" style="width: 100%;">
            	    				<input type="submit" name='endShift' class="btn btn-danger btn-block" value="End Shift">
           						</div>
           					</div>
						</form>
						<?php
							if(isset($_POST['endShift'])) { 
			  	  				endShift($UserArray['userid']);
							}
						?> 
					</div>
      			</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="sendGlobalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content" style="margin-top: 100px;">
      			<div class="modal-header">
        			<h5 class="modal-title" id="endShift">Send Global Message</h5>
      			</div>
      			<div class="modal-body">
      				<div class="container">
        				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="row">
								<div class="form-group col-md-12">
									<label>Global Message</label>
									<textarea class="form-control" name="message"></textarea>
								</div>
								<div class="form-group col-md-12">
            	    				<input type="submit" name='sendGlobalMessage' class="btn btn-danger btn-block" value="Send Global Message">
           						</div>
           					</div>
						</form>
						<?php
							if(isset($_POST['sendGlobalMessage'])) { 
			  	  				sendGlobalMessage($_POST['message']);
							}
						?> 
					</div>
      			</div>
    		</div>
  		</div>
	</div>

<script type="text/javascript"> 

function refreshDiv() { 

    $('#refreshDiv').load(document.URL +  ' #refreshDiv');
    $('#refreshLogs').load(document.URL +  ' #refreshLogs');
    $('#refreshMessages').load(document.URL +  ' #refreshMessages');
    $('#test').load(document.URL +  ' #test');
} 

function availableUnits(){
	$('#availableUnits').load(document.URL +  ' #availableUnits');
}

function panicSection(){
	$('#panicSection').load(document.URL +  ' #panicSection');
}

function modals(){
	$('#cads').load(document.URL +  ' #cads');
}

function toggleDiv(div){
	$(`#${div}`).slideToggle();
}

window.setInterval(refreshDiv, 3000);
window.setInterval(availableUnits, 3000);
window.setInterval(panicSection, 3000);
window.setInterval(modals, 5000);
</script>