<? include("begin.php"); ?>

        <h1>Results...</h1>
 
	<?php
	{

	     if (isset($_GET['id'])) {

	$id_product = $_GET['id'];
	
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
        <h1></h1>
 	<? 
	   $sql = "
		UPDATE `product` SET
			`nb_aliquots` = `nb_aliquots`-1
		WHERE  `product`.`id` =".mysql_real_escape_string(htmlspecialchars($id_product))." LIMIT 1 ;
		";
	   $result = mysql_query($sql);
	?>
	<p>You removed one aliquot of the product.</p>
	
	<? } else {?>
	<p> You are not allowed to remove an aliquot to a product that does not belong to your lab.</p>
	<?} }



	$kw = $_GET['keywords'];
	
	$kw=mysql_real_escape_string(htmlspecialchars($kw));
	echo 'Results for "'.$kw.'"<br>';	
	$sql= "
		SELECT `product`.`id`, `product`.`name`, `location`.`name`, `type`.`name`,`product`.`has_aliquots`,`product`.`nb_aliquots`,`supplier`.`name`, `is_template`
			FROM `product`
			LEFT JOIN `location` ON `product`.`id_location`=`location`.`id`
			LEFT JOIN `precise_location` ON `product`.`id_precise_location`=`precise_location`.`id`
			LEFT JOIN `type` ON `product`.`id_type`=`type`.`id`
			LEFT JOIN `supplier` ON `product`.`id_supplier`=`supplier`.`id`
			LEFT JOIN `precise_type` ON `product`.`id_precise_type`=`precise_type`.`id`
			WHERE ((
			`product`.`name` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `product`.`usual_name` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `product`.`extra_name` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `product`.`ref` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `product`.`form` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `product`.`storage` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `product`.`quantity` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `product`.`date_of_receipt` LIKE '%".$kw."%'
			OR `product`.`comments` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `type`.`name` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `location`.`name` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `precise_location`.`name` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `precise_type`.`name` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci
			OR `supplier`.`name` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )
			COLLATE latin1_swedish_ci)
			";

		$labo = $_GET['labo'];
		if ($labo!="ALL") {
		$sql = $sql."
			AND `product`.`labo` = CONVERT( _utf8 '".$labo."'
			USING latin1 )
			COLLATE latin1_swedish_ci ";
		}
		if (isset($_GET['id_location'])) {
		$id_location=$_GET['id_location'];
		if ($id_location!="ALL") {
		$sql = $sql."
			AND `product`.`id_location` = CONVERT( _utf8 '".$id_location."'
			USING latin1 )
			COLLATE latin1_swedish_ci ";
		}}
		if (isset($_GET['id_type'])) {
		$id_type=$_GET['id_type'];
		if ($id_type!="ALL") {
		$sql = $sql."
			AND `product`.`id_type` = CONVERT( _utf8 '".$id_type."'
			USING latin1 )
			COLLATE latin1_swedish_ci ";
		}}
		$sql=$sql.")";
		if (isset($_GET['ob'])) {
		$sql = $sql." ORDER BY ".$_GET['ob'];
		}
		$result = mysql_query($sql);
		?>
		<div class="post">
			<div class="title">
				<h2><a href="#">Chemicals</a></h2>
				<p> Click on the aliquot number to remove one aliquot.</p>
			</div>
			<div class="entry"><h4>
		<TABLE border="5" frame="hsides" rules="all"  >
		<THEAD bgcolor="#FFF29D" >  
	        <TR>  
			<TH scope="col" id="Name" ><a href ="search_item.php?keywords=<?echo $kw;?>&ob=product.name&labo=<?echo $labo;?>&id_location=<?echo $id_location;?>&id_type=<?echo $id_type;?>" ><h3>Name</h3></a></TH> 
			<TH scope="col" id="Supplier"><a href ="search_item.php?keywords=<?echo $kw;?>&ob=supplier.name&labo=<?echo $labo;?>&id_location=<?echo $id_location;?>&id_type=<?echo $id_type;?>" ><h3>Supplier</h3></a></TH>  
			<TH scope="col" id="Location"><a href ="search_item.php?keywords=<?echo $kw;?>&ob=location.name&labo=<?echo $labo;?>&id_location=<?echo $id_location;?>&id_type=<?echo $id_type;?>" ><h3>Location</h3></a></TH> 
			<TH scope="col" id="Type"><a href ="search_item.php?keywords=<?echo $kw;?>&ob=type.name&labo=<?echo $labo;?>&id_location=<?echo $id_location;?>&id_type=<?echo $id_type;?>" ><h3>Type</h3></a></TH>
			<TH scope="col" id="Aliquots" colspan="2"><a href ="search_item.php?keywords=<?echo $kw;?>&ob=product.nb_aliquots&labo=<?echo $labo;?>&id_location=<?echo $id_location;?>&id_type=<?echo $id_type;?>" ><h3>Aliquots</h3></a></TH>  
             	</TR>  
	        </THEAD> 
		<TBODY >
		<? $rep_product=false;$index=0;
		while ($dat = mysql_fetch_array($result) )	{ $rep_product=true;$index=$index+1; ?>
		<TR <? if (($dat[7])==1) {echo 'style="background-color:#FFAAAA"';} else {if ($index % 2 ==0) {echo 'style="background-color:#D8D8D8"';}} ?>><TD><a href="show_item.php?id=<? echo $dat['id'] ?>"><? if (($dat[7])==1) {echo '[Template]';}echo safe_write_html($dat[1]); ?> </a></TD>
		    <TD><? echo safe_write_html($dat[6]); ?></TD>
		    <TD><? echo safe_write_html($dat[2]); ?></TD>
	  
		    <TD><? echo $dat[3]; ?></TD>
		    <? if ($dat[4]==1) { ?> <TD <?     
				if (($dat[5])==0) { echo 'style="text-align:center;color:white;background-color:red"'; }
				if (($dat[5])==1) { echo 'style="text-align:center;background-color:orange"'; }                 
				if (($dat[5])==2) { echo 'style="text-align:center;background-color:orange"'; } 
				if (($dat[5])>2)  { echo 'style="text-align:center;color:white;background-color:green"'; } ?> > 
				
				<? 
				if (($dat[5])>0) { ?><? echo $dat[5];?></TD> <TD>
					<form method="post" action="search_item.php?keywords=<?echo $kw;?><? if ($_GET['ob']!='') { ?>&ob=<? echo $_GET['ob']; }?>&labo=<?echo $labo;?>&id=<? echo $dat[0] ?>&id_location=<?echo $id_location;?>&id_type=<?echo $id_type;?>" >
					
					<input type="submit" value="-1" /></form></TD>
					<?  } else { echo $dat[5]; }?>
				
					
		    </TD> <? } ?>
		</TR>
		<? } ?> 
		</TBODY>
		</TABLE></h4></div>	<p class="links">  </p></div>
		
	<?}?>
	
	<?php
	{
	$kw = $_GET['keywords'];
	$sql= "
	 SELECT *
		FROM `supplier`
		WHERE `name` LIKE CONVERT( _utf8 '%".$kw."%'
		USING latin1 )";
		$labo = $_GET['labo'];
		if ($labo!="ALL") {
		$sql = $sql."
			AND `labo` = CONVERT( _utf8 '".$labo."'
			USING latin1 )
			COLLATE latin1_swedish_ci ";}
		$sql=$sql."
		ORDER BY `name`
		COLLATE latin1_swedish_ci
	
		";
		$result = mysql_query($sql);
		$rep_supplier=false;	?>
		<div class="post">
			<div class="title">
				<h2><a href="#">Suppliers</a></h2>
			</div>
			<div class="entry"><h4>
		<?
		while ($dat = mysql_fetch_array($result) ) {$rep_supplier=true; ?>
		<li><a href="show_supplier.php?id=<? echo $dat['id'] ?>"><? echo safe_write_html($dat['name']); ?> </a>
		 	
		<? } ?> </h4></div>	<p class="links">  </p></div>

	<?}?>
	<div class="post">
	<div class="title">
		<h2><a href="#">Locations</a></h2>
	</div>
	<div class="entry">
	<?php
	{
		$kw = $_GET['keywords'];
		$sql= "
		 SELECT *
			FROM `location`
			WHERE `name` LIKE CONVERT( _utf8 '%".$kw."%'
			USING latin1 )";
		$labo = $_GET['labo'];
		if ($labo!="ALL") {
		$sql = $sql."
			AND `labo` = CONVERT( _utf8 '".$labo."'
			USING latin1 )
			COLLATE latin1_swedish_ci ";}
		$sql=$sql."
			ORDER BY `name`
			COLLATE latin1_swedish_ci
			";
		$result = mysql_query($sql);
		$rep_location=false;
		while ($dat = mysql_fetch_array($result) )
		{$rep_location=true; ?>
		<h4><a href="show_location.php?id=<? echo $dat['id'] ?>"><? echo safe_write_html($dat['name']); ?></a></h4>
		
		<?
			$sql= "
			 SELECT *
				FROM `precise_location`
				WHERE id_location=".$dat['id']."
				ORDER BY `name`
				";
			$result_p = mysql_query($sql);
			while ($dat_p = mysql_fetch_array($result_p) )
			{?>
			<? echo safe_write_html($dat_p['name']).";"; ?></a>
			<?}?>
		 
		 <?
		 }
	}
	?></div>	<p class="links">  </p></div>
		<div class="post">
	<div class="title">
		<h2><a href="#">Types</a></h2>
	</div>
	<div class="entry">
	<?php
	{
	$kw = $_GET['keywords'];
	$sql= "
	 SELECT *
		FROM `type`
		WHERE `name` LIKE CONVERT( _utf8 '%".$kw."%'
		USING latin1 )";
		$labo = $_GET['labo'];
		if ($labo!="ALL") {
		$sql = $sql."
			AND `labo` = CONVERT( _utf8 '".$labo."'
			USING latin1 )
			COLLATE latin1_swedish_ci ";}
		$sql=$sql."
		ORDER BY `name`
		COLLATE latin1_swedish_ci
	
		";
		$result = mysql_query($sql);
		$rep_type=false;
		while ($dat = mysql_fetch_array($result) )
		{$rep_type=true; ?>
		<h4><a href="show_type.php?id=<? echo $dat['id'] ?>"><? echo safe_write_html($dat['name']); ?></a><br></h4>
		<?
			$sql= "
	 SELECT *
		FROM `precise_type`
		WHERE id_type=".$dat['id']."
		ORDER BY `name`
		";
		$result_p = mysql_query($sql);
		while ($dat_p = mysql_fetch_array($result_p) )
		{?><? echo safe_write_html($dat_p['name']).";"; ?></a>
		<?}?>
		<?}?></div>	<p class="links">  </p></div>
	<?

	if (($rep_product==false)&&($rep_supplier==false)&&($rep_location==false)&&($rep_type==false)) {
	echo 'Your search returned no results.';
	}
		
	}
	?>
	
	<hr class="clear-contentunit" />

<? include("end.php"); ?>
