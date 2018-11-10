<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 1024);

if($permCheck == false OR !isset($_GET['gid']) OR $_GET['gid'] == 14){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
    $group = getGroupInfo($_GET['gid']);
?>

<title>PDRP Network - Edit Usergroup: <?php echo $group['name']; ?></title>

<div class="container-fluid" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header">
                    Edit Usergroup: <?php echo $group['name']; ?>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_POST['updateGroup'])) {
                            $query = getPerms();
                            $perms = 0;

                            foreach($query as $array){
                    
                                if( isset($_POST['perm-' . $array['perm']]) ) {
                            
                                    $perms = $perms + $array['perm'];

                                }
                            }

                            updateUsergroup($UserArray['userid'],$group['id'],$_POST['name'],$perms);
                        }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?gid=<?php echo $group['id']; ?>" method="post">
                        <div class="form-group col-md-12">
                            <label for="channel">Usergroup Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $group['name']; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Usergroup Permissions</label><br>
                            <?php
                            $perms = getPerms();

                            foreach($perms as $perm){
                            ?>
                            <input type="checkbox" name="perm-<?php echo $perm['perm']; ?>" value="<?php echo $perm['perm']; ?>" class="usergroupscheck" <?php if (groupHasPerm($group['id'],$perm['perm']) == true){ ?> checked="" <?php } ?>> <?php echo $perm['name']; ?> <br>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name='updateGroup' class="btn btn-success btn-block" value="Update Group">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>