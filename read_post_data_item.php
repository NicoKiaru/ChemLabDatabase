<?$name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
		$usual_name = mysql_real_escape_string(htmlspecialchars($_POST['usual_name']));
		$extra_name = mysql_real_escape_string(htmlspecialchars($_POST['extra_name']));
		$MSDS_External = mysql_real_escape_string(htmlspecialchars($_POST['MSDS_External']));
		if (isset($_POST['id_supplier'])) {		
		$id_supplier = mysql_real_escape_string(htmlspecialchars($_POST['id_supplier']));}
		$ref = mysql_real_escape_string(htmlspecialchars($_POST['ref']));
		if (isset($_POST['id_location'])) {
		$id_location = mysql_real_escape_string(htmlspecialchars($_POST['id_location']));}
		if (isset($_POST['id_precise_location'])) {
		$id_precise_location = mysql_real_escape_string(htmlspecialchars($_POST['id_precise_location']));}
		$location_infos = mysql_real_escape_string(htmlspecialchars($_POST['location_infos']));
		if (isset($_POST['id_type'])) {
		$id_type = mysql_real_escape_string(htmlspecialchars($_POST['id_type']));}
		if (isset($_POST['id_precise_type'])) {
		$id_precise_type = mysql_real_escape_string(htmlspecialchars($_POST['id_precise_type']));}
		$form = mysql_real_escape_string(htmlspecialchars($_POST['form']));
		$storage = mysql_real_escape_string(htmlspecialchars($_POST['storage']));
		$quantity = mysql_real_escape_string(htmlspecialchars($_POST['quantity']));
                $has_aliquots = $_POST['has_aliquots']=="1";
		if ($has_aliquots==0) {$nb_aliquots=-1; } else {
                $nb_aliquots = mysql_real_escape_string(htmlspecialchars($_POST['nb_aliquots']));}
		$month_of_receipt = mysql_real_escape_string(htmlspecialchars($_POST['month_of_receipt']));
		$year_of_receipt = mysql_real_escape_string(htmlspecialchars($_POST['year_of_receipt']));
		$month_of_opening = mysql_real_escape_string(htmlspecialchars($_POST['month_of_opening']));
		$year_of_opening = mysql_real_escape_string(htmlspecialchars($_POST['year_of_opening']));
		$month_of_expire = mysql_real_escape_string(htmlspecialchars($_POST['month_of_expire']));
		$year_of_expire = mysql_real_escape_string(htmlspecialchars($_POST['year_of_expire']));
		$comments = mysql_real_escape_string(htmlspecialchars($_POST['comments']));
		$Information_External = mysql_real_escape_string(htmlspecialchars($_POST['Information_External']));
		# Change uploaded file's name
		if (isset($_POST['nom_tmp_IS'])) {
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
		} 
		?>
