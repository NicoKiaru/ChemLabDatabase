<? include("begin.php"); ?>
	<? $id_product = $_GET['id'];
	/* Check the product belongs to the lab of the user */
	$sql= " SELECT `labo`
		FROM `product`
		WHERE id ='".$id_product."'
		LIMIT 1 
		";
	$result = mysql_query($sql);
	$dat = mysql_fetch_array($result);
	if ($dat[0]==$LABO_USER) {
	?>
        <h1>Removing an item</h1>
 	<? 
	   $sql = "
		DELETE FROM `product` WHERE `product`.`id` = ".$_GET['id']." LIMIT 1
		";
	   $result = mysql_query($sql);
	?>
	<p>The product has been removed from the database.</p>
	<? } else {?>
	<p> You are not allowed to remove an item that does not belong to your lab.</p>
	<?}?>

<? include("end.php"); ?>
