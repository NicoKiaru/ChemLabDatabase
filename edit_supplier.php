<? include("begin.php"); ?>

        <h1>Modify supplier</h1>

        <!-- Content unit - One column -->
        <div class="column1-unit">

	<? $id = $_GET['id'];
	   $sql = "
		SELECT *
		FROM `supplier` WHERE id=".$id." ";
		$result = mysql_query($sql);
		$dat_edit = mysql_fetch_array($result);
	?>

	<form method="post" action="modify_supplier.php" >
	<input type="hidden" name="id" value="<? echo $id ?>" />
	<TABLE BORDER=0>
	<TR>
		<TD>Name</TD>
		<TD colspan="2"><input type="text" name="name" value="<? echo $dat_edit['name'] ?>"/></TD>
	</TR><TR>
		<TD>Contact</TD>
		<TD colspan="2">	<input type="text" name="contact" value="<? echo $dat_edit['contact'] ?>"/></TD>
	</TR><TR>
		<TD>Website</label>
		<TD colspan="2">	<input type="text" name="link" value="<? echo $dat_edit['link'] ?>"/></TD>
	</TR><TR>
		<TD></TD>
		<TD colspan="2"><input type="submit" value="Save" /><input type="reset" value="Reset form"></TD>
		</TR>
	</TABLE>
	
	</form>


<? include("end.php"); ?>
