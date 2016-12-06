<?php

//Connects to MySQL Database Server
function normal_connect($host, $db_user, $db_pass, $db_name, $connection_encoding) {
	
	//CONNECT TO SERVER
	$connection = mysqli_connect($host, $db_user, $db_pass);
	if(!$connection) {
		die('Error: Something went wrong while processing your request. Please contact admin for support!');
	}	
	//CONNECT TO DATABASE
	$db_connect = mysqli_select_db($connection, $db_name);
	if(!$db_connect) {
		die('Error: Something went wrong while processing your request. Please contact admin for support!');
	}
	//CONNECTION ENCODING: used when sending data to and from database server	
	$encoding = mysqli_set_charset($connection, $connection_encoding);	
	if(!$encoding) {
		die('Error: Something went wrong while processing your request. Please contact admin for support!');
	}
	
	return $connection;
	
}//end function 