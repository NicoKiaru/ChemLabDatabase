	<?php
	
	// Connexion et sélection de la base
	$link = $link = mysql_connect($DB_SERVERNAME, $DB_USERNAME, $DB_PASSWORD);
	mysql_select_db($DB_NAME) or die("Could not select database");

	?>
<?
if ( !function_exists('htmlspecialchars_decode') ) // For PhP version <5
{
    function htmlspecialchars_decode($text)
    {
        return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
    }
}
?>
