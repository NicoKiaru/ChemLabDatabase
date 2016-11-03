<?php
/**
 * ChemLabDatabase installation assistance
 *
 * @author      Nicolas Chiaruttini <nicolas.chiaruttini@gmail.com>
 */
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Title      : Level 2.0
Version    : 1.0
Released   : 20070821
Description: A Web 2.0 design with fluid width suitable for blogs and small websites.

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<? include ("head.php"); 

// kill magic quotes
if (get_magic_quotes_gpc() && !defined('MAGIC_QUOTES_STRIPPED')) {
    if (!empty($_GET))    remove_magic_quotes($_GET);
    if (!empty($_POST))   remove_magic_quotes($_POST);
    if (!empty($_COOKIE)) remove_magic_quotes($_COOKIE);
    if (!empty($_REQUEST)) remove_magic_quotes($_REQUEST);
    @ini_set('magic_quotes_gpc', 0);
    define('MAGIC_QUOTES_STRIPPED',1);
}
@set_magic_quotes_runtime(0);
@ini_set('magic_quotes_sybase',0);

?>

<body>
<? include ("header.php"); ?>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">

<?php 
// Avoiding reinstallation

if (file_exists('localsettings.php')==true) {die ('localsettings.php already created, please remove this file before running this installation script');}


?>

	
	<h1> Installing ChemLabDatabase ...</h1><br><br>


	<?php

echo "Testing MySql connection........";
$link = $link = mysql_connect($_POST['db_servername'], $_POST['db_username'], $_POST['db_password']) or die("Could not connect MySql.");
echo "OK! <br>";

echo 'Create localsettings.php...........';
    	$output = <<<EOT
<?php
/**
 * ChemLabDatabase's Main Configuration File - Local Settings
 * Auto-generated by install script
 */

EOT;
	    $output .= "\$MSDS_PATH = 'msds/';\n";
	    $output .= "\$IS_PATH = 'Information_Sheets/';\n \n";
	    $output .= '$DB_SERVERNAME = \''.addslashes($_POST['db_servername'])."';\n";
	    $output .= '$DB_NAME = \''.addslashes($_POST['db_name'])."';\n";
	    $output .= '$DB_USERNAME = \''.addslashes($_POST['db_username'])."';\n";
	    $output .= '$DB_PASSWORD = \''.addslashes($_POST['db_password'])."';\n \n";
	    $output .= '$CONTACT_EMAIL = \''.addslashes($_POST['email'])."';\n";
	    $output .= '$InstitutionName = \''.addslashes($_POST['uni_name'])."';\n";
	    $output .= '$LabName1 = \''.addslashes($_POST['lab_name'])."';\n \n";
	    $output .= "// for simple authentification \n";
	    $output .= '$authorized_IPs = array(\''.addslashes($_POST['auth_ip'])."');\n \n";
$output .= <<<EOT
?>
EOT;
		$myFile = "localsettings.php";
		$fh = fopen($myFile, 'w') or die("Can't open file... Check the administration rights and suppress the file if you want to replace it.");
		fwrite($fh, $output);
		fclose($fh);
		error_reporting(E_ALL);
echo "OK! <br>";
//==============================================================================================
echo "Creating database..................";

$DB_NAME=$_POST['db_name'];

$sql="CREATE DATABASE IF NOT EXISTS `".$DB_NAME."` ;";
$result = mysql_query($sql) or die ("Cannot create database");
mysql_select_db($DB_NAME) or die("Could not select database");
echo "OK! <br>";
echo "Building database structure............";

// Create location struct

$sql="CREATE TABLE IF NOT EXISTS `location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `labo` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;";
$result = mysql_query($sql) or die ("Cannot create location table");

// Create table precise location

$sql="CREATE TABLE IF NOT EXISTS `precise_location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_location` bigint(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `labo` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;";
$result = mysql_query($sql) or die ("Cannot create precise location table");

