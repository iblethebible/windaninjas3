<?php 
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('location: index.html');
	exit;
}

	?>
<?php include "connectdb.php";
$job_id = $_GET['id'];
$delete = $_GET["delete"];

if ($delete == "true") {
    

    $sql = "DELETE FROM job WHERE id=$job_id;";
    

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success">
            <strong>Success!</strong> JOB DELETED.
          </div>';
        header("Refresh: 3; URL=jobs.php");

    }
    else {
        echo "ERROR: " . $conn->error . "</p>";
    }
}
?> 
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
		<link href="main.css" rel="stylesheet">
        <title>Winda Ninjas</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
<div class="d-grid gap-3">
 
 <button onClick="location.href = 'jobadd.php' ; " class="btn btn-primary" type="button">Add Job</button>
 <button onClick="location.href = 'jobsarea.php' ; " class="btn btn-primary" type="button">Select Zone</button>
 <button onClick="location.href = 'jobs.php' ; " class="btn btn-primary" type="button">All Jobs</button>
 <button onClick="location.href = 'profile.php' ; " class="btn btn-warning" type="button">Profile</button>
 
</div>
    <?php 
    $sql ="SELECT houseNumName, streetName FROM job WHERE id = " . $job_id;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <h1>Delete job: <?php echo $row["houseNumName"] . " " . $row["streetName"]?></h1>
    <div class="alert alert-danger" role="alert">
  Are you sure? This is permanent!
</div>

    <br>
    <a href="jobdelete.php?id=<?php echo $job_id ?>&delete=true">DELETE JOB</a>
</body>
</html>