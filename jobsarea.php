<?php 
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('location: index.html');
	exit;
}

	?>
<?php include "connectdb.php"; ?>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link href="main.css" rel="stylesheet">
	<style>
		tr:nth-child(even) {
  			background-color: #D6EEEE;
		}
	</style>
	<title>Winda Ninjas</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
</head> 
<body>

<div class="d-grid gap-3">
 
  <button onClick="location.href = 'jobadd.php';" class="btn btn-primary" type="button">Add Job</button>
  <button onClick="location.href = 'jobs.php' ; " class="btn btn-primary" type="button">All Jobs</button>
  <button onClick="location.href = 'profile.php' ; " class="btn btn-warning" type="button">Profile</button>
  

</div>


<h1>Zone Select</h1>
<form action="jobsarea.php">
<label for="zone">Where are you working?</label>
<select name="zone" id="zone">
	<option value="1">Bayston Hill</option>
	<option value="2">Belle Vue</option>
	<option value="3">Copthorne</option>
	<option value="4">Meole</option>
	<option value="5">Monkmoor</option>
	<option value="6">Mount Pleasant</option>
	<option value="7">Radbrook</option>
	<option value="8">Sundorne</option>
</select>
<input type="submit" name="submit_button">
</form>
<?php
if (isset($_GET['submit_button'])) {


$zone_id = $_GET['zone'];
	
$sql = "SELECT * FROM job WHERE zone_id = $zone_id ORDER BY dateNextDue ASC;";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo '<table class="table table-hover">';
	echo '<tr>';
	echo '<th>House</th>';
	echo '<th>Street Name</th>';
	echo '<th>Price</th>';
	echo '<th>Frequency</th>';
	
	echo '<th><b>Next Due</b></th>';
	//echo '<th>Zone</th>';
	echo '<th>info</th>';

	echo '<th>COMPLETE</th>';
	//echo '<th>EDIT</th>';
	echo '</tr>';
	
	while ($row = $result->fetch_assoc()) {
		echo '<tr>';
		echo '<td>' . $row["houseNumName"] . '</td>';
		echo '<td>' . $row["streetName"] . '</td>';
		echo '<td>£' . $row["price"] . '</td>';
		echo '<td>' . $row["frequency"] . ' Weeks</td>';
		
		echo '<td>' . $row["dateNextDue"] . '</td>';
		//echo '<td>' . $row["zone_id"] . '</td>';
		echo '<td>' . $row["info"] . '</td>';
		echo '<td><a href="jobupdate.php?id=' . $row["id"] . '">UPDATE</a></td>';
		//echo '<td><a href="jobview.php?id=' . $row["id"] . '">EDIT</a></td>';
		echo '</tr>';
	}
	echo '</table>';
}
}
$conn->close();
?>





</body>
</html>
