<? include("begin.php"); ?>

	<? include("script_choice.php") ?>
        <h1>New item</h1>
	<p> Fill the form and submit. If you want to add a supplier, a type or a location, just select
	"add" in the box and submit the form. You will then be asked to detail informations after.</p>

	<form method="post" action="switch_submit_item.php" enctype="multipart/form-data">
	<TABLE BORDER=0>
	<TR>
		<TD><strong>Name</strong></TD>
		<TD colspan="2"><input type="text" name="name" /></TD>
	</TR><TR>
		<TD>Usual name</TD>
		<TD colspan="2">	<input type="text" name="usual_name" /></TD>
	</TR><TR>
		<TD>Extra name</label>
		<TD colspan="2">	<input type="text" name="extra_name" /></TD>
	</TR><TR>
		<TD>Safety Data Sheet </TD>
		<TD colspan="2"> <input type="file" name="MSDS_Internal" /></TD>
	</TR><TR>
		<TD>Safety Data Sheet (External link) </TD>
		<TD colspan="2"> <input type="text" name="MSDS_External" /></TD>
	</TR><TR>
		<TD>Supplier</TD>
	    	<TD colspan="2"><select name="id_supplier">
	    	<option value="0" >---</option>
	        <? 	$sql = "SELECT id,name FROM supplier WHERE labo='".$LABO_USER."' ORDER BY name";
			$result = mysql_query($sql);
			while ($dat = mysql_fetch_array($result) )
			{  ?>
	        	<option value="<?php echo $dat['id']; ?>" ><?php echo $dat['name']; ?></option>
	        	<?php } ?>
	        	<option value="add" >add a supplier...</option>
		</select></TD>
	</TR><TR>
		<TD>Ref.</label>
		<TD colspan="2">	<input type="text" name="ref" /></TD>
	</TR><TR>
		<TD><strong>Location</strong></TD>
	    	<TD colspan="2"><select name="id_location" id="id_location" onchange="Choix_location(this.form)" onclick="Choix_location(this.form)">
	    	<option value="0" SELECTED>---</option>
	        <? 	$sql = "SELECT id,name FROM location WHERE labo='".$LABO_USER."' ORDER BY name";
			$result = mysql_query($sql);
			while ($dat = mysql_fetch_array($result) )
			{  ?>
	        	<option value="<?php echo $dat['id']; ?>" ><?php echo $dat['name']; ?></option>
	        	<?php } ?>
	        	<option value="add" >add a location...</option>
		</select></TD>
	</TR><TR>
		<TD>Precise location</TD>
	    	<TD colspan="2"><select name="id_precise_location" id="id_precise_location">
	    	<option value="0" >---</option>
        	</select></TD>
		
	</TR><TR>
		<TD>Additional information on location</TD>
	    	<TD colspan="2"><TEXTAREA rows="5" cols="30" name="location_infos"></TEXTAREA></TD>
	</TR><TR>
		<TD>Type</TD>
	    	<TD colspan="2"><select name="id_type" id="id_type" onchange="Choix_type(this.form)" onclick="Choix_type(this.form)">
	    	<option value="0" >---</option>
	        <? 	$sql = "SELECT id,name FROM type WHERE labo='".$LABO_USER."' ORDER BY name";
			$result = mysql_query($sql);
			while ($dat = mysql_fetch_array($result) )
			{  ?>
	        	<option value="<?php echo $dat['id']; ?>" ><?php echo $dat['name']; ?></option>
	        	<?php } ?>
	        	<option value="add" >add a type...</option>
		</select></TD>
	</TR><TR>
		<TD>Precise type</TD>
	    	<TD colspan="2"><select name="id_precise_type" id="id_precise_type">
	    	<option value="0" >---</option>
		</select></TD>
	</TR><TR>
		<TD>Form (powder, liquid) </TD>
		<TD colspan="2">	<input type="text" name="form" /></TD>
	</TR><TR>
		<TD>Storage</TD>
		<TD colspan="2">	<input type="text" name="storage" /></TD>
	</TR><TR>
		<TD> Quantity </TD>
		<TD colspan="2">	<input type="text" name="quantity" /></TD>
        </TR><TR>
		<TD colspan="2"> Does it have aliquots ? </TD>
		<TD>	<input type="checkbox" name="has_aliquots" value="1" /></TD>
        </TR><TR>
		<TD colspan="2"> Number of aliquots </TD>
		<TD>	<input type="text" name="nb_aliquots" value="0"/></TD>
	</TR><TR>
		<TD>Date of receipt</TD>
	    	<TD colspan="2"><? $month_SELECTED="00"; $year_SELECTED="00" ?>
		<select name="month_of_receipt">
		<? include("select_month.php") ?> 
		</select>
		<select name="year_of_receipt">
		<? include("select_year.php") ?> 
		</select></TD>
	</TR><TR>
		<TD>Opening date</TD>
	    	<TD colspan="2"><? $month_SELECTED="00"; $year_SELECTED="00" ?>
		<select name="month_of_opening">
		<? include("select_month.php") ?> 
		</select>
		<select name="year_of_opening">
		<? include("select_year.php") ?> 
		</select></TD>
	</TR><TR>
		<TD>Expire date</TD>
	    	<TD colspan="2"><? $month_SELECTED="00"; $year_SELECTED="00" ?>
		<select name="month_of_expire">
		<? include("select_month.php") ?> 
		</select>
		<select name="year_of_expire">
		<? include("select_year.php") ?> 
		</select></TD>
	</TR><TR>
		<TD> Comments (storage buffer...)</TD>
		<TD colspan="2"><TEXTAREA rows="40" cols="60" name="comments"></TEXTAREA></TD>
	</TR><TR>
		<TD>Product Information </TD>
		<TD colspan="2"> <input type="file" name="Infos_Internal" /></TD>
	</TR><TR>
		<TD>Product Information (External link) </TD>
		<TD colspan="2"> <input type="text" name="Information_External" /></TD>
	</TR><TR>
		<TD></TD>
		<TD colspan="2"><input type="submit" value="Save" /><input type="submit" name="Save_as_template" value="Save as template" /></TD>
		</TR>
	</TABLE>

	</form>
	<script type="text/javascript"> Choix_location(document.form);</script>

<? include("end.php"); ?>
