<? include("begin.php"); ?>

        <h1 >Type infos</h1>



	<? $id = $_GET['id'];
	   $sql = "
		SELECT *
		FROM `type` WHERE id=".$id." ";
		$result = mysql_query($sql);
		$dat_edit = mysql_fetch_array($result);
	?>
	<TABLE BORDER=0>
	<TR>	
		<TD><? echo $dat_edit['name'] ?></TD>
		<TD colspan="2"></TD>
	</TR>
	<?
	$sql= "
	 SELECT *
		FROM `precise_type`
		WHERE id_type=".$dat_edit['id']."
		ORDER BY `name`
		";
		$result_p = mysql_query($sql);
		while ($dat_p = mysql_fetch_array($result_p) )
		{?>
		<TR>
		<TD></TD>
		<TD colspan="2">
		<h6> <? echo $dat_p['name']; ?> </h6>
		</TD>
		</TR>
		<?
		}?>
	<? 
	/* Check the supplier belongs to the lab of the user */
	$sql= " SELECT `labo`
		FROM `type`
		WHERE id ='".$id."'
		LIMIT 1 
		";
	$result = mysql_query($sql);
	$dat = mysql_fetch_array($result);
	if ($dat[0]==$LABO_USER) {?>
	<TR>
		<TD><form method="post" action="edit_type.php?<? echo "id=".$id."" ?>" >
			<input type="submit" value="Modify" />
			</form>
		</TD>
		<TD colspan="2"></TD>
		</TR>
		<?} else {?><TR><TD colspan="3"> This is a type in <? echo $dat[0] ?> lab.</TD></TR><?}?>
	</TABLE>
	

<? include("end.php"); ?>
