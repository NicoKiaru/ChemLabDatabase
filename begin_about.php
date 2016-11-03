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
<? require_once( "localsettings.php" ); ?>
<? include("connect_db.php") ?>
<? include("auth/auth.php") ?>
<? include ("head.php"); ?>


<body>
<? include ("header_about.php"); ?>
<!-- start page -->
<div id="page">
	<? include ("sidebar.php"); ?>
	<!-- start content -->
	<div id="content">
	<? include ("functions_php.php"); 
		error_reporting(E_ALL); ?>
	
