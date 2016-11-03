		
		<?if (isset($id_product)) { ?>
		<input type="hidden" name="id_product" value="<? echo $id_product ?>" /> <?} ?>
		<input type="hidden" name="name" value= <? echo '"'.$name.'"'; ?>/>
		<input type="hidden" name="usual_name" value= <? echo '"'.$usual_name.'"'; ?>/>		
		<input type="hidden" name="extra_name" value= <? echo '"'.$extra_name.'"'; ?>/>	
		<input type="hidden" name="MSDS_External" value= <? echo '"'.$MSDS_External.'"'; ?>/>	
		<input type="hidden" name="ref" value= <? echo '"'.$ref.'"'; ?>/>		
		<input type="hidden" name="form" value= <? echo '"'.$form.'"'; ?>/>		
		<input type="hidden" name="storage" value= <? echo '"'.$storage.'"'; ?>/>
		<input type="hidden" name="quantity" value= <? echo '"'.$quantity.'"'; ?>/>
		<input type="hidden" name="has_aliquots" value= <? echo '"'.$has_aliquots.'"'; ?>/>
		<input type="hidden" name="nb_aliquots" value= <? echo '"'.$nb_aliquots.'"'; ?>/>
		<input type="hidden" name="month_of_receipt" value= <? echo '"'.$month_of_receipt.'"'; ?>/>
		<input type="hidden" name="year_of_receipt" value= <? echo '"'.$year_of_receipt.'"'; ?>/>
		<input type="hidden" name="month_of_opening" value= <? echo '"'.$month_of_opening.'"'; ?>/>
		<input type="hidden" name="year_of_opening" value= <? echo '"'.$year_of_opening.'"'; ?>/>
		<input type="hidden" name="month_of_expire" value= <? echo '"'.$month_of_expire.'"'; ?>/>
		<input type="hidden" name="year_of_expire" value= <? echo '"'.$year_of_expire.'"'; ?>/>
		<input type="hidden" name="comments" value= <? echo '"'.htmlspecialchars_decode(str_replace("\\r\\n","\n",$comments)).'"'; ?>/>
		<input type="hidden" name="location_infos" value= <? echo '"'.htmlspecialchars_decode(str_replace("\\r\\n","\n",$location_infos)).'"'; ?>/>
		<input type="hidden" name="Information_External" value= <? echo '"'.$Information_External.'"'; ?>/>
		<?
		if (isset($nom_tmp_IS)) { ?>
		<input type="hidden" name="nom_tmp_IS" value= <? echo '"'.$nom_tmp_IS.'"'; ?>/> <?}
		if (isset($nom_tmp_MSDS)) { ?>
		<input type="hidden" name="nom_tmp_MSDS" value= <? echo '"'.$nom_tmp_MSDS.'"'; ?>/> <?}		
		?>
		<?
		if ($id_supplier=="add") {
			echo "Please precise informations for the <strong>supplier</strong> of ".$_POST['name'].". <br>";
		?>
	<input type="hidden" name="id_location" value= <? echo '"'.$id_location.'"'; ?>/>
	<input type="hidden" name="id_type" value= <? echo '"'.$id_type.'"'; ?>/>
	<input type="hidden" name="id_precise_location" value= <? echo '"'.$id_precise_location.'"'; ?>/>
	<input type="hidden" name="id_precise_type" value= <? echo '"'.$id_precise_type.'"'; ?>/>
	<input type="hidden" name="request" value= "supplier"/>

	<TABLE BORDER=0>
	<TR>
		<TD>Name of the supplier</TD>
		<TD colspan="2"><input type="text" name="name_supplier" /></TD>
	</TR><TR>
		<TD>Contact</TD>
		<TD colspan="2"><input type="text" name="contact_supplier" /></TD>
	</TR><TR>
		<TD>Website</TD>
		<TD colspan="2"><input type="text" name="link_supplier" /></TD>
	</TR>
	</TABLE>
		<?
		} elseif ($id_location=="add") {
		echo "Please precise the <strong> location</strong> of ".$_POST['name'].". <br>";
		?>
	<input type="hidden" name="id_supplier" value= <? echo '"'.$id_supplier.'"'; ?>/>		
	<input type="hidden" name="id_type" value= <? echo '"'.$id_type.'"'; ?>/>
	<input type="hidden" name="id_precise_location" value= <? echo '"'.$id_precise_location.'"'; ?>/>
	<input type="hidden" name="id_precise_type" value= <? echo '"'.$id_precise_type.'"'; ?>/>
	<input type="hidden" name="request" value= "location"/>

	<input type="text" name="name_location" />
		<?
		} elseif ($id_precise_location=="add") {
		echo "Please precise the <strong> precise location</strong> of ".$_POST['name'].". <br>";		
		?>
	<input type="hidden" name="id_supplier" value= <? echo '"'.$id_supplier.'"'; ?>/>		
	<input type="hidden" name="id_location" value= <? echo '"'.$id_location.'"'; ?>/>
	<input type="hidden" name="id_type" value= <? echo '"'.$id_type.'"'; ?>/>
	<input type="hidden" name="id_precise_type" value= <? echo '"'.$id_precise_type.'"'; ?>/>
	<input type="hidden" name="request" value= "p_location"/>
	
	<input type="text" name="name_p_location" />
		<?
		} elseif ($id_type=="add") {
		echo "Please precise the <strong> type</strong> of ".$_POST['name'].". <br>";	
		?>
	<input type="hidden" name="id_supplier" value= <? echo '"'.$id_supplier.'"'; ?>/>		
	<input type="hidden" name="id_location" value= <? echo '"'.$id_location.'"'; ?>/>
	<input type="hidden" name="id_precise_location" value= <? echo '"'.$id_precise_location.'"'; ?>/>
	<input type="hidden" name="id_precise_type" value= <? echo '"'.$id_precise_type.'"'; ?>/>
	<input type="hidden" name="request" value= "type"/>

	<input type="text" name="name_type" />
		<?
		} elseif ($id_precise_type=="add") {
		echo "Please precise the <strong> precise type</strong> of ".$_POST['name'].". <br>";
		?>
	<input type="hidden" name="id_supplier" value= <? echo '"'.$id_supplier.'"'; ?>/>		
	<input type="hidden" name="id_location" value= <? echo '"'.$id_location.'"'; ?>/>
	<input type="hidden" name="id_type" value= <? echo '"'.$id_type.'"'; ?>/>
	<input type="hidden" name="id_precise_location" value= <? echo '"'.$id_precise_location.'"'; ?>/>
	<input type="hidden" name="request" value= "p_type"/>

	<input type="text" name="name_p_type" />
		<?
		}
		?>
	<input type="submit" value="Save" /><input type="reset" value="Reset form">
		</form>
