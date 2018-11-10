<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 64);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>


<title>PDRP Network - Incident Report</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><a href="./cad-history.php" target="_blank" style="position: absolute; right: 10px;">Past Calls</a> Create Incident Report</div>
				<div class="card-body">
					<?php
						if(isset($_POST['submitCADReport'])) { 
                            $incident = $con->escape_string($_POST['incident']);
                            $cad = $con->escape_string($_POST['cad']);
                            $located = $con->escape_string($_POST['located']);
                            $otherUnits = $con->escape_string($_POST['otherUnits']);
                            $arrested = $con->escape_string($_POST['arrested']);
                            $person = $con->escape_string($_POST['person']);
                            $arrestedFor = $con->escape_string($_POST['arrestedFor']);
                            $foundItems = $con->escape_string($_POST['foundItems']);
                            $whatHappened = $con->escape_string($_POST['whatHappened']);
                            createCadReport($UserArray['userid'],$incident,$cad,$located,$otherUnits,$arrested,$person,$arrestedFor,$foundItems,$whatHappened);
                    ?>
                    <div class="alert alert-success"><b>Report Submitted</b> The report is now logged, back to work!</div>
                    <?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row">
    						<div class="form-group col-sm-12 col-md-6">
        						<label for="channel">Name</label>
    	       					<input type="text" class="form-control" name="username" value="<?php echo $UserArray['first_name'] . ' ' . $UserArray['surname']; ?>" disabled>
                               <small id="emailHelp" class="form-text text-muted"><I>Your Name (Autofilled)</I></small>
  				  	       	</div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Username</label>
                                <input type="text" class="form-control" name="collar" value="<?php echo $UserArray['collar']; ?>" disabled>
                               <small id="emailHelp" class="form-text text-muted"><I>Your Username (Autofilled)</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">What type of incident is this report about?</label>
                                <input type="text" class="form-control" name="incident">
                                <small id="emailHelp" class="form-text text-muted"><I>What type of incident did you attend?.</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">What was the Call Reference?</label>
                                <input type="text" class="form-control" name="cad">
                                <small id="emailHelp" class="form-text text-muted"><I>493/28JUN2018</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Who else was on the incident?</label>
                                <textarea class="form-control" name="otherUnits"></textarea>
                                <small id="emailHelp" class="form-text text-muted"><I>Lieutenant Smith, Officer Jones, etc...</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Where did you locate the person or vehicle?</label>
                                <textarea class="form-control" name="located"></textarea>
                                <small id="emailHelp" class="form-text text-muted"><I>Strawberry Ave outside Tesco in Sandy Shores</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Was a person arrested?</label>
                                <select class="form-control" name="arrested">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <small id="emailHelp" class="form-text text-muted"><I>It's simple...</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Persons Information</label>
                                <input type="text" class="form-control" name="person" placeholder="Name, MM/DD/YYYY">
                                <small id="emailHelp" class="form-text text-muted"><I>Charlie Hodds, 06/28/2018</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">What was the person arrested for?</label>
                                <input type="text" class="form-control" name="arrestedFor">
                                <small id="emailHelp" class="form-text text-muted"><I>Robbery, Drunk Driving, Traffic Violation, etc...</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">What did you find on the person?</label>
                                <input type="text" class="form-control" name="foundItems">
                                <small id="emailHelp" class="form-text text-muted"><I>Keys, Id & Money</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label for="channel">Say briefly, what happened on this call.</label>
                                <textarea class="form-control" name="whatHappened"></textarea>
                                <small id="emailHelp" class="form-text text-muted"><I>Really? You need help with this..</I></small>
                            </div>
                        </div>
  						<div class="form-group" style="width: 100%;">
							<input type="submit" name='submitCADReport' class="btn btn-success btn-block" value="Submit Incident Report">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
