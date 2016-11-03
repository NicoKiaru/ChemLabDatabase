<? include("begin.php"); ?>

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

      
	<? $id_product = $_GET['id'];
	   $sql = "
		SELECT *
		FROM `product` WHERE id=".$id_product." ";
		$result = mysql_query($sql);
		$dat_edit = mysql_fetch_array($result);
		$date_receipt= $dat_edit['date_of_receipt'];
		$year_receipt = substr($date_receipt, 0, 4);
		$month_receipt = substr($date_receipt, 5, 2);
	?>
			<? if ($dat_edit['is_template']) { ?>
			<h2><a href="#">Template</a></h2>
			<? } else { ?>
			<h2><a href="#">Chemical informations</a></h2>
			<? } ?>
			
				<p><small>Last modification on <? echo $dat_edit['date_of_entry'] ?> by <? echo $dat_edit['ip'] ?>.</p>
	<div class="post">
			<div class="title">
				<h2><a href="#"><? echo safe_write_html($dat_edit['name']); ?></a></h2>
				<p><? if ($dat_edit['usual_name']!="") { echo safe_write_html($dat_edit['usual_name']); }
				      if ($dat_edit['extra_name']!="") { echo " or ".safe_write_html($dat_edit['extra_name']); } ?></p>
			</div>
	<div class="entry">
		<p>
	<TABLE BORDER=0>
	<? if 	($dat_edit['MSDS_Internal']) { ?>	
	<TR>
		<TD colspan="3"><a href=<? echo "msds/MSDS_".$dat_edit['id'].".pdf"; ?>> Material Safety Data Sheet</a></TD>
	</TR>
	<?} if 	($dat_edit['MSDS_External']!="") { ?>	
	<TR>
		<TD colspan="3"><a href="<? echo safe_write_html($dat_edit['MSDS_External']); ?>"> Material Safety Data Sheet (external link)</a></TD>
	</TR>
	<?} if 	($dat_edit['id_supplier']!=0) { ?>	
	<TR>
		<TD>Supplier</TD>
	    	<TD colspan="2">
	        <? 	$sql = "SELECT name,link FROM supplier WHERE id=".$dat_edit['id_supplier']."";
			$result = mysql_query($sql);
			$dat = mysql_fetch_array($result);
			if ($dat['link']=="") {
			echo safe_write_html($dat['name']); } else {
			?>
			<a href="<? echo safe_write_html($dat['link']) ?>"><? echo safe_write_html($dat['name']) ?></a> <?
			}?>
		</TD>
	</TR>
	<?} if 	($dat_edit['ref']!="") { ?>
	<TR>
		<TD>Ref.</label>
		<TD colspan="2"><? echo safe_write_html($dat_edit['ref']); ?></TD>
	</TR>
	<?} if 	($dat_edit['id_location']!=0) { ?>
	<TR>
		<TD>Location</TD>
	    	<TD colspan="2">    	
	        <? 	$sql= " SELECT `labo`
				FROM `product`
				WHERE id ='".$id_product."'
				LIMIT 1 
				";
			$result = mysql_query($sql);
			$dat = mysql_fetch_array($result);
			echo $dat[0]." Lab > ";
			$sql = "SELECT name FROM location WHERE id=".$dat_edit['id_location']."";
			$result = mysql_query($sql);
			$dat = mysql_fetch_array($result);
			echo safe_write_html($dat['name']); ?>
		
	<?} if 	($dat_edit['id_precise_location']!=0) { ?>
	
	        <? 	$sql = "SELECT name FROM precise_location WHERE id=".$dat_edit['id_precise_location']."";
			$result = mysql_query($sql);
			$dat = mysql_fetch_array($result);
			echo "> ".safe_write_html($dat['name']); }
		if 	($dat_edit['location_infos']!="") {
			echo " > ".safe_write_html($dat_edit['location_infos']);}?>
		</TD>
	</TR>
	<? if 	($dat_edit['id_type']!=0) { ?>
	<TR>
		<TD>Type</TD>
	    	<TD colspan="2">	    	
	        <? 	$sql = "SELECT name FROM type WHERE id=".$dat_edit['id_type']."";
			$result = mysql_query($sql);
			$dat = mysql_fetch_array($result);
			echo safe_write_html($dat['name']); 
		
	} if 	($dat_edit['id_precise_type']!=0) { ?>
	    	
	        <? 	$sql = "SELECT name FROM precise_type WHERE id=".$dat_edit['id_precise_type']."";
			$result = mysql_query($sql);
			$dat = mysql_fetch_array($result);
			echo " > ".safe_write_html($dat['name']); }
			
			 ?>
		</TD>
	</TR>

	<? if 	($dat_edit['form']!="") { ?>
	<TR>
		<TD>Form (pouder, liquid) </TD>
		<TD colspan="2"><? echo safe_write_html($dat_edit['form']); ?></TD>
	</TR>
	<?} if 	($dat_edit['storage']!="") { ?>
	<TR>
		<TD>Storage</TD>
		<TD colspan="2"><? echo safe_write_html($dat_edit['storage']); ?></TD>
	</TR>
	<?} if 	($dat_edit['quantity']!="") { ?>
	<TR>
		<TD> Quantity </TD>
		<TD colspan="2"><? echo safe_write_html($dat_edit['quantity']); ?></TD>
	</TR>
	<?} if 	($dat_edit['has_aliquots']) { ?>
	<TR>
		<TD> Remaining aliquots </TD>
		<TD colspan="2" <? if (($dat_edit['nb_aliquots'])==0) { ?> style="text-align:center;color:white;background-color:red" <? } ?>
				<? if (($dat_edit['nb_aliquots'])==1) { ?> style="text-align:center;background-color:orange" <? } ?>                
				<? if (($dat_edit['nb_aliquots'])==2) { ?> style="text-align:center;background-color:orange" <? } ?>
				<? if (($dat_edit['nb_aliquots'])>2) { ?> style="text-align:center;color:white;background-color:green" <? } ?>
		> <? echo $dat_edit['nb_aliquots'] ?></TD>
	</TR>
	<?} if 	($dat_edit['date_of_receipt']!="0000-00-00") { ?>
	<TR>
		<TD>Date of receipt</TD>
	    	<TD colspan="2"><? echo substr($dat_edit['date_of_receipt'],0,7) ?></TD>
	</TR>
	<?} if 	($dat_edit['date_of_opening']!="0000-00-00") { ?>
	<TR>
		<TD>Date of opening</TD>
	    	<TD colspan="2"><? echo substr($dat_edit['date_of_opening'],0,7) ?></TD>
	</TR>
	<?} if 	($dat_edit['date_of_expire']!="0000-00-00") { ?>
	<TR>
		<TD>Date of expire</TD>
	    	<TD colspan="2"><? echo substr($dat_edit['date_of_expire'],0,7) ?></TD>
	</TR>
	<?} if 	($dat_edit['comments']!="") { ?>
	<TR>
		<TD> Misc Infos</TD>
		<TD colspan="2">
<? echo safe_write_html(str_replace("\\r\\n","<br>",$dat_edit['comments'])); ?>
</TD>
	</TR>
	<?} if 	($dat_edit['Infos_Internal']) { ?>	
	<TR>
		<TD colspan="3"><a href=<? echo "Information_Sheets/Information_Sheet_".$dat_edit['id'].".pdf"; ?>> Product Information Sheet</a></TD>
	</TR>
	<?} if 	($dat_edit['Infos_External']!="") { ?>	
	<TR>
		<TD colspan="3"><a href="<? echo safe_write_html($dat_edit['Infos_External']); ?>"> Product Information Sheet (external link)</a></TD>
	</TR>
	<?}?>
	<? 
	/* Check the product belongs to the lab of the user */
	$sql= " SELECT `labo`
		FROM `product`
		WHERE id ='".$id_product."'
		LIMIT 1 
		";
	$result = mysql_query($sql);
	$dat = mysql_fetch_array($result);
	if ($dat[0]==$LABO_USER) {?>
	<TR>
		<TD><form method="post" action="edit_item.php?<? echo "id=".$id_product."" ?>" >
			<input type="submit" value="Modify" />
			</form>
		</TD>
		<TD colspan="2"><form method="post" action="delete_item.php?<? echo "id=".$id_product."" ?>" >
			<input type="submit" value="Delete" onClick="return confirmSubmit()"/>
			</form>
		</TD>
	</TR>
	<?} else {?><TR><TD colspan="3"> This product belongs to <? echo $dat[0] ?> lab.</TD></TR><?}?>
	</TABLE> </p>
				</div>
		<p class="links"> </p>
	</div>

<? include("end.php"); ?>
