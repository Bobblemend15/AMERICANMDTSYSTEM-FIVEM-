<?php

?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 1);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=login.php" />';
}
?>

<title>PDRP Network - Homepage</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-6">
			<div class="card custom-card">
				<div class="card-header">Recent Log Reports (Recent 5)</div>
				<table class="table" id="refreshDiv">
					<thead class="thead-light">
						<tr>
   							<th scope="col">Ref.</th>
	     					<th scope="col">Log Ref.</th>
   							<th scope="col">Submitted</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$cads = getCadsForUser($UserArray['userid']);

						foreach($cads as $cad){
						?>
						<tr>
							<td>
								<?php echo $cad['id']; ?>
							</td>
							<td>
								<?php echo $cad['cad']; ?>
							</td>
							<td>
								<?php echo timeAgo($cad['dateline']); ?>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card custom-card">
				<div class="card-header">Be on the lookout (Vehicle of Interest)</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
						<tr>
   							<th scope="col" style="width: 16.666667%;">Model</th>
	     					<th scope="col" style="width: 9%;">License Plate</th>
   							<th scope="col" style="width: 8%;">Desccription</th>
   							<th scope="col" style="width: 33.333333%;">Reason</th>
   							<th scope="col" style="width: 33.333333%;">Notes</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$vois = getVois();

						foreach($vois as $voi){
							$vehicleInfo = getVehicleInfo($voi['vehicle_id']);
						?>
						<tr>
							<td>
								<?php echo $vehicleInfo['vehicle']; ?>
							</td>
							<td>
								<?php echo $vehicleInfo['vrm']; ?>
							</td>
							<td>
								<?php echo $voi['image']; ?>
							</td>
							<td>
								<?php echo $voi['reason']; ?>
							</td>
							<td>
								<?php echo $voi['notes']; ?>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<br>
			<div class="card custom-card">
				<div class="card-header">Be on the lookout (Person of Interest)</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
						<tr>
   							<th scope="col" style="width: 16.666667%;">Name</th>
	     					<th scope="col" style="width: 9%;">Address</th>
   							<th scope="col" style="width: 8%;">Description</th>
   							<th scope="col" style="width: 33.333333%;">Reason</th>
   							<th scope="col" style="width: 33.333333%;">Notes</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$pois = getPois();

						foreach($pois as $poi){
							$civInfo = getCivInfo($poi['civ_id']);
						?>
						<tr>
							<td>
								<?php echo $civInfo['name']; ?>
							</td>
							<td>
								<?php echo $civInfo['address']; ?>
							</td>
							<td>
								<?php echo $poi['image']; ?>
							</td>
							<td>
								<?php echo $poi['reason']; ?>
							</td>
							<td>
								<?php echo $poi['notes']; ?>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>