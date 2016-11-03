<? include("begin.php"); ?>
    


	<? include("script_choice.php") ?>

	<? $id_product = $_GET['id'];
	   $sql = "
		SELECT *
		FROM `product` WHERE id=".$id_product." ";
		$result = mysql_query($sql);
		$dat_edit = mysql_fetch_array($result);
		$date_receipt = $dat_edit['date_of_receipt'];
		$date_expire = $dat_edit['date_of_expire'];
		$date_opening = $dat_edit['date_of_opening'];
		$year_receipt = substr($date_receipt, 0, 4);
		$month_receipt = substr($date_receipt, 5, 2);
		$year_expire = substr($date_expire, 0, 4);
		$month_expire = substr($date_expire, 5, 2);
		$year_opening = substr($date_opening, 0, 4);
		$month_opening = substr($date_opening, 5, 2);
	?>
	<? if ($dat_edit['is_template']) { ?>
		<h1>Create item from template</h1>
	<? } else { ?>
		<h1>Modify item</h1>
	<? } $Size_Data='4';?>
	
	<p> Fill the form and submit. If you want to add a supplier, a type or a location, just select
	"add" in the box and submit the form. You will then be asked to detail informations after.</p>
	
	<form method="post" action="switch_modify_item.php" enctype="multipart/form-data">
	<input type="hidden" name="id_product" value="<? echo $id_product ?>" />
	<TABLE BORDER=0>
	<TR>
		<TD>Name</TD>
		<TD colspan="<? echo $Size_Data;?>"><input type="text" name="name" value="<? echo safe_write_textarea($dat_edit['name']); ?>"/></TD>
	</TR><TR>
		<TD>Usual name</TD>
		<TD colspan="<? echo $Size_Data;?>">	<input type="text" name="usual_name" value="<? echo safe_write_textarea($dat_edit['usual_name']); ?>"/></TD>
	</TR><TR>
		<TD>Extra name</TD>
		<TD colspan="<? echo $Size_Data;?>">	<input type="text" name="extra_name" value="<? echo safe_write_textarea($dat_edit['extra_name']); ?>"/></TD>
	</TR><TR>
		<TD>Material Safety Data Sheet <?if ($dat_edit['MSDS_Internal']){?> (click here <input type="checkbox" name="MSDS_Delete" /> to remove it)<?}?> </TD>
		<TD colspan="<? echo $Size_Data;?>"> <input type="file" name="MSDS_Internal" /></TD>
	</TR><TR>
		<TD>Material Safety Data Sheet (External link) </TD>
		<TD colspan="<? echo $Size_Data;?>"> <input type="text" name="MSDS_External" value="<? echo safe_write_textarea($dat_edit['MSDS_External']); ?>"/></TD>
	</TR><TR>
		<TD>Supplier</TD>
	    	<TD colspan="<? echo $Size_Data;?>"><select name="id_supplier">
	    	<option value="0" >---</option>
	        <? 	$sql = "SELECT id,name FROM supplier WHERE labo='".$LABO_USER."' ORDER BY name";
			$result = mysql_query($sql);
			while ($dat = mysql_fetch_array($result) )
			{  ?>
	        	<option value="<?php echo $dat['id']; ?>" <? if ($dat['id']==$dat_edit['id_supplier']) {echo "SELECTED";}?> ><?php echo $dat['name']; ?></option>
	        	<?php } ?>
	        	<option value="add" >add a supplier...</option>
		</select></TD>
	</TR><TR>
		<TD>Ref.</label>
		<TD colspan="<? echo $Size_Data;?>">	<input type="text" name="ref" value="<? echo safe_write_textarea($dat_edit['ref']); ?>"/></TD>
	</TR><TR>
		<TD>Location</TD>
	    	<TD colspan="<? echo $Size_Data;?>"><select name="id_location" id="id_location" onchange="Choix_location(this.form)" onclick="Choix_location(this.form)">
	    	<option value="0" SELECTED>---</option>
	        <? 	$sql = "SELECT id,name FROM location WHERE labo='".$LABO_USER."' ORDER BY name";
			$result = mysql_query($sql);
			while ($dat = mysql_fetch_array($result) )
			{  ?>
	        	<option value="<?php echo $dat['id']; ?>" <? if ($dat['id']==$dat_edit['id_location']) {echo "SELECTED";}?>><?php echo safe_write_textarea($dat['name']); ?></option>
	        	<?php } ?>
	        	<option value="add" >add a location...</option>
		</select></TD>
	</TR><TR>
		<TD>Precise location</TD>
	    	<TD colspan="<? echo $Size_Data;?>"><select name="id_precise_location" id="id_precise_location">
	    	<option value="0" >---</option>
	        <? 	$sql = "SELECT id,name FROM precise_location WHERE id_location=".$dat_edit['id_location']." ORDER BY name";
			$result = mysql_query($sql);
			while ($dat = mysql_fetch_array($result) )
			{  ?>
	        	<option value="<?php echo $dat['id']; ?>" <? if ($dat['id']==$dat_edit['id_precise_location']) {echo "SELECTED";}?>><?php echo $dat['name']; ?></option>
	        	<?php } ?>
	        	<option value="add" >add a precise location...</option>
        	</select></TD>
		
	</TR><TR>
		<TD> Additional information on location</TD>
		<TD colspan="<? echo $Size_Data;?>"><TEXTAREA rows="5" cols="30" name="location_infos" ><? echo safe_write_textarea($dat_edit['location_infos']); ?></TEXTAREA></TD>
	</TR><TR>
		<TD>Type</TD>
	    	<TD colspan="<? echo $Size_Data;?>"><select name="id_type" id="id_type" onchange="Choix_type(this.form)" onclick="Choix_type(this.form)">
	    	<option value="0" >---</option>
	        <? 	$sql = "SELECT id,name  FROM type WHERE labo='".$LABO_USER."' ORDER BY name";
			$result = mysql_query($sql);
			while ($dat = mysql_fetch_array($result) )
			{  ?>
	        	<option value="<?php echo $dat['id']; ?>" <? if ($dat['id']==$dat_edit['id_type']) {echo "SELECTED";}?>><?php echo $dat['name']; ?></option>
	        	<?php } ?>
	        	<option value="add" >add a type...</option>
		</select></TD>
	</TR><TR>
		<TD>Precise type</TD>
	    	<TD colspan="<? echo $Size_Data;?>"><select name="id_precise_type" id="id_precise_type">
	    	<option value="0" >---</option>
	        <? 	$sql = "SELECT id,name FROM precise_type WHERE id_type=".$dat_edit['id_type']." ORDER BY name";
			$result = mysql_query($sql);
			while ($dat = mysql_fetch_array($result) )
			{  ?>
	        	<option value="<?php echo $dat['id']; ?>" <? if ($dat['id']==$dat_edit['id_precise_type']) {echo "SELECTED";}?>><?php echo $dat['name']; ?></option>
	        	<?php } ?>
	        	<option value="add" >add a precise type...</option>
		</select></TD>
	</TR><TR>
		<TD>Form (powder, liquid) </TD>
		<TD colspan="<? echo $Size_Data;?>">	<input type="text" name="form" value="<? echo safe_write_textarea($dat_edit['form']); ?>"/></TD>
	</TR><TR>
		<TD>Storage</TD>
		<TD colspan="<? echo $Size_Data;?>">	<input type="text" name="storage" value="<? echo safe_write_textarea($dat_edit['storage']); ?>"/></TD>
	</TR><TR>
		<TD> Quantity </TD>
		<TD colspan="<? echo $Size_Data;?>">	<input type="text" name="quantity" value="<? echo safe_write_textarea($dat_edit['quantity']); ?>"/></TD>
	</TR><TR>
		<TD colspan="<? echo $Size_Data;?>"> Does it have aliquots ? </TD>
		<TD>	<input type="checkbox" name="has_aliquots" value="1" <?  if ($dat_edit['has_aliquots']) {echo 'CHECKED';} ?>/></TD>
        </TR><TR>
		<TD colspan="<? echo $Size_Data;?>"> Number of aliquots </TD>
		<TD>	<input type="text" name="nb_aliquots" value="<? echo $dat_edit['nb_aliquots'] ?>"/></TD>
        </TR><TR>
        	<TD>Date of receipt</TD>
	    	<TD colspan="<? echo $Size_Data;?>"><? $month_SELECTED=$month_receipt; $year_SELECTED=$year_receipt ?>
		<select name="month_of_receipt">
		<? include("select_month.php") ?> 
		</select>
		<select name="year_of_receipt">
		<? include("select_year.php") ?> 
		</select></TD>
	</TR><TR>
		<TD>Opening date</TD>
	    	<TD colspan="<? echo $Size_Data;?>"><? $month_SELECTED=$month_opening; $year_SELECTED=$year_opening ?>
		<select name="month_of_opening">
		<? include("select_month.php") ?> 
		</select>
		<select name="year_of_opening">
		<? include("select_year.php") ?> 
		</select></TD>
	</TR><TR>
		<TD>Expire date</TD>
	    	<TD colspan="<? echo $Size_Data;?>"><? $month_SELECTED=$month_expire; $year_SELECTED=$year_expire ?>
		<select name="month_of_expire">
		<? include("select_month.php") ?> 
		</select>
		<select name="year_of_expire">
		<? include("select_year.php") ?> 
		</select></TD>
	</TR><TR>
		<TD> Misc Infos</TD>
		<TD colspan="<? echo $Size_Data;?>"><TEXTAREA rows="40" cols="60" name="comments" ><? echo safe_write_textarea($dat_edit['comments']); ?></TEXTAREA></TD>
	</TR><TR>
		<TD>Product Information <?if ($dat_edit['Infos_Internal']){?> (click here <input type="checkbox" name="PIS_Delete" /> to remove it) <?}?></TD>
		<TD colspan="<? echo $Size_Data;?>"> <input type="file" name="Infos_Internal" /></TD>
	</TR><TR>
		<TD>Product Information (External link) </TD>
		<TD colspan="<? echo $Size_Data;?>"> <input type="text" name="Information_External" value="<? echo safe_write_textarea($dat_edit['Infos_External']); ?>"/></TD>
	</TR><TR>
		<TD></TD>
		<TD colspan="<? echo $Size_Data;?>">
				<?if ($dat_edit['is_template']==1) { ?>
				<input type="submit" name="Save_as_new" value="Save as new item" />
				<input type="submit" value="Save template modifications" /> <? } else { ?>
				<input type="submit" value="Save modifications" />
				<input type="submit" name="Save_as_new" value="Save as new item" />
				<input type="submit" name="Save_as_new_template" value="Save as new template" />
				<? } ?>
				<!---<input type="submit" name="Save_as_template" value="Save as new template" /> --->
			</form>
		</TD>
		</TR>
	</TABLE>
	
	
	<script type="text/javascript"> Choix_location(document.form);</script>

<? include("end.php"); ?>
