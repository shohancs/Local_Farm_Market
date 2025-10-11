<?php  
	$db = mysqli_connect("localhost", "root", "", "farm_market");

	if ($db) {
		// echo "Database Connected Successfully";
	}
	else {
		die("Mysqli Error." . mysqli_error($db));
	}
?>