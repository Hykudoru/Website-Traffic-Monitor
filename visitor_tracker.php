<?php 
if (!isset($_SESSION)) {
	session_start();
}
/*Page name assigned to variable that is 
used as session key so unique session is 
generated for each page.*/
$page_accessed = $_SERVER['SCRIPT_NAME'];

/*Page accessed is set to 1 if it's the first 
visit or else increment by 1 each page visit.*/
if (!isset($_SESSION["{$page_accessed}"])) {
	$_SESSION["{$page_accessed}"] = 1;
} else {
	$_SESSION["{$page_accessed}"]++;
}	

//Database insert on condition visitor is new
if ($_SESSION["{$page_accessed}"] === 1) {
	
	$ip = $_SERVER['REMOTE_ADDR'];//Visitor IP address
	$port = $_SERVER['REMOTE_PORT'];//Port used
	$method = $_SERVER['REQUEST_METHOD'];//Request Method
	$page = substr(strrchr($_SERVER['SCRIPT_NAME'], '/'), 1);//Page Viewed
	//Internet Explorer
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
		$browser = 'Internet Explorer';
	}//Mozilla Firefox
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
		$browser = 'Mozilla Firefox';
	}//Google Chrome
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
		$browser = 'Google Chrome';
	}//Safari
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')) {
		$browser = 'Safari';
	}//Default
	else {
		$browser = $_SERVER['HTTP_USER_AGENT'];
	}
	
	//Open Connection and Insert New Visitor into MySQL Database
	$cnx = normal_connect(HOST, DB_USER, DB_PASS, DB_NAME, CNX_ENCODE);
	$sql = "INSERT INTO app_traffic(ip, port, method, page, browser) VALUES('{$ip}', '{$port}', '{$method}', '{$page}', '{$browser}')";
	mysqli_query($cnx, $sql) or die("Error: issues storing traffic data! \n<br>");
	mysqli_close($cnx);
		
}//end if condition




