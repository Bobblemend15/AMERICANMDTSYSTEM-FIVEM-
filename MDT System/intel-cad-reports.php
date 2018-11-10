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
	$reports = getCADReports();
?>


<title>PDRP Network - View Incident Reports</title>

<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
        <div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card custom-card">
				<div class="card-header">
					View Incident Reports
				</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
   						<tr>
   							<th scope="col">Reference</th>
   							<th scope="col">Submitted By</th>
	     					<th scope="col">Incident Reference</th>
   							<th scope="col">Date</th>
                <th scope="col">Actions</th>
 						</tr>
					</thead>
	  				<tbody>
	  					<?php
	  					foreach($reports as $report){
	  					?>
    					<tr>
    						<th scope="row"><?php echo $report['id']; ?></th>
    						<th><?php echo getUserInfo($report['user'])['first_name'] . " " . getUserInfo($report['user'])['surname']; ?></th>
    						<th><?php echo $report['cad']; ?></th>
    						<td><?php echo date('d\/m\/Y \a\t G\:i', $report['dateline']); ?></td>
	      				<td><a href="./intel-view-report.php?rid=<?php echo $report['id']; ?>">Read More</a></td>
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