<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$civs = getCivs();
?>

<title>PDRP Network - Manage Civilians</title>

<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-9">
			<div class="card custom-card">
				<div class="card-header">
					Existing Civilian
				</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
   						<tr>
   							<th scope="col">Reference</th>
   							<th scope="col">Name</th>
	     					<th scope="col">Date of Birth</th>
   							<th scope="col">Address</th>
   							<th scope="col">Criminal Record</th>
   							<th scope="col">Owned Vehicles</th>
 						</tr>
					</thead>
	  				<tbody>
	  					<?php
	  					foreach($civs as $civ){
	  					?>
    					<tr>
    						<th scope="row"><?php echo $civ['civid']; ?> <a href="./civilian-civs-edit.php?cid=<?php echo $civ['civid']; ?>"><i class="fa fa-pencil-alt"></i></a> <?php if(haveGeneralPerm($UserArray['userid'], 512) == true){ ?><a href="./civilian-civs-delete.php?cid=<?php echo $civ['civid']; ?>"><i class="fa fa-trash"></i></a><?php } ?></th>
    						<th><?php echo $civ['name']; ?></th>
    						<th><?php echo $civ['dob']; ?></th>
    						<td><?php echo $civ['address']; ?></td>
	      					<td><?php echo $civ['markers']; ?> <a href="./civilian-civs-markers.php?cid=<?php echo $civ['civid']; ?>"><i class="fa fa-pencil-alt"></i></a></td>
	      					<td>
	      					<?php
	      					$vehicles = getVehiclesForCiv($civ['civid']);

	      					foreach($vehicles as $vehicle){
	      					?>
    						<a href="vrm-check.php?vid=<?php echo $vehicle['vehicleid']; ?>"><?php echo $vehicle['vrm']; ?></a>, 
    						<?php
    						}
    						?>
    						</td>
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
					Create Civilian
				</div>
				<div class="card-body">
					<?php
						if(isset($_POST['createCiv'])) { 
			  	  			createCiv($UserArray['userid'],$_POST['name'],$_POST['dob'],$_POST['address']);
                    ?>
                    <div class="alert alert-success"><b>Civilian Created</b> This civilian has been created and is ready for use.</div>
                    <?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">Name</label>
    						<input type="text" class="form-control" name="name" required>
  						</div>
                        <div class="form-group col-md-12">
                            <label for="channel">Date Of Birth</label>
                            <input type="date" class="form-control" name="dob" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
  						<div class="form-group" style="width: 100%;">
							<input type="submit" name='createCiv' class="btn btn-success btn-block" value="Create Civilian">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<script> 
function refreshDiv() { 

    $('#refreshDiv').load(document.URL +  ' #refreshDiv');

} 

function availableUnits(){
	$('#availableUnits').load(document.URL +  ' #availableUnits');
}

function panicSection(){
	$('#panicSection').load(document.URL +  ' #panicSection');
}

window.setInterval(refreshDiv, 3000);
window.setInterval(availableUnits, 3000);
window.setInterval(panicSection, 3000);
</script>