<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 1);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$cads = getClosedCalls();
?>

<title>PDRP Network - Call History</title>


<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
        <div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card custom-card">
				<div class="card-header">
					Call History
				</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
   						<tr>
   							<th scope="col">Reference</th>
                			<th scope="col">Type</th>
   							<th scope="col">Description</th>
	     					<th scope="col">Location</th>
 						</tr>
					</thead>
	  				<tbody>
	  					<?php
	  					foreach($cads as $cad){
	  					?>
    					<tr>
    						<th scope="row"><?php echo $cad['callid'] . "/" . $cad['dateline']; ?></th>
    						<th><?php echo $cad['type']; ?></th>
    						<th><?php echo $cad['description']; ?></th>
    						<td><?php echo $cad['location']; ?></td>
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