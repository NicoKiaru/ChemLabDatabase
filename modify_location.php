<? include("begin.php"); ?>
	<? $id = $_POST['id'];
	/* Check the product belongs to the lab of the user */
	$sql= " SELECT `labo`
		FROM `location`
		WHERE id ='".$id."'
		LIMIT 1 
		";
	$result = mysql_query($sql);
	$dat = mysql_fetch_array($result);
	if ($dat[0]==$LABO_USER) {
	?>
        <h1>Modify location</h1>

        <!-- Content unit - One column -->
        <div class="column1-unit">
	<p>
		<? 
		if($_POST['name']=="") {die("You have to precise at least a name...");}
		$name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
	
		

		$sql = "
		UPDATE `location` SET
			`name` = '".$name."'
		
		WHERE  `location`.`id` =".$id." LIMIT 1 ;
		";
		mysql_query($sql);
		?> 
			<?
		$sql= "
		SELECT *
		FROM `precise_location`
		WHERE id_location=".$id."
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
			DELETE FROM `precise_location` WHERE `precise_location`.`id` = ".$dat_p['id']." LIMIT 1
			";
			$result = mysql_query($sql);
			} else {
			$add = "name_".$dat_p['id'];
			$n_name = mysql_real_escape_string(htmlspecialchars($_POST[$add]));
			$sql = "
			UPDATE `precise_location` SET
			`name` = '".$n_name."'
			WHERE  `precise_location`.`id` =".$dat_p['id']." LIMIT 1 ;
			";
			mysql_query($sql);
			}
		}}?>
		Location modified! <br>
		<a href="show_location.php?id=<? echo $id;?>">See last entry.<br></a>		
		<a href="edit_location.php?id=<? echo $id;?>">Modify last entry.<br></a>
		<?
		

	?>
	</p>
	<? } else {?>
	<p> You are not allowed to modify this location as you are not in <? echo $dat[0]; ?> lab.</p>
	<?}?>

<? include("end.php"); ?>
