<?php 
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('location: index.html');
	exit;
}

	?>
<?php include "connectdb.php"; 

$jobtableid =$_GET["id"];
$zone_id = $_GET['zone'];


//if statement to chec if jobs have been paid and display pay now link if not




?>
<html>
	<head>
	<script type="text/javascript" src="js/removeCompleteButtons.js"></script>
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
  
  <button onClick="location.href = 'jobs.php' ; " class="btn btn-primary" type="button">Home</button>
  <button onclick="location.href = 'profile.php' ; " class="btn btn-secondary" type="button">Manager mode</button>

		</div>

        <!--get house number and name to identify job-->
     <?php $jobdatasql = "SELECT * FROM job WHERE id = " . $jobtableid;
    $result = $conn->query($jobdatasql);
    $row = $result->fetch_assoc(); 
    $house_num = $row["houseNumName"];
    $street_name = $row["streetName"];
    
    
    
    ?>  


        <h1>Job history <br><?php echo $house_num . " " . $street_name?></h1>

<?php
$jobhistorysql = "SELECT * FROM job_history WHERE job_id = " . $jobtableid;
$result = $conn->query($jobhistorysql);


if ($result->num_rows > 0) {
    echo '<table class="table table-hover">';
	echo '<tr>';
    echo '<th>Date Completed</th>';
    echo '<th>Paid</th>';
    
    if ($row["paid"] == 0)
    {
        echo '<th>Mark Paid</th>';
    }



    echo '</tr>';

    while ($row = $result->fetch_assoc()){
        echo '<tr>';
        echo '<td>' . $row["dateDone"] . '</td>';
        echo '<td>' . $row["paid"] . '</td>';
        if ($row["paid"] == 0)
    {
        echo '<th>Mark Paid Button to go here</th>';
    }
     
        echo '</tr>';
       
    }
    echo '</table>';
}
else {
    echo '0 result  or error';
}
    
    $conn->close();
    ?>
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
