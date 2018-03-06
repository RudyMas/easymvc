<?php
/**
 * Settings for your database(s)
 */

# If the EasyMVC Login system is used, this database needs to contain the Login User Table
$database[0]['objectName'] = 'DBconnect'; // Don't change this (EasyRouter uses this to inject Repositories)
$database[0]['dbHost'] = 'localhost';
$database[0]['port'] = '3306';
$database[0]['dbUsername'] = 'username';
$database[0]['dbPassword'] = 'password';
$database[0]['dbName'] = 'database_name';
$database[0]['dbCharset'] = 'utf8';
$database[0]['dbType'] = 'mysql';

# If you use more than one database, you can add them like this:
//$database[1]['objectName'] = 'anything_you_want';
//$database[1]['dbHost'] = 'localhost';
//$database[1]['port'] = '3306';
//$database[1]['dbUsername'] = 'username';
//$database[1]['dbPassword'] = 'password';
//$database[1]['dbName'] = 'database_name';
//$database[1]['dbCharset'] = 'utf8';
//$database[1]['dbType'] = 'mysql';

/** End of File: database.php **/