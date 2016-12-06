<?php
session_start();
if(!isset($_SESSION['LoggedIn'])) {
	die('Access Denied!');
}
include_once('config.php');
include_once('mysqli_connect.php');
include_once('func_traffic.php');

//open connection
$cnx = normal_connect(HOST, DB_USER, DB_PASS, DB_NAME, CNX_ENCODE);

?><!DOCTYPE html>
<html>
<head>
	<title>Site-App Traffic Monitor</title>
	<!--META TAG SPECIFICITY-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<!--STYLE SHEETS, MEDIA, SCRIPTS-->
	<link href="css/style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	
	
<!--Header-->
<header>
	<h1>Site-App Traffic Monitor</h1>
</header>	


<!--Server Details-->
<table class="server-table">
	<!--Track Total Number Visited-->
	<caption class="server-heading">
		<?php db_count_visitors($cnx); ?> Visitor Sessions
	</caption>
	<thead>
		<tr>
			<th>Server</th>
			<th>Server Protocol</th>
			<th>Host/Domain</th>
			<th>Server IP</th>
			<th>Server Port</th>
			<th>Site-App Directory</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
			<td><?php echo $_SERVER['SERVER_PROTOCOL']; ?></td>
			<td><?php echo $_SERVER['SERVER_NAME']?></td>
			<td><?php echo $_SERVER['SERVER_ADDR']; ?></td>
			<td><?php echo $_SERVER['SERVER_PORT']; ?></td>
			<td><?php echo substr(strrchr(getcwd(), '/'), 0); ?></td>
		</tr>
	</tbody>
</table>


<!--Visitor Details-->
<table class="visitor-table">
	<!--Recent Activity-->
	<caption class="activity-heading">Recent Activity</caption>
	<thead>
		<tr>
			<th>Location</th>
			<th>Remote IP</th>
			<th>Remote Port</th>
			<th>Browser (User-Agent)</th>
			<th>Request Method</th>
			<th>Page Viewed</th>
			<th>Date/Time</th>
		</tr>
	</thead>
	<tbody>
		<?php db_fetch_visitors($cnx); ?>
	</tbody>
</table>


</body>
</html>