<? include("begin.php"); ?>
	<? $id_product = $_POST['id_product'];
	/* Check if the product belongs to the lab of the user */
	$sql= " SELECT `labo`
		FROM `product`
		WHERE id ='".$id_product."'
		LIMIT 1 
		";
	$result = mysql_query($sql);
	$dat = mysql_fetch_array($result);
	if ($dat[0]==$LABO_USER) {
	?>
        <h1>Modify item</h1>

	<? 
		
		if($_POST['name']=="") {die("You have to precise at least a name and a location...");}
		# Secure data reading from POST
		include('read_post_data_item.php');
		# Delete informations sheet if requested
			if (isset($_POST['PIS_Delete']))
			if ($_POST['PIS_Delete']) {
			$sql = "
				UPDATE `product` 
				SET `Infos_Internal` = '0' 
				WHERE `product`.`id` ='".$id_product."' LIMIT 1 ;
			";
			mysql_query($sql);}
		# Delete MSD sheet if requested
			if (isset($_POST['MSDS_Delete']))
			if ($_POST['MSDS_Delete']) {
			$sql = "
				UPDATE `product` 
				SET `MSDS_Internal` = '0' 
				WHERE `product`.`id` ='".$id_product."' LIMIT 1 ;
			";
			mysql_query($sql);
			}


		if (isset($_POST['request'])) {
			# Process creation of new location/type and file uploading
			include('process_request.php');
		} 

		if (($id_supplier=="add")||($id_location=="add")||($id_precise_location=="add")||
			($id_type=="add")||($id_precise_type=="add")) {
			# ask data concerning the location/type to add?>
			<form method="post" action="modify_item.php" > <?
			include('ask_request.php');
		} else {
		$sql = "
		UPDATE `product` SET
			`name` = '".safe_read($name)."',
			`usual_name` = '".safe_read($usual_name)."',
			`extra_name` = '".safe_read($extra_name)."',
			`MSDS_External` = '".safe_read($MSDS_External)."',
			`id_supplier` = '".safe_read($id_supplier)."',
			`ref` = '".safe_read($ref)."',
			`id_location` = '".safe_read($id_location)."',
			`id_precise_location` = '".safe_read($id_precise_location)."',
			`location_infos` ='".safe_read($location_infos)."',
			`id_type` = '".safe_read($id_type)."',
			`id_precise_type` = '".safe_read($id_precise_type)."',
			`form` = '".safe_read($form)."',
			`storage` ='".safe_read($storage)."',
			`quantity` = '".safe_read($quantity)."',
                        `has_aliquots` = '".safe_read($has_aliquots)."',
                        `nb_aliquots` = '".safe_read($nb_aliquots)."',
			`date_of_receipt` = '".safe_read($year_of_receipt)."-".safe_read($month_of_receipt)."-00 00:00:00',
			`date_of_opening` = '".safe_read($year_of_opening)."-".safe_read($month_of_opening)."-00 00:00:00',
			`date_of_expire` = '".safe_read($year_of_expire)."-".safe_read($month_of_expire)."-00 00:00:00',
			`comments` ='".safe_read($comments)."',
			`Infos_External` ='".safe_read($Information_External)."',
			`date_of_entry` = NOW(),
			`ip` ='".$NAME_USER."',
			`labo` ='".$LABO_USER."'
		WHERE  `product`.`id` =".safe_read($id_product)." LIMIT 1 ;
		";
		mysql_query($sql);
		include('process_uploaded_files.php');
		?> 
		Product modified! <br>
		<a href="show_item.php?id=<? echo $id_product;?>">See last entry.<br></a>		
		<a href="edit_item.php?id=<? echo $id_product;?>">Modify last entry.<br></a>
		<a href="new_item.php">Create a new entry.<br></a>
		<?
		}

	?>
	<? } else { ?>
	<p> You are not allowed to modify an item that does not belong to your lab.</p>
	<?}?>

<? include("end.php"); ?>
