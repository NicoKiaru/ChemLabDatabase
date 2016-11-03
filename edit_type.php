<? include("begin.php"); ?>

        <h1>Modify type</h1>

  	<? $id = $_GET['id'];
	   $sql = "
		SELECT *
		FROM `type` WHERE id=".$id." ";
		$result = mysql_query($sql);
		$dat_edit = mysql_fetch_array($result);
	?>
	Click the checkbox (if any) to <strong> delete </strong> the precise_type.<br>
	<form method="post" action="modify_type.php" >
	<input type="hidden" name="id" value="<? echo $id ?>" />
	<TABLE BORDER=0>
	<TR>
		<TD><input type="text" name="name" value="<? echo $dat_edit['name'] ?>"/></TD>
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
		<TD><input type="checkbox" name="del_<? echo $dat_p['id'] ?>" ></TD>
		<TD colspan="2">
		<h6><input type="text" name="name_<? echo $dat_p['id'] ?>" value="<? echo $dat_p['name'] ?>"/></h6>
		</TD>
		</TR>
		<?
	}?>

	<TR>
		<TD></TD>
		<TD colspan="2"><input type="submit" value="Save" /></TD>
		</TR>
	</TABLE>
	
	</form>


<? include("end.php"); ?>
