<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);

if($permCheck == false OR !isset($_GET['cid'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
    $civInfo = getCivInfo($_GET['cid']);
?>

<title>PDRP Network - Edit Civilian Record: <?php echo $civInfo['name']; ?></title>


<div class="container-fluid" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header">
                    Edit Civilian Record: <?php echo $civInfo['name']; ?>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_POST['updateAllowed'])) { 

                            $query    = $con->query( "SELECT * FROM markers" );
                            $markers = '';

                            while( $array = mysqli_fetch_assoc($query) ) {
                    
                                if( isset($_POST['marker-' . $array['acronym']]) ) {
                            
                                    $markers .= $array['acronym'] . ",";

                                }
                            }
                    
                            $query = $con->query("UPDATE civilians SET markers = '{$markers}' WHERE civid = '{$_GET['cid']}'");
                    ?>
                        <div class="alert alert-success"><b>Civilian Updated</b> The civilian has been updated.</div>
                    <?php
                        echo '<meta http-equiv="refresh" content="0; url=civilian-civs.php" />';
                        }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?cid=<?php echo $civInfo['civid']; ?>" method="post">
                        <?php
                            $markers = getMarkers();
                            foreach($markers as $marker){
                        ?>
                        <input type="checkbox" name="marker-<?php echo $marker['acronym']; ?>" value="<?php echo $marker['acronym']; ?>" class="usergroupscheck" <?php if(civHasMarker($civInfo['civid'], $marker['acronym']) == true){ ?> checked="" <?php } ?> /> <?php echo $marker['name']; ?> <br />
                        <?php
                            }
                        ?><br>
                        <div class="form-group" style="width: 100%;">
                            <input type="submit" name='updateAllowed' class="btn btn-success btn-block" value="Update Record">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>