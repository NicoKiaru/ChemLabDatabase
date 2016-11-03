<? include("begin.php"); ?>

        <h1>New item</h1>

        <!-- Content unit - One column -->
        <div class="column1-unit">
	<? 
		if($_POST['name']=="") {die("You have to precise at least a name and a location...");}

		# Secure data reading from POST
		include('read_post_data_item.php');
			
		if (isset($_POST['request'])) {
			# Process creation of new location/type and file uploading
			include('process_request.php');
		} 

		if (($id_supplier=="add")||($id_location=="add")||($id_precise_location=="add")||
			($id_type=="add")||($id_precise_type=="add")) {
			# ask data concerning the location/type to add?>
			<form method="post" action="submit_item.php" > <?
			include('ask_request.php');
		} else {
			# every data is ok, adding the new item to the database	
			$sql = "
			INSERT INTO `product` (
				`id` ,
				`name` ,
				`usual_name` ,
				`extra_name` ,
				`MSDS_External`,
				`id_supplier` ,
				`ref` ,
				`id_location` ,
				`id_precise_location` ,
				`location_infos`,
				`id_type` ,
				`id_precise_type` ,
				`form` ,
				`storage` ,
				`quantity` ,
				`date_of_receipt` ,
				`date_of_opening` ,
				`date_of_expire` ,
				`comments` ,
				`Infos_External`,
				`date_of_entry`,
				`ip`,
				`labo`,
				`has_aliquots`,
				`nb_aliquots`,
				`history`
			)
			VALUES (
				NULL,
				'".safe_read($name)."',
				'".safe_read($usual_name)."',
				'".safe_read($extra_name)."',
				'".safe_read($MSDS_External)."',
				'".safe_read($id_supplier)."',
				'".safe_read($ref)."',
				'".safe_read($id_location)."',
				'".safe_read($id_precise_location)."',
				'".safe_read($location_infos)."',
				'".safe_read($id_type)."',
				'".safe_read($id_precise_type)."',
				'".safe_read($form)."',
				'".safe_read($storage)."',
				'".safe_read($quantity)."',
				'".safe_read($year_of_receipt)."-".safe_read($month_of_receipt)."-00 00:00:00',
				'".safe_read($year_of_opening)."-".safe_read($month_of_opening)."-00 00:00:00',
				'".safe_read($year_of_expire)."-".safe_read($month_of_expire)."-00 00:00:00',
				'".safe_read($comments)."',
				'".safe_read($Information_External)."',
				NOW(),
				'".$NAME_USER."',
				'".$LABO_USER."',
				'".$has_aliquots."',
				'".$nb_aliquots."',
				'coucou'
				);			
			";

			mysql_query($sql) or die("A MySQL error has occurred.<br/>Your query: ".$sql."<br/>Error: ". mysql_errno().") ".mysql_error());
			
			$id_product = mysql_insert_id();
			include('process_uploaded_files.php');
			
		?> 
		Product added! <br>
		
		<a href="show_item.php?id=<? echo $id_product;?>">See last entry.<br></a>		
		<a href="edit_item.php?id=<? echo $id_product;?>">Modify last entry.<br></a>
		<a href="new_item.php">Create a new entry.<br></a>
		<?}?>
	</p>

<? include("end.php"); ?>
