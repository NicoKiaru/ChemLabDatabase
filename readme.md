## [Demo version](http://poupitoupou.free.fr/ChemLabDatabase/)

## Installing ChemLabDatabase

Prerequisites:

- Having a server (`yourserver`) with the following software installed:
	- Apache2,
	- MySql, (You'll have to know the server, username and password for this database)
	- PhP
- Unzip `ChemLabDatabase.zip` in the folder you what in the server
-  Type `http://yourserver/folder/ChemLabDatabase/install.php`
- Specify the required information

## Authentification methods

Three authentification methods have been tested. They all require customisation in order to work properly.

-  IPs filtering
- LDAP Authentification
- Shibboleth Authentification



## Security issues


* It is compulsory to make regular backup of the database. Anything can happen (software or hardware problem)

* The software is not completely sql-injection safe. If you discover some security issue, please post an issue.

* It is possible to upload msds sheets and informations sheets in the database. However right now this downloading is not secured, since any file can be uploaded. However every file is renamed with a `.pdf` extension, preventing its execution as a php file. As a second check, be sure that the `.htaccess` file is properly working and that you cannot list the directory.

## Using ChemLabDatabase with multiple labs

This is possible but has several requirements :

* Administration is not fully possible without phpMyAdmin, so please install it.

* Rights managements are very basic, meaning that every people will have the possibility to search in the database of every lab. Only information about the location of the product is hidden when the product does not belong to the user's lab.

### How to add a lab?


* Go to phpMyAdmin
* Add the new lab to the lab table (only specify the name)
* In `sidebar.php`, add where appropriate the option to browse the new lab
* Modify the `auth.php` file to allow access for the people from the new lab
* Be sure that the same lab name is used in the `auth.php` file and in the database:  i.e. the variable `$LABO_USER` should be equal to `lab.name` for correct identification. To check that, compare the `lab.name` field in the database with `phpmyadmin` with an echo `<? echo $LABO_USER; ?>` inserted at the end of `auth.php`.

## Troubleshooting


If you cannot upload msds or information sheets, be sure that the proper administrative rights are set in the msds and Information Sheets folders.

## Bugs :

* Impossible to upload file if a new element (location, type,...) is entered while filling the product
