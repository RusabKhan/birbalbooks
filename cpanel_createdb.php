
<?php
require("xmlapi.php"); // this can be downlaoded from https://github.com/CpanelInc/xmlapi-php/blob/master/xmlapi.php
$xmlapi = new xmlapi("birbalbooks.com");   
$xmlapi->set_port( 2083 );   
$xmlapi->password_auth('birbalbo','Dj4*6DIugg7#2Z');    
$xmlapi->set_debug(1);//output actions in the error log 1 for true and 0 false 

$cpaneluser='birbalbo';
$databasename="example";
$databaseuser="else";
$databasepass='pass';

//create database    
print $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));  

//create user 
//$usr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduser", array($databaseuser, $databasepass));   
//add user 
//$addusr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduserdb", array("".$cpaneluser."_".$databasename."", "".$cpaneluser."_".$databaseuser."", 'all'));