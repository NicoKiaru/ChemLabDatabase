<? include("begin.php"); ?>
	<? $id_product = $_GET['id'];
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
        <h1>Removing a supplier</h1>
	<? $id_product = $_GET['id'];
	   $sql = "
		DELETE FROM `supplier` WHERE `supplier`.`id` = ".$_GET['id']." LIMIT 1
		";
	   $result = mysql_query($sql);
	?>
	<p>The supplier has been removed from the database.</p>
	<? } else {?>
	<p> You are not allowed to remove this supplier as you are not in <? echo $dat[0]; ?> lab.</p>
	<?}?>


<? include("end.php"); ?>
