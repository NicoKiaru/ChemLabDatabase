<?
if (isset($_POST['Save_as_new'])) {
	include("submit_item.php");
} elseif (isset($_POST['Save_as_new_template']))  {
	include("submit_template.php");
} else {
	include("modify_item.php");
}
  
?>
