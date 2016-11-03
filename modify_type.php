<? include("begin.php"); ?>
	<? $id_product = $_POST['id'];
	/* Check the product belongs to the lab of the user */
	$sql= " SELECT `labo`
		FROM `type`
		WHERE id ='".$id_product."'
		LIMIT 1 
		";
	$result = mysql_query($sql);
	$dat = mysql_fetch_array($result);
	if ($dat[0]==$LABO_USER) {
	?>
        <h1>Modify type</h1>

        <!-- Content unit - One column -->
        <div class="column1-unit">
	<p>
		<? 
		if($_POST['name']=="") {die("You have to precise at least a name...");}
		$name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
	
		$id = mysql_real_escape_string(htmlspecialchars($_POST['id']));

		$sql = "
		UPDATE `type` SET
			`name` = '".$name."'
		
		WHERE  `type`.`id` =".$id." LIMIT 1 ;
		";
		mysql_query($sql);
		?> 
			<?
		$sql= "
		SELECT *
		FROM `precise_type`
		WHERE id_type=".$id."
		ORDER BY `name`
		";
		$result_p = mysql_query($sql);
		while ($dat_p = mysql_fetch_array($result_p) )
		{
		$add = "del_".$dat_p['id'];
		{
		$del = $_POST[$add];
		if ($del=="on") {
			$sql = "
			DELETE FROM `precise_type` WHERE `precise_type`.`id` = ".$dat_p['id']." LIMIT 1
			";
			$result = mysql_query($sql);
			} else {
			$add = "name_".$dat_p['id'];
			$n_name = mysql_real_escape_string(htmlspecialchars($_POST[$add]));
			$sql = "
			UPDATE `precise_type` SET
			`name` = '".$n_name."'
			WHERE  `precise_type`.`id` =".$dat_p['id']." LIMIT 1 ;
			";
			mysql_query($sql);
			}
		}}?>
		Type modified! <br>
		<a href="show_type.php?id=<? echo $id;?>">See last entry.<br></a>		
		<a href="edit_type.php?id=<? echo $id;?>">Modify last entry.<br></a>
		<?
		

	?>
	</p>
	</div>
	<? } else {?>
	<p> You are not allowed to modify this type as you are not in <? echo $dat[0]; ?> lab.</p>
	<?}?>

<? include("end.php"); ?>