// Create table precise type
$sql="CREATE TABLE IF NOT EXISTS `precise_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_type` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `labo` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;";
$result = mysql_query($sql) or die ("Cannot create precise type table");

// create table product
$sql="CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `usual_name` varchar(100) NOT NULL,
  `extra_name` varchar(100) NOT NULL,
  `MSDS_Internal` tinyint(1) NOT NULL,
  `MSDS_External` tinytext NOT NULL,
  `id_supplier` bigint(20) NOT NULL,
  `ref` tinytext NOT NULL,
  `id_location` bigint(20) NOT NULL,
  `id_precise_location` bigint(20) NOT NULL,
  `id_type` bigint(20) NOT NULL,
  `id_precise_type` bigint(20) NOT NULL,
  `form` tinytext NOT NULL,
  `storage` text NOT NULL,
  `quantity` text NOT NULL,
  `date_of_receipt` date NOT NULL,
  `date_of_opening` date NOT NULL,
  `date_of_expire` date NOT NULL,
  `comments` text NOT NULL,
  `Infos_Internal` tinyint(1) NOT NULL,
  `Infos_External` tinytext NOT NULL,
  `date_of_entry` datetime NOT NULL,
  `ip` tinytext NOT NULL,
  `labo` tinytext NOT NULL,
  `has_aliquots` tinyint(1) NOT NULL,
  `nb_aliquots` int(11) NOT NULL,
  `location_infos` text NOT NULL,
  `is_template` tinyint(1) NOT NULL,
  `history` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;";
$result = mysql_query($sql) or die ("Cannot create precise product table");

// create supplier table

$sql="CREATE TABLE IF NOT EXISTS `supplier` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `contact` varchar(80) NOT NULL,
  `link` tinytext NOT NULL,
  `labo` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;";
$result = mysql_query($sql) or die ("Cannot create precise supplier table");

// create table type

$sql="CREATE TABLE IF NOT EXISTS `type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `labo` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;";
$result = mysql_query($sql) or die ("Cannot create precise type table");
echo "OK! <br>";

