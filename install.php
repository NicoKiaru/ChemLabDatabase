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
<? include ("head.php"); error_reporting(E_ALL);?>

<body>
<? include ("header.php"); ?>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
	
	<h1> Welcome to ChemLabDatabase installation </h1>
	<h3> Simple chemicals database for academic lab. </h3>
	<p>This software is an online database to register chemicals/products in a research lab. Very simple, user-friendly. Requires a server with Apache, Php and MySql. User identification can be made via LDAP or Shibboleth.</p><br>
	<p> Requirements : you should have php and MySql installed.</p>
	<form method="post" action="install_submit.php" enctype="multipart/form-data">
		<TABLE BORDER=0>
	<TR>
		<TD colspan="2">Server Name</TD>		
		<TD><input type="text" name="db_servername" value="localhost"/></TD>
		
	</TR>
	<TR>
		<TD colspan="2">Database Name</TD>		
		<TD><input type="text" name="db_name" value="db_chemlabdatabase"/></TD>
	</TR>
	<TR>
		<TD colspan="2">Database User</TD>		
		<TD><input type="text" name="db_username" value="root"/></TD>
	</TR>
	<TR>
		<TD colspan="2">Database Password</TD>		
		<TD><input type="text" name="db_password" value=""/></TD>
	</TR>
	<TR>
		<TD colspan="2">Webmaster email</TD>		
		<TD><input type="text" name="email" value=""/></TD>
	</TR>
	<TR>
		<TD colspan="2">Institution name</TD>		
		<TD><input type="text" name="uni_name" value="MyUniversity"/></TD>
	</TR>
	<TR>
		<TD colspan="2">Lab name</TD>		
		<TD><input type="text" name="lab_name" value="MyLab"/></TD>
	</TR>
	</TABLE>
	<br>
	<p>To run some basic tests and for software testing, the default authentification mode is by selecting authorized ip address. In order to use properly the database, this has to be modified either with LDAP authentification / Shibboleth or anything else that has to be coded in the auth.php file. Only one ip is allowed in the install script. This can be changed in the localsettings.php file once it is created.</p>
	<br>
	<TABLE BORDER=0>
	<TR>
		<TD colspan="2">Authorized ip (your current ip)</TD>		
		<TD><input type="text" name="auth_ip" value="<?php echo $_SERVER["REMOTE_ADDR"];?>"/></TD>
		
	</TR>
	</TABLE>
	<br>
<p>	<h3>Click here if you want to have example products filled in the database: <input type="checkbox" name="sample_db" value=""/>. Otherwise the database will be empty.</h3></p>
	<input type="submit" name="Install" value="Install" />
	</form>

	</div>
	<!-- end content -->
	<br style="clear: both;" />
</div>
<!-- end page -->
<? include("footer.php") ?>
</body>
</html>
