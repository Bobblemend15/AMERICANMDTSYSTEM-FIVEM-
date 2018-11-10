<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 64);
$permCheck2 = haveGeneralPerm($UserArray['userid'], 128);

if($permCheck == false && $permCheck2 == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}

$unitInfo = getUnitForUser($UserArray['collar']);

if($unitInfo == false){
	echo '<meta http-equiv="refresh" content="0; url=signOn.php" />';
}
?>


<title>PDRP Network - <?php echo $unitInfo['unit']; ?></title>


<div class="container-fluid" style="margin-top: 25px;">
	<div id="panicSection">
		<?php
		$nums = $con->query("SELECT * FROM units WHERE status = 'Panic'")->num_rows;

		if($nums > 0){
			$unit = mysqli_fetch_assoc($con->query("SELECT * FROM units WHERE status = 'Panic'"));

				echo '<audio src="./_assets/soundpack/panic.mp3"" autoplay control/></audio>';
		?>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="alert alert-danger panic" style="text-align: center;">
					<b>Panic Button Activation by <?php echo $unit['unit']; ?> (<?php echo $unit['collar']; ?>)</b>
				</div>
			</div>
		</div>
		<?php
			}
		?>
	</div>
	<div id="unitStatus">
		<div class="row">.
			<div class="col-md-1"></div>
			<div class="col-sm-12 col-md-10 col-lg-10">
				<div class="alert state<?php echo $unitInfo['status'];?> text-center">
					<b>Current Status: 10 - <?php echo $unitInfo['status']; ?></b>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-sm-12 col-md-10 col-lg-7">
			<div class="card custom-card">
				<div class="card-header">
					Unit Actions - <?php echo $unitInfo['unit']; ?>
				</div>
				<div class="card-body">
					<?php
					if(isset($_POST['makeAvailable'])) {
						updateUnitStatus($unitInfo['unitid'], '2');
					}
					if(isset($_POST['makeInRoute'])) {
						updateUnitStatus($unitInfo['unitid'], '97');
					}
					if(isset($_POST['makeOnScene'])) {
						updateUnitStatus($unitInfo['unitid'], '23');
					}
					if(isset($_POST['makeBusy'])) {
						updateUnitStatus($unitInfo['unitid'], '6');
					}
					if(isset($_POST['makeTransport'])) {
						updateUnitStatus($unitInfo['unitid'], '9');
					}
					if(isset($_POST['makePanic'])) {
						updateUnitStatus($unitInfo['unitid'], '99');
					}
					if(isset($_POST['signOff'])) {
						signUnitOff($unitInfo['unitid']);
					}
					if(isset($_POST['clearFromScene'])) {
						clearUnit($unitInfo['unitid']);
					}
					if(isset($_POST['makeUnavailable'])) {
						updateUnitStatus($unitInfo['unitid'], '7');
					}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="row">
						<div class="form-group col-sm-12 col-md-6 col-lg-4">
    	            		<input type="submit" name='makeAvailable' class="btn state2 btn-green btn-block" value="Available">
        	   			</div>
        	   			<div class="form-group col-sm-12 col-md-6 col-lg-4">
    	            		<input type="submit" name='makeUnavailable' class="btn state7 btn-green btn-block" value="Unavailable">
        	   			</div>
        	   			<div class="form-group col-sm-12 col-md-6 col-lg-4">
        	        		<input type="submit" name='makeInRoute' class="btn state97 btn-green btn-block" value="In Route">
        	   			</div>
        	   			<div class="form-group col-sm-12 col-md-6 col-lg-4">
        	        		<input type="submit" name='makeOnScene' class="btn state23 btn-green btn-block" value="On Scene">
        	   			</div>
        	   			<div class="form-group col-sm-12 col-md-6 col-lg-4">
        	        		<input type="submit" name='makeBusy' class="btn state6 btn-green btn-block" value="Busy">
        	   			</div>
        	   			<div class="form-group col-sm-12 col-md-6 col-lg-4">
        	        		<input type="submit" name='makeTransport' class="btn state9 btn-green btn-block" value="Transport">
        	   			</div>
        	   			<div class="form-group col-sm-12 col-md-6">
        	        		<input type="submit" name='makePanic' class="btn state99 btn-green btn-block" value="Panic">
        	   			</div>
        	   			<div class="form-group col-sm-12 col-md-6">
        	        		<input type="submit" name='signOff' class="btn state11 btn-green btn-block" value="Go Off Duty">
        	   			</div>
        	   		</div>
        	   		</form>
				</div>
			</div>
			<br>
			<div id="callinfo">
			<?php
				$unitCheck = getUnitForUser($UserArray['collar']);

				if($unitCheck == false){
					echo '<meta http-equiv="refresh" content="0; url=signOn.php" />';
				}

        	   	if($unitInfo['callid'] > 0){

        	   		$call = getCallInfo($unitInfo['callid']);
        	?>
			<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-7">
					<div class="card custom-card">
						<div class="card-header">
							<a data-toggle="modal" data-target="#newRemark"><i class="fa fa-comment-alt"></i></a> 
							Call Information - <?php echo $call['callid'] . "/" . $call['dateline']; ?>
						</div>
						<div class="card-body" style="padding-bottom: 0 !important;">
							<div class="row">
								<div class="col-sm-6 col-md-6">
									<b>Time Created:</b><br><?php echo $call['created']; ?><br>
								</div>
								<div class="col-sm-6 col-md-6">
									<b>Call Status:</b><br><i><?php if($call['status'] == 1){ echo "Received"; }elseif($call['status'] == 2){ echo "Not Dispatched"; }elseif($call['status'] == 3){ echo "Dispatched"; } ?></i><br>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-8 col-md-8">
									<b>Location:</b><br><?php echo $call['location']; ?> <br>
								</div>
								<div class="col-sm-4 col-md-4">
									<b>Caller:</b><br><?php if($call['caller'] == false){ echo "Anonymous"; }else{ echo "<a href=\"./pnc-check.php?cid=" . $call['caller']['civid'] . "\">" . $call['caller']['name'] . "</a>"; } ?><br>
								</div>
							</div>
							<Br>
							<div class="row">
								<div class="col-md-12">
									<b>Description:</b><br><?php echo $call['description']; ?><br>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-4 col-md-4 col-lg-4">
									<b>Importance:</b><br><?php echo $call['police_grade']; ?><br>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4">
									<b>Priority:</b><br><?php echo $call['rmu_grade']; ?><br>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4">
									<b>Priority Channel:</b><br><?php echo $call['channel']; ?><br>
								</div>
							</div>
							<br>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<input type="submit" name='clearFromScene' class="btn state11 btn-green btn-block" value="Clear from Scene">
						</form>
							<br>
						</div>
					</div>
					<br>
				</div>
				<Div class="col-sm-12 col-md-12 col-lg-5">
					<div class="card custom-card">
						<div class="card-header">
							<i class="fa fa-users"></i>
							Assigned Units
						</div>
						<table class="table" id="availableUnits">
							<tbody>
								<?php
									foreach($call['units'] as $unit){
								?>
								<tr class="state<?php echo preg_replace("/[\s_]/", "-", $unit['status']); ?>">
									<td><b><?php echo $unit['unit'] . " - " . $unit['collar'] . " - State " . $unit['status']; ?></b></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
					<br>
				</Div>
			</div>
		<?php
			}
		?>
	</div>
</div>
	<div class="col-md-1 d-lg-none"></div>
		<div class="col-sm-12 col-md-10 offset-md-1 col-lg-3 offset-lg-0">
			<div class="card custom-card">
				<div class="card-header">
					<a data-toggle="modal" data-target="#sendMessage"><i class="fa fa-comment-alt"></i></a> 
					Recent Messages
				</div>
				<table class="table table-responsive-xl" id="refreshMessages">
					<tbody>
						<?php
						$messages = getRecentMessages(strtoupper($unitInfo['unit']));

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
			  	  				sendMessage('DISPATCH', strtoupper($unitInfo['unit']), $_POST['message']);
							}
						?> 
					</div>
      			</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="newRemark" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content" style="margin-top: 100px;">
      			<div class="modal-header">
        			<h5 class="modal-title" id="newRemark">New Remark</h5>
      			</div>
      			<div class="modal-body">
      				<div class="container">
        				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="row">
  								<div class="form-group col-md-12">
    								<label for="grade">Enter Remark</label>
    								<textarea class="form-control" name="remark"></textarea>
  								</div>
								<div class="form-group" style="width: 100%;">
									<input type="submit" name='newRemark' class="btn btn-success btn-block" value="Add Remark">
           						</div>
           					</div>
						</form>
						<?php
							if(isset($_POST['newRemark'])) { 
			  	  				newRemark(strtoupper($unitInfo['unit']) . ' (' . $unitInfo['collar'] . ')', $_POST['remark'], $call['callid']);
							}
						?> 
					</div>
      			</div>
    		</div>
  		</div>
	</div>

<script> 
function refreshDiv() { 

    $('#callinfo').load(document.URL +  ' #callinfo');
    $('#unitStatus').load(document.URL +  ' #unitStatus');

} 

function refreshMessages(){
	$('#refreshMessages').load(document.URL +  ' #refreshMessages');
}

function panicSection(){
	$('#panicSection').load(document.URL +  ' #panicSection');
}

window.setInterval(refreshDiv, 1000);
window.setInterval(refreshMessages, 1000);
window.setInterval(panicSection, 5000);
</script>