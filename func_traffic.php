<?php

// Fetch visitor traffic stored in database
function db_fetch_visitors($conn, $app = null) {
	
	// fetch visitors in decending order(id)
	$query = "SELECT * FROM app_traffic
				ORDER BY v_id DESC LIMIT 10";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo 'Failed to fetch visitor traffic!';
		return false;
	}
	
	// if no visitors exist then inform in table
	$num_rows = mysqli_num_rows($result);
	if ($num_rows < 1) {
		echo "<tr>";
		for ($i=0; $i < 7; $i++) {
			echo "<td>No Activity</td>";
		}
		echo "</tr>";
	} 
	
	// display visitor traffic (limit displayed depends on above SQL query)
	while ($row = mysqli_fetch_assoc($result)) {
		// use ipinfo.io JSON API with visitors IP to return location results in JSON format
		$json = file_get_contents('http://ipinfo.io/'.urlencode($row['ip']).'/json');
		$ipinfo = json_decode($json, true);
		
		echo "<tr>\n";
			echo "<td>" . $ipinfo['city'] . ' ' . $ipinfo['region'] . ' ' . $ipinfo['country'] . "</td>\n";
			echo "<td>".$row['ip']."</td>\n";
			echo "<td>".$row['port']."</td>\n";
			echo "<td>".$row['browser']."</td>\n";
			echo "<td>".$row['method']."</td>\n";
			echo "<td>".$row['page']."</td>\n";
			echo "<td>".$row['time_visited']."</td>\n";
		echo "</tr>\n";
	
	}//end while loop
	
}//end function db_fetch_visitors()

//Count total number of visitors stored in database
function db_count_visitors($conn, $app = null) {
	
	//Total Visitor Count
	$query = "SELECT COUNT(v_id) AS total_visits FROM app_traffic";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo 'Something is wrong!';
		return false;
	}
	$total = mysqli_fetch_assoc($result);
	echo $total['total_visits'];
	
}//end function db_count_visitors()