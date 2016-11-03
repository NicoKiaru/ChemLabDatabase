<? if (isset($_POST['nom_tmp_IS'])) {
		$nom_tmp_IS = $_POST['nom_tmp_IS'];}		
		if (isset($_POST['nom_tmp_MSDS'])) {
		$nom_tmp_MSDS = $_POST['nom_tmp_MSDS'];}
	
		if (isset($_FILES['Infos_Internal']['name']))
		if ($_FILES['Infos_Internal']['name']!="") {
			$nom_tmp_IS = "{$_FILES['Infos_Internal']['tmp_name']}";

		}
		if (isset($_FILES['MSDS_Internal']['name']))
		if ($_FILES['MSDS_Internal']['name']!="") {

			$nom_tmp_MSDS = "{$_FILES['MSDS_Internal']['tmp_name']}";
		}	?>
