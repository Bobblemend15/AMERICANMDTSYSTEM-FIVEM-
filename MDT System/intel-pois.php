<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 32);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$pois = getPois();
?>

<title>PDRP Network - Manage BOLO(Persons of Interest)</title>

<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-9">
			<div class="card custom-card">
				<div class="card-header">
					Be On The Lookout (Current Persons of Interest)
				</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
   						<tr>
   							<th scope="col">Reference</th>
   							<th scope="col">Name</th>
	     					<th scope="col">Address</th>
   							<th scope="col">Description</th>
   							<th scope="col">Reason</th>
   							<th scope="col">Notes</th>
 						</tr>
					</thead>
	  				<tbody>
	  					<?php
	  					foreach($pois as $poi){

	  						$civInfo = getCivInfo($poi['civ_id']);
	  					?>
    					<tr>
    						<th scope="row"><?php echo $poi['id']; ?> <a href="./intel-pois-edit.php?poi=<?php echo $poi['id']; ?>"><i class="fa fa-pencil-alt"></i></a></th>
    						<th><?php echo $civInfo['name']; ?></th>
    						<th><?php echo $civInfo['address']; ?></th>
    						<td><?php echo $poi['image']; ?></td>
	      					<td><?php echo $poi['reason']; ?></td>
	      					<td><?php echo $poi['notes']; ?></td>
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
					Add New BOLO
				</div>
				<div class="card-body">
					<?php
						if(isset($_POST['createPoi'])) { 
			  	  			createPoi($_POST['civilian'],$_POST['image'],$_POST['reason'],$_POST['notes']);
                    ?>
                    <div class="alert alert-success"><b>BOLO Created</b> This BOLO has been created and is ready for use.</div>
                    <?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
                            <label for="channel">Civilian</label>
                            <select name="civilian" class="form-control">
                                <?php
                                $civs = getCivs();

                                foreach($civs as $civ){
                                ?>
                                <option value="<?php echo $civ['civid']; ?>"><?php echo $civ['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Description</label>
                            <input type="text" class="form-control" name="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Reason</label>
                            <input type="text" class="form-control" name="reason" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Notes</label>
                            <input type="text" class="form-control" name="notes" required>
                        </div>
  						<div class="form-group col-md-12">
							<input type="submit" name='createPoi' class="btn btn-success btn-block" value="Create BOLO">
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

window.setInterval(refreshDiv, 1000);
window.setInterval(availableUnits, 1000);
window.setInterval(panicSection, 1000);
</script>