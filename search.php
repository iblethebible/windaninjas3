<?php 
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('location: index.html');
	exit;
}

	?>
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
 <button onClick="location.href = 'jobsarea.php' ; " class="btn btn-primary" type="button">Select Zone</button>

 <button onClick="location.href = 'profile.php' ; " class="btn btn-warning" type="button">Profile</button>
</div>
    <form action="search.php" method="get">
    Search <input type="text" name="search"><br>
    <input type ="submit" name="submit_button">
</form>

    </body>
    </html>

<?php include "connectdb.php"; 
if (isset($_GET['submit_button'])) {
    $search = $_GET['search'];
   
    $sql = "select * from job where streetName like '%$search%'";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table table-hover">';
        echo '<tr>';
        echo '<th>House</th>';
        echo '<th>Street Name</th>';
        echo '<th>Price</th>';
        echo '<th>Frequency</th>';
        echo '<th>Completed</th>';
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
            echo '<td>' . $row["dateLastDone"] . '</td>';
            echo '<td>' . $row["dateNextDue"] . '</td>';
            //echo '<td>' . $row["zone_id"] . '</td>';
            echo '<td>' . $row["info"] . '</td>';
            echo '<td><a href="jobupdate.php?id=' . $row["id"] . '">UPDATE</a></td>';
            //echo '<td><a href="jobview.php?id=' . $row["id"] . '">EDIT</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    $conn->close();
}
	?>