if (isset($_POST['sample_db']))
{
echo "Adding sample data..................";

$sql="INSERT INTO `location` (`id`, `name`, `labo`) VALUES
(3, 'Cupboard', '".$_POST['lab_name']."'),
(4, 'Chemicals cupboard', '".$_POST['lab_name']."'),
(5, 'Fridge', '".$_POST['lab_name']."'),
(7, '-20Â°C', '".$_POST['lab_name']."'),
(2, '-80Â°C', '".$_POST['lab_name']."'),
(12, 'Dangerous products', '".$_POST['lab_name']."'),
(13, 'Vale desk', '".$_POST['lab_name']."'),
(14, 'Cell culture room', '".$_POST['lab_name']."'),
(21, 'Cold room', '".$_POST['lab_name']."');";
$result = mysql_query($sql);


$sql="INSERT INTO `precise_location` (`id`, `id_location`, `name`, `labo`) VALUES
(1, 2, 'Slot 6', '".$_POST['lab_name']."'),
(2, 5, 'Top slot', '".$_POST['lab_name']."'),
(4, 7, 'commun slot', '".$_POST['lab_name']."'),
(7, 9, 'boite 1', 'Marcos'),
(6, 2, 'Slot 7', '".$_POST['lab_name']."'),
(8, 5, 'Top shelf ', '".$_POST['lab_name']."'),
(9, 2, 'Slot 4 - Nicolas', '".$_POST['lab_name']."'),
(10, 7, 'Slot below commun', '".$_POST['lab_name']."'),
(11, 2, 'Slot5-Box4', '".$_POST['lab_name']."'),
(12, 2, 'Slot 6 - Box 4', '".$_POST['lab_name']."'),
(13, 2, 'Slot 6 - Box 1', '".$_POST['lab_name']."'),
(14, 2, 'Slot 6 - Box 2', '".$_POST['lab_name']."'),
(15, 2, 'Slot 6 - Box 3', '".$_POST['lab_name']."'),
(16, 14, 'Fridge', '".$_POST['lab_name']."'),
(17, 16, 'efoiuh', '".$_POST['lab_name']."'),
(18, 20, 'ouh', 'Bob'),
(19, 7, 'Nico slot', '".$_POST['lab_name']."'),
(20, 21, 'Liquid Nitrogen Tank', '".$_POST['lab_name']."');";
$result = mysql_query($sql);

$sql="INSERT INTO `precise_type` (`id`, `id_type`, `name`, `labo`) VALUES
(1, 1, 'Uncharged lipids', '".$_POST['lab_name']."'),
(2, 3, 'Human cells', '".$_POST['lab_name']."'),
(5, 8, 'Escrt', '".$_POST['lab_name']."'),
(4, 1, 'Labelled Lipids', '".$_POST['lab_name']."'),
(6, 1, 'Special Lipids', '".$_POST['lab_name']."'),
(7, 1, 'Charged Lipids', '".$_POST['lab_name']."');";
$result = mysql_query($sql);

$sql="
INSERT INTO `product` (`id`, `name`, `usual_name`, `extra_name`, `MSDS_Internal`, `MSDS_External`, `id_supplier`, `ref`, `id_location`, `id_precise_location`, `id_type`, `id_precise_type`, `form`, `storage`, `quantity`, `date_of_receipt`, `date_of_opening`, `date_of_expire`, `comments`, `Infos_Internal`, `Infos_External`, `date_of_entry`, `ip`, `labo`, `has_aliquots`, `nb_aliquots`, `location_infos`, `is_template`, `history`) VALUES
(110, '(Plasmid)', '(Insert name)', '(Alternative insert name)', 0, '', 0, '', 0, 0, 4, 0, '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 'General informations\\r\\n{|-Provider\\r\\n| (Addgene / Name of the lab)\\r\\n|- Made by\\r\\n| (Plasmid designer)\\r\\n|- Received by\\r\\n| (XXX on Date)\\r\\n|- Form\\r\\n| (Bacterial stab (precise strain) / Purified plasmid)\\r\\n|}\\r\\n\\r\\nVector informations\\r\\n{|- Type of vector\\r\\n| (Bacterial/Mammalian/Insect expression)\\r\\n|\\r\\n|-Backbone\\r\\n| (Backbone name)\\r\\n|\\r\\n|-Size (bp)\\r\\n| (Size in base pair)\\r\\n|\\r\\n|- Fusion protein / Tag 1\\r\\n| (Name of the first tag)\\r\\n| (Location of the tag: N or C term)\\r\\n|- Fusion protein / Tag 2\\r\\n| (Name of the second tag)\\r\\n| (Location of the tag: N or C term)\\r\\n|- Bacterial resistance\\r\\n| (Ampicillin/Kanamycin...)\\r\\n|\\r\\n|- Mammalian Selection\\r\\n| (Puromycin/...)\\r\\n|\\r\\n|- Special add\\r\\n|\\r\\n|\\r\\n|- Protease site\\r\\n| (TEV/... cleavage site)\\r\\n|\\r\\n|- Copy\\r\\n| (Low/High)\\r\\n|\\r\\n|}\\r\\n\\r\\nInsert\\r\\n{|-Name\\r\\n| (Name)\\r\\n|\\r\\n|-Size (bp)\\r\\n| (Insert size in base pair)\\r\\n|\\r\\n|- Restriction enzymes\\r\\n| (5=BamH1/EcoRI)\\r\\n| (3=BamH1/EcoR1)\\r\\n|- Mutations\\r\\n| (Precise mutations)\\r\\n|\\r\\n|- Deletions\\r\\n| (Precise Deletions)\\r\\n|\\r\\n|}\\r\\n\\r\\n(Relevant mutations / deletions)\\r\\n\\r\\nPlease provide here additional description of the product.\\r\\n--------------------------------\\r\\n\\r\\nDon t forget to precise the location of the plasmid!\\r\\n\\r\\nIf possible :\\r\\n* Upload a map of the plasmid in the &amp;quot;product information&amp;quot; field\\r\\n* For addgene, put a link towards any useful informations for the plasmid\\r\\n\\r\\nIt is possible as well possible to put the raw sequence of the plasmid here :\\r\\nInsert\\r\\n{|-Sequence\\r\\n| (ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ATGCGTAGGCTCGATAGAGCGATAGAG ...)\\r\\n|}', 0, '', '2011-08-05 22:48:59', '127.0.0.1', '".$_POST['lab_name']."', 0, -1, '', 1, ''),
(14, 'Rhodamine B isothiocyanate dextran', 'RITC dextran', '', 0, '', 2, 'R9379-100mg', 5, 2, 0, 0, 'pouder', '2-8Â°C', '100mg', '2011-03-00', '0000-00-00', '0000-00-00', 'average mol wt ~70,000; \\r\\nRed fluorescent dye to probe membrane permeability.', 0, '', '2011-04-04 16:44:40', 'nc@unige.ch', '".$_POST['lab_name']."', 0, -1, '', 0, ''),
(21, 'DOPE-PEG(2000) Biotin', '1,2-dioleoyl-sn-glycero-3-phosphoethanolamine-N-[methoxy(polyethylene glycol)-5000] (ammonium salt)', 'Biotin PEG DOPE', 0, '', 1, '880129C', 0, 4, 1, 0, '10mg/ml in chloroform', '', '', '2011-11-00', '0000-00-00', '0000-00-00', '', 0, 'http://www.avantilipids.com/index.php?option=com_content&amp;amp;view=article&amp;amp;id=1109&amp;amp;Itemid=153&amp;amp;catnumber=880129', '2011-08-05 22:53:50', '127.0.0.1', '".$_POST['lab_name']."', 0, -1, '', 0, ''),
(111, 'pIRESneo-EGFP-alpha Tubulin', 'EGFP-alpha Tubulin', 'EGFP-Tubulin', 0, '', 11, '12298', 7, 19, 4, 0, '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 'General informations\\r\\n{|-Provider\\r\\n| Addgene\\r\\n|- Made by\\r\\n| Rusan et al\\r\\n|- Received by\\r\\n| Nico on 08/2011\\r\\n|- Form\\r\\n| Purified plasmid (1mg/ml)\\r\\n|}\\r\\n\\r\\nVector informations\\r\\n{|- Type of vector\\r\\n| Mammalian expression\\r\\n|\\r\\n|-Backbone\\r\\n| Clontech / pIRESneo-EGFP\\r\\n|\\r\\n|-Size (bp)\\r\\n| ?\\r\\n|\\r\\n|- Fusion protein / Tag 1\\r\\n| EGFP\\r\\n| N term\\r\\n|- Bacterial resistance\\r\\n| Ampicillin\\r\\n|\\r\\n|- Mammalian Selection\\r\\n| No\\r\\n|\\r\\n|- Copy\\r\\n| High\\r\\n|\\r\\n|}\\r\\n\\r\\nInsert\\r\\n{|-Name\\r\\n| EGFP-alpha tubulin\\r\\n|\\r\\n|-Size (bp)\\r\\n| 2100\\r\\n|\\r\\n|- Restriction enzymes\\r\\n| 5 =BamH1\\r\\n| 3 =EcoR1\\r\\n|}\\r\\n\\r\\nEGFP-Tubulin came from pEGFP-alpha Tubulin from Clontech\\r\\n', 0, 'http://www.addgene.org/12298/', '2011-08-05 23:24:25', '127.0.0.1', '".$_POST['lab_name']."', 0, -1, 'Nico s box', 0, 'coucou'),
(26, 'DOPC', '1,2-dioleoyl-sn-glycero-3-phosphocholine', '', 0, '', 1, '850375C', 7, 4, 1, 1, '10mg/ml in chloroform', '', '1ml vial', '0000-00-00', '2010-11-00', '0000-00-00', '', 0, 'http://www.avantilipids.com/index.php?option=com_content&amp;amp;view=article&amp;amp;id=231&amp;amp;Itemid=207&amp;amp;catnumber=850375', '2011-04-05 11:40:51', 'nc@unige.ch', '".$_POST['lab_name']."', 0, -1, '', 0, ''),
(44, 'DSPE-PEG(2000) Biotin', '1,2-distearoyl-sn-glycero-3-phosphoethanolamine-N-[biotinyl(polyethylene glycol)-2000] (ammonium sal', '', 0, '', 1, '880129C', 2, 0, 1, 0, 'in chloroform', '', '10 mg per aliquot at 10mg/ml', '0000-00-00', '0000-00-00', '0000-00-00', '', 0, 'http://avantilipids.com/index.php?option=com_content&amp;amp;view=article&amp;amp;id=1109&amp;amp;Itemid=153&amp;amp;catnumber=880129', '2011-04-11 16:52:55', 'nc@unige.ch', '".$_POST['lab_name']."', 1, 2, '', 0, ''),
(46, 'Rhodamine PE', '1,2-dioleoyl-sn-glycero-3-phosphoethanolamine-N-(lissamine rhodamine B sulfonyl) (ammonium salt)', '18:1 Liss Rhod PE', 0, '', 1, '810150C', 2, 0, 1, 0, 'in chloroform', '', '1 mg per aliquot at 1mg/ml ', '0000-00-00', '0000-00-00', '0000-00-00', '', 0, 'http://www.avantilipids.com/index.php?option=com_content&amp;amp;view=article&amp;amp;id=1017&amp;amp;Itemid=216&amp;amp;catnumber=810150', '2011-04-04 16:27:45', 'nc@unige.ch', '".$_POST['lab_name']."', 1, 5, '', 0, ''),
(56, 'Magnetic Beads 2.02microns', 'Sphero Streptavidin Ferro-Magnetic Particles, 2.02 microns diameter 5mL', '', 0, '', 6, 'SVFM-20-5', 5, 8, 7, 0, '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 'DO NOT FREEZE', 0, '', '2011-04-06 15:11:16', 'sm@unige.ch', '".$_POST['lab_name']."', 0, -1, '', 0, ''),
(58, 'Streptavidin Beads 3.05microns', 'Sphero Streptavidin Polystyrene Particles 3.05microns 5mL', '', 0, '', 6, 'SVP-30-5', 5, 8, 7, 0, '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '', 0, '', '2011-04-06 15:37:51', 'sm@unige.ch', '".$_POST['lab_name']."', 0, -1, '', 0, ''),
(60, 'Snf7 - Alexa 488', '', '', 0, '', 0, '', 0, 9, 8, 5, '0.23 mg/ml total protein concentration in 10% Glycerol, Hepes 20mM pH8', '', '10 microliters per aliquot', '2011-04-00', '0000-00-00', '0000-00-00', 'Purification by Frederic. On this aliquots both mbp and Snf7 are present in solution and are stained with alexa 488.\\r\\n\\r\\nPosm=1370mOsm (measured in distilled water diluted 10 times)\\r\\n\\r\\nM(Snf7)=25kDa estimated concentration = 4ÂµM', 0, '', '2011-08-05 22:55:58', '127.0.0.1', '".$_POST['lab_name']."', 1, 29, 'Plastic bag / 6.4.11', 0, ''),
(61, 'Î²-Casein from bovine milk - BioUltra, â‰¥98% (PAGE) (Sigma)', 'Casein', '', 0, '', 2, 'C6905', 7, 4, 8, 0, 'pouder', '-20C with parafilm', '250mg', '0000-00-00', '0000-00-00', '0000-00-00', '', 0, 'http://www.sigmaaldrich.com/catalog/Lookup.do?N5=All&amp;amp;N3=mode+matchpartialmax&amp;amp;N4=c6905&amp;amp;D7=0&amp;amp;D10=c6905&amp;amp;N1=S_ID&amp;amp;ST=RS&amp;amp;N25=0&amp;amp;F=PR', '2011-04-15 09:40:34', 'nc@unige.ch', '".$_POST['lab_name']."', 0, -1, '', 0, ''),
(70, 'FuGENE 6 Tranfection reagent', '', '', 0, '', 8, '11815091001', 14, 16, 0, 0, 'liquid', '4 Â°C', '2', '0000-00-00', '0000-00-00', '0000-00-00', '', 0, '', '2011-05-07 19:52:59', 'nc@unige.ch', '".$_POST['lab_name']."', 0, -1, '', 0, ''),
(71, 'Quantum dots 605 streptadivin conjugate', '', '', 0, '', 7, '', 5, 0, 9, 0, 'liquid', '2-6 Â°C', '1', '2011-03-00', '2011-03-00', '2011-08-00', '', 0, '', '2011-04-29 10:18:40', 'vg@unige.ch', '".$_POST['lab_name']."', 0, -1, '', 0, ''),
(77, 'Influx Pinocytic cell-loading reagent', '', '', 0, '', 7, 'I-14402', 13, 0, 0, 0, '', 'Room temperature', '1', '2011-03-00', '2011-03-00', '0000-00-00', '', 0, '', '2011-05-07 23:32:22', 'nc@unige.ch', '".$_POST['lab_name']."', 1, 0, '', 0, ''),
(109, 'TEst', 'iuhezf', 'oiyrg', 1, '', 13, '', 20, 18, 0, 0, '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 'oihefzapuh zepoiufhiu zefiopuhzfeoiu zfefioufhez ', 0, '', '2011-08-05 22:36:15', '127.0.0.1', 'Bob', 0, -1, '', 0, 'coucou'),
(115, '(Frozen cell box)', '', '', 0, '', 0, '', 21, 20, 3, 0, '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 'Name of the cells:\\r\\nDate:\\r\\n\\r\\n\\r\\n\\r\\n{|-\\r\\n|1\\r\\n|2\\r\\n|3\\r\\n|4\\r\\n|5\\r\\n|6\\r\\n|7\\r\\n|8\\r\\n|9\\r\\n|10\\r\\n|- A\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- B\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- C\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- D\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- E\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- F\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- G\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- H\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- I\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- J\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|}', 0, '', '2011-08-05 23:39:26', '127.0.0.1', '".$_POST['lab_name']."', 0, -1, 'See misc infos', 1, ''),
(112, 'pIRESneo-mRFP-alpha Tubulin', 'mRFP-alpha Tubulin', '', 0, '', 0, '', 7, 19, 4, 0, '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 'General informations\\r\\n{|-Provider\\r\\n| Addgene\\r\\n|- Made by\\r\\n| Rusan et al\\r\\n|- Received by\\r\\n| Nico on 08/2011\\r\\n|- Form\\r\\n| Purified plasmid (1mg/ml)\\r\\n|}\\r\\n\\r\\nVector informations\\r\\n{|- Type of vector\\r\\n| Mammalian expression\\r\\n|\\r\\n|-Backbone\\r\\n| pIRESneo-mRFP\\r\\n|\\r\\n|-Size (bp)\\r\\n| ?\\r\\n|\\r\\n|- Fusion protein / Tag 1\\r\\n| EGFP\\r\\n| N term\\r\\n|- Bacterial resistance\\r\\n| Ampicillin\\r\\n|\\r\\n|- Mammalian Selection\\r\\n| No\\r\\n|\\r\\n|- Copy\\r\\n| High\\r\\n|\\r\\n|}\\r\\n\\r\\nInsert\\r\\n{|-Name\\r\\n| mRFP-alpha tubulin\\r\\n|\\r\\n|-Size (bp)\\r\\n| 2100\\r\\n|\\r\\n|- Restriction enzymes\\r\\n| 5 =BamH1\\r\\n| 3 =EcoR1\\r\\n|}\\r\\n\\r\\n\\r\\n', 0, 'http://www.addgene.org/12298/', '2011-08-05 23:26:22', '127.0.0.1', '".$_POST['lab_name']."', 0, -1, 'Nico s box', 0, ''),
(116, 'Frozen hela cells', '', '', 0, '', 0, '', 21, 20, 3, 2, '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 'Location: Nico box\\r\\n\\r\\nA: Hela Tokyo Cell, GFP Tubulin stable puromycin Date: 07/2011\\r\\nB: Hela S3 Date: 03/2011\\r\\n\\r\\n{|-\\r\\n|1\\r\\n|2\\r\\n|3\\r\\n|4\\r\\n|5\\r\\n|6\\r\\n|7\\r\\n|8\\r\\n|9\\r\\n|10\\r\\n|- A Hela Tokyo Cells\\r\\n| X\\r\\n| X\\r\\n| X\\r\\n| X\\r\\n| X\\r\\n| X\\r\\n| X\\r\\n|\\r\\n|\\r\\n|\\r\\n|- B Hela S3\\r\\n| X\\r\\n| X\\r\\n| X\\r\\n| X\\r\\n| X\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- C\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- D\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- E\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- F\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- G\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- H\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- I\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|- J\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|\\r\\n|}', 0, '', '2011-08-05 23:39:45', '127.0.0.1', '".$_POST['lab_name']."', 0, -1, 'See misc infos', 0, '');";

$result = mysql_query($sql) or die(mysql_error());

$sql="INSERT INTO `supplier` (`id`, `name`, `contact`, `link`, `labo`) VALUES
(1, 'Avanti', '', 'http://www.avantilipids.com/', '".$_POST['lab_name']."'),
(2, 'Sigma-Aldrich', '', '', '".$_POST['lab_name']."'),
(6, 'Spherotec', '', '', '".$_POST['lab_name']."'),
(7, 'Invitrogen', '', 'http://www.invitrogen.com/site/us/en/home.html', '".$_POST['lab_name']."'),
(4, 'Acros organics', '', '', '".$_POST['lab_name']."'),
(5, 'Echelon Biosciences', '', '', '".$_POST['lab_name']."'),
(8, 'Roche', '', '', '".$_POST['lab_name']."'),
(11, 'Addgene', 'http://www.addgene.org', '', '".$_POST['lab_name']."'),
(12, 'Mysupplier', 'moncel', 'lrr', 'MyLab'),
(13, 'oiuh', 'ipu', 'h', 'Bob');";
$result = mysql_query($sql);

$sql="INSERT INTO `type` (`id`, `name`, `labo`) VALUES
(1, 'Lipids', '".$_POST['lab_name']."'),
(2, 'Salt', '".$_POST['lab_name']."'),
(3, 'Cell', '".$_POST['lab_name']."'),
(4, 'Plasmid', '".$_POST['lab_name']."'),
(7, 'Beads', '".$_POST['lab_name']."'),
(8, 'Protein', '".$_POST['lab_name']."'),
(9, 'Fluorescent probe', '".$_POST['lab_name']."');";
$result = mysql_query($sql);

echo "OK! <br>";
}

//========================================================================
?>		
	

	<br>

	<h2> Installation successfull!</h2>
	<p> Go to <a href="index.php"> HOME PAGE.</a> and try the database.</p>
	<p> Note that setting good authentification requires additional work. See readme.txt for more informations.





	</div>
	<!-- end content -->
	<br style="clear: both;" />
</div>
<!-- end page -->
<? include("footer.php") ?>
</body>
</html>
<?php
/**
 * remove magic quotes recursivly
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 */
function remove_magic_quotes(&$array) {
    foreach (array_keys($array) as $key) {
        if (is_array($array[$key])) {
            remove_magic_quotes($array[$key]);
        }else {
            $array[$key] = stripslashes($array[$key]);
        }
    }
}
?>
