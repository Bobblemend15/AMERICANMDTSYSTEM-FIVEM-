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
    $groups = getUserGroups();
?>

<head>
<title>PDRP Network - Manage Usergroups</title>
<style type="text/css">
body {
            background-image: url(../img/background-2.png) !important;
            background-repeat: no-repeat;
            background-position: left center;
            background-size: auto; 
            background-color: #37474f;
            background-attachment: fixed;
			color: white;
        }
</style>
</head>

<div class="container-fluid" style="margin-top: 25px;">
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
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($groups as $group){
                        ?>
                        <tr>
                            <th scope="row"><?php echo $group['id']; ?></th>
                            <th scope="row"><?php echo $group['name']; ?></th>
                            <td><a href="admin-groups-edit.php?gid=<?php echo $group['id']; ?>">Edit Group</a></td>
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