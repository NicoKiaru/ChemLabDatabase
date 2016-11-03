	<script type="text/javascript">
	function Choix_location(f) {
		var l1    = f.elements["id_location"]; 
		var l2    = f.elements["id_type"]; 
		var index = l1.options[l1.selectedIndex].value; 
		l2.options.length = 0; 
		l2.options[l2.options.length] = new Option("---");
		switch(index)
		{
	        <? 	$sql = "SELECT id,id_location,name FROM precise_location ORDER BY id_location,name";
			$result = mysql_query($sql);
			$id_loc_act = 0;
			$begin=false;
			while ($dat = mysql_fetch_array($result) )
			{ 
			if ($id_loc_act!=$dat['id_location']) {
				if ($begin==false) {$begin=true;} else {echo "break;\n";}
				$id_loc_act=$dat['id_location'];				
				echo 'case "'.$id_loc_act.'"'.":\n";
				
			}
		echo 'l2.options[l2.options.length] = new Option("'.$dat['name'].'");'."\n";
		echo 'l2.options[l2.options.length-1].value = '.$dat['id'].";\n";			
			
			}
		?>
		default:;
		}
		if ((index>0)||(index="add")) {l2.options[l2.options.length] = new Option("add a precise location");
				l2.options[l2.options.length-1].value="add";}
	}	
	function Choix_type(f) {
		var l1    = f.elements["id_type"]; 
		var l2    = f.elements["id_precise_type"]; 
		var index = l1.options[l1.selectedIndex].value;
		l2.options.length = 0; 
		l2.options[l2.options.length] = new Option("---");
		switch(index)
		{
	        <? 	$sql = "SELECT id,id_type,name FROM precise_type ORDER BY id_type,name";
			$result = mysql_query($sql);
			$id_type_act = 0;
			$begin=false;
			while ($dat = mysql_fetch_array($result) )
			{ 
			if ($id_type_act!=$dat['id_type']) {
				if ($begin==false) {$begin=true;} else {echo "break;\n";}
				$id_type_act=$dat['id_type'];				
				echo 'case "'.$id_type_act.'"'.":\n";
				
			}
		echo 'l2.options[l2.options.length] = new Option("'.$dat['name'].'");'."\n";
		echo 'l2.options[l2.options.length-1].value = '.$dat['id'].";\n";			
			
			}
		?>
		default:;
		}
		if ((index>0)||(index="add")) {l2.options[l2.options.length] = new Option("add a precise type");
				l2.options[l2.options.length-1].value="add";}
	}
	</script>
