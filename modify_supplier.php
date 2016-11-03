<? include("begin.php"); ?>
	<? $id_product = $_POST['id'];
	/* Check the product belongs to the lab of the user */
	$sql= " SELECT `labo`
		FROM `supplier`
		WHERE id ='".$id_product."'
		LIMIT 1 
		";
	$result = mysql_query($sql);
	$dat = mysql_fetch_array($result);
	if ($dat[0]==$LABO_USER) {
	?>
        <h1>Modify supplier</h1>

        <!-- Content unit - One column -->
        <div class="column1-unit">
	<p>
	<? 
		if($_POST['name']=="") {die("You have to precise at least a name...");}
		$name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
	
		$contact = mysql_real_escape_string(htmlspecialchars($_POST['contact']));
	
		$link = mysql_real_escape_string(htmlspecialchars($_POST['link']));

		$id = mysql_real_escape_string(htmlspecialchars($_POST['id']));

		$sql = "
		UPDATE  `supplier` SET
			`name` = '".$name."',
			`contact` = '".$contact."',
			`link` = '".$link."'
			
		WHERE  `supplier`.`id` =".$id." LIMIT 1 ;
		";
	
		mysql_query($sql);
		?> 
		Supplier modified! <br>
		<a href="show_supplier.php?id=<? echo $id;?>">See last entry.<br></a>		
		<a href="edit_supplier.php?id=<? echo $id;?>">Modify last entry.<br></a>
		<?
		

	?>
	</p>
	<? } else {?>
	<p> You are not allowed to modify this supplier as you are not in <? echo $dat[0]; ?> lab.</p>
	<?}?>

<? include("end.php"); ?>
