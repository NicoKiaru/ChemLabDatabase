<!-- start sidebar -->
<div id="sidebar">
	<ul>
		<li>
			<h2>Search</h2> 
			<ul>
				<form method="get" action="search_item.php" >
				<li><input type="text" name="keywords" id="s"  value="" /></li>
				<li><input type="hidden" name="labo" value=<? echo '"'.$LABO_USER.'"'; ?>/>
				<select name="id_location" id="id_location">
			    	<option value="ALL" SELECTED>All locations</option>
			        <? 	$sql = "SELECT id,name FROM location WHERE labo='".$LABO_USER."' ORDER BY name";
					$result = mysql_query($sql);
				while ($dat = mysql_fetch_array($result) )
				{  ?>
		        		<option value="<?php echo $dat['id']; ?>" ><?php echo htmlspecialchars_decode($dat['name']); ?></option>
		        	<?php } ?>
				</select></li>
				<li>
				<select name="id_type" id="id_type">
			    	<option value="ALL" >All types</option>
			        <? 	$sql = "SELECT id,name  FROM type WHERE labo='".$LABO_USER."' ORDER BY name";
					$result = mysql_query($sql);
					while ($dat = mysql_fetch_array($result) )
				{  ?>
					<option value="<?php echo $dat['id']; ?>" <? if ($dat['id']==$dat_edit['id_type']) {echo "SELECTED";}?>><?php echo $dat['name']; ?></option>
		        	<?php } ?>
				</select></li>
				<li><input type="submit" value="Search" /></li>
				</form>
			</ul>
				 
		</li>
		<li>
				<h2>Add product...</h2>
				<ul>
					<li><a href="new_item.php">New Product/Template</a></li>
					Templates :
					<?$sql = "SELECT id,name  FROM product WHERE ((labo='".$LABO_USER."') AND (is_template=1)) ORDER BY name";
					$result = mysql_query($sql);
					while ($dat = mysql_fetch_array($result) )
					{  ?>
					<li><a href="edit_item.php?id=<?echo $dat[0];?>"> New <?echo $dat[1];?></a></li>
					<? } ?>
				</ul>
			</li>
			<li id="categories">
				<h2>Browse lab</h2>
				<ul>
	<!--- Insert/remove new labs here --->
	<li><a href="search_item.php?keywords=&labo=<? echo $LabName1; ?>&id_type=ALL&id_location=ALL"><? echo $LabName1; ?></a> </li>
	<li><a href="search_item.php?keywords=&labo=<? echo $LabName2; ?>&id_type=ALL&id_location=ALL"><? echo $LabName2; ?></a> </li>
	
				</ul>
			</li>

		</ul>
	</div>
	<!-- end sidebar -->
