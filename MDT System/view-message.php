<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 1);

if($permCheck == false OR !isset($_GET['uid'])){
    echo '<meta http-equiv="refresh" content="0; url=login.php" />';
}

$messages = getMessagesBetween($UserArray['userid'],$_GET['uid']);
?>

<title>PDRP Network - Messages</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<div id="messages">
			<?php
			foreach($messages as $message){
			?>
			<div class="card custom-card" id="message-<?php echo $message['messageid']; ?>">
				<div class="card-header"><?php echo "From " . getUserInfo($message['post'])['first_name'] . " " . getUserInfo($message['post'])['surname'] . " to " . getUserInfo($message['recive'])['first_name'] . " " . getUserInfo($message['recive'])['surname']; ?></div>
				<div class="card-body">
					<?php echo nl2br($message['content']); ?>
				</div>
			</div>
			<br>
			<?php
			}
			?>
			</div>
			<div class="card custom-card">
				<div class="card-body">
					<?php
            		if(isset($_POST['sendMessage'])) { 
            			$message = $con->escape_string($_POST['message']);
              			sendMessage($_GET['uid'],$UserArray['userid'],$message);
          			?>
                    <div class="alert alert-success"><b>Message Sent</b> The message has been sent.</div>
          			<?php
            		}
          			?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?uid=<?php echo $_GET['uid']; ?>" method="post">
						<div class="form-group col-md-12">
							<label>Message</label><br>
							<textarea class="form-control" name="message"></textarea>
						</div>
						<div class="form-group col-md-12">
        	                <input type="submit" name='sendMessage' class="btn btn-success btn-block" value="Send Message">
        	            </div>
        	        </form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript"> 
<?php
if(isset($_GET['mid'])){
?>
	$('html,body').animate({
        scrollTop: $("#message-<?php echo $_GET['mid']; ?>").offset().top - 50
    });
<?php
}
?>
</script>