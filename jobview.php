<?php 
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('location: index.html');
	exit;
}

	?>
<?php include "connectdb.php";
$job_id = $_GET['id'];


//check for form submit
if (isset($_GET['job_edit_submit'])) {

        

        $job_price = $_GET['price_form'];
        $job_frequency = $_GET['frequency_form'];
        $job_info = $_GET['info_form'];

        $sql = "UPDATE job SET price = '$job_price', frequency = '$job_frequency', info = '$job_info' WHERE id = '$job_id';";
        

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success">
    <strong>Success!</strong> JOB EDITED.
  </div>';
  header("Refresh: 1; URL=jobupdate.php?id=" . $job_id);
        }
        else {
            echo "ERROR: " . $conn->error . "</p>";
        }        
}

$sql = "SELECT * FROM job WHERE id = " . $job_id;
$result = $conn->query($sql);

$row = $result->fetch_assoc();

//$job_price = $row["price"];
//$job_frequency = $row["frequency"];
//$job_info = $row["info"];

?>
<html>
	<head>
    <title>Winda Ninjas</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
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
	</head>
<body> 

<div class="d-grid gap-3">
 
 <button onClick="location.href = 'jobadd.php' ; " class="btn btn-primary" type="button">Add Job</button>
 <button onClick="location.href = 'jobsarea.php' ; " class="btn btn-primary" type="button">Select Zone</button>
 <button onClick="location.href = 'jobs.php' ; " class="btn btn-primary" type="button">All Jobs</button>

 <button onClick="location.href = 'profile.php' ; " class="btn btn-warning" type="button">Profile</button>


</div>

<h1>Edit Job</h1>
<h2><?php echo $row["houseNumName"] . " " . $row["streetName"]?></h2>
 

  <form action="jobview.php" method="get">
    <input type="hidden" name="id" value="<?php echo $job_id ?>">
    <div class ="mb-3">
        Price: <input type="number" name="price_form" value="<?php echo $row["price"] ?>"><br>
        </div>
        <div class="mb-3">
    Frequency: <input type="number" name="frequency_form" value="<?php echo $row["frequency"] ?>"><br>
        </div>
        <div class ="mb-3">
    
        </div>        Info: <input type="text" name="info_form" value="<?php echo $row["info"] ?>"><br>
    <div class="mb-3">
        <br>
        <input type="submit" name="job_edit_submit" value="submit">
        </div>
    </form>
    <br>
    <br>
    <br>
<button onClick="location.href = 'jobdelete.php?id=<?php echo $job_id ?>'; " class="btn btn-danger" type="button">REQUEST DELETE</button>
</body>
</html>