<?php	$NAME_USER=$_SERVER["REMOTE_ADDR"];

	$LABO_USER="No_Lab";
	if (in_array($NAME_USER,$authorized_IPs)) {
		$LABO_USER = $LabName1;
	} 

	if ($LABO_USER=="No_Lab") {
		?>
		    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		Sorry, you are not allowed to access this database. If you believe this is a mistake, contact <?php echo $CONTACT_EMAIL?><br> Please clear your cookies if you need to login again.
			<?
			exit; //User kicked
	}
	?>
