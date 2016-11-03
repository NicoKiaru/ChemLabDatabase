<?

error_reporting(E_ALL);
if (isset($_POST['Save_as_template'])) {
	include("submit_template.php");
} else {
	include("submit_item.php");
}
  
?>
