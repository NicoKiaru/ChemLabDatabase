<?
	if ($_POST['request']=="supplier") {
		if ($_POST['name_supplier']=="") {die("Please precise the supplier...");}
			$sql = "
			INSERT INTO `supplier` (
				`id` ,
				`name` ,
				`contact`,
				`link`,
				`labo`
				)
				VALUES (
				NULL , '".mysql_real_escape_string(htmlspecialchars($_POST['name_supplier']))."', '".mysql_real_escape_string(htmlspecialchars($_POST['contact_supplier']))."', '".mysql_real_escape_string(htmlspecialchars($_POST['link_supplier']))."',	'".$LABO_USER."'
				);
			";
			mysql_query($sql);
			$id_supplier=mysql_insert_id();
			} 
	elseif ($_POST['request']=="location") {
			if ($_POST['name_location']=="") {die("Please precise the location...");}
			$sql = "
			INSERT INTO `location` (
				`id` ,
				`name`,
				`labo`
				)
				VALUES (
				NULL , '".mysql_real_escape_string(htmlspecialchars($_POST['name_location']))."',	'".$LABO_USER."'
				);
			";
			mysql_query($sql);
			$id_location=mysql_insert_id();
			} 
	elseif ($_POST['request']=="p_location") {
			if ($_POST['name_p_location']=="") {die("Please type a name...");}
			$sql = "
			INSERT INTO `precise_location` (
				`id` ,
				`id_location` ,
				`name`,
				`labo`
				)
				VALUES (
				NULL , '".$id_location."', '".mysql_real_escape_string(htmlspecialchars($_POST['name_p_location']))."',	'".$LABO_USER."'
				);
			";
			mysql_query($sql);
			$id_precise_location=mysql_insert_id();
			} 
	elseif ($_POST['request']=="type") {
			if ($_POST['name_type']=="") {die("Please precise the type of the product...");}
			$sql = "
			INSERT INTO `type` (
				`id` ,
				`name`,
				`labo`
				)
				VALUES (
				NULL , '".mysql_real_escape_string(htmlspecialchars($_POST['name_type']))."',	'".$LABO_USER."'
				);
			";
			mysql_query($sql);
			$id_type=mysql_insert_id();
			} 
	elseif ($_POST['request']=="p_type") {
			if ($_POST['name_p_type']=="") {die("Please type a name...");}
			$sql = "
			INSERT INTO `precise_type` (
				`id` ,
				`id_type` ,
				`name`,
				`labo`
				)
				VALUES (
				NULL , '".$id_type."', '".mysql_real_escape_string(htmlspecialchars($_POST['name_p_type']))."',	'".$LABO_USER."'
				);
			";
			mysql_query($sql);
			$id_precise_type=mysql_insert_id();
		}
		
		
