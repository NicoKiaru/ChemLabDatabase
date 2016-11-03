<? include("begin.php"); ?>

        <h1>Supplier informations</h1>

        <!-- Content unit - One column -->
        <div class="column1-unit">
	<script LANGUAGE="JavaScript">
	function confirmSubmit()
	{
		var agree=confirm("Are you sure you wish to continue?");
	if (agree)
		return true ;
	else
		return false ;
	}
	</script>



	<? $id = $_GET['id'];
	   $sql = "
		SELECT *
		FROM `supplier` WHERE id=".$id." ";
		$result = mysql_query($sql);
		$dat_edit = mysql_fetch_array($result);
	?>
	<TABLE BORDER=0>
	<TR>	
		<TD>Name</TD>
		<TD colspan="2"><? echo $dat_edit['name'] ?></TD>
	</TR>
	<? if 	($dat_edit['contact']!="") { ?>
	<TR>
		<TD>Contact</TD>
		<TD colspan="2"><? echo $dat_edit['contact'] ?></TD>
	</TR>
	<?} if 	($dat_edit['link']!="") { ?>	
	<TR>
		<TD>Website</label>
		<TD colspan="2"><a href="<? echo $dat_edit['link'] ?>"><? echo $dat_edit['link'] ?></a></TD>
	</TR><?}?>
	<? 
	/* Check the supplier belongs to the lab of the user */
	$sql= " SELECT `labo`
		FROM `supplier`
		WHERE id ='".$id."'
		LIMIT 1 
		";
	$result = mysql_query($sql);
	$dat = mysql_fetch_array($result);
	if ($dat[0]==$LABO_USER) {?>	
	<TR>
		<TD><form method="post" action="edit_supplier.php?<? echo "id=".$id."" ?>" >
			<input type="submit" value="Modify" />
			</form>
		</TD>
		<TD colspan="2"><form method="post" action="delete_supplier.php?<? echo "id=".$id."" ?>" >
			<input type="submit" value="Delete" onClick="return confirmSubmit()"/>
			</form>
		</TD>
	</TR>
	<?} else {?><TR><TD colspan="3"> This is a supplier from <? echo $dat[0] ?> lab.</TD></TR><?}?>
	</TABLE>
	

<? include("end.php"); ?>
