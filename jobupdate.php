<?php 
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('location: index.html');
	exit;
}

	?>
<?php include "connectdb.php"; 

$job_id = $_GET['id'];
$zone_id = $_GET['zone'];
//$ispaid = $_GET['paid'];

//get date of last clean from job_history
$lastcleansql = "SELECT * FROM job_history WHERE job_id = " . $job_id;
$result = $conn->query($lastcleansql);
$row = $result->fetch_assoc();
$dateLastDone = $row["dateDone"];


//get house number and name to identify job
$jobdatasql = "SELECT * FROM job WHERE id = " . $job_id;
$result = $conn->query($jobdatasql);
$row = $result->fetch_assoc();

$job_id = $row["id"];
$house_num = $row["houseNumName"];
$street_name = $row["streetName"];
//$ispaid = $row["paid"];
$price = $row["price"];
//$dateLastDone = $row["dateLastDone"];
$zone = $row["zone_id"];
$dateNextDue = $row["dateNextDue"];
$job_frequency = $row["frequency"];
$info = $row["info"];

$zonename = "SELECT area FROM zone INNER JOIN job ON zone.id = job.zone_id WHERE job.id = $job_id;";
$result = $conn->query($zonename);
$row = $result->fetch_assoc();

$areanameprod = $row["area"];




if (isset($_GET['submit_button'])) {


$sql0 = "SELECT frequency FROM job WHERE id = $job_id;";

$result = $conn->query($sql0);
$row = $result->fetch_assoc();


$job_frequency = $row["frequency"];




$job_frequency_days = $job_frequency * 7;





    



//MULTI_QUERY INSTEAD OF QUERY TO DO MULTIPLE QUERIESS
$sql = "UPDATE job SET dateLastDone = NOW() WHERE id = $job_id;
        UPDATE job SET dateNextDue = DATE_ADD(NOW(), INTERVAL $job_frequency_days DAY) WHERE id = $job_id;
        /*UPDATE job SET paid = 0 WHERE id = $job_id;*/
        INSERT INTO job_history (job_id, dateDone, paid) VALUES ($job_id, NOW(), 0);";

if ($conn->multi_query($sql) === TRUE) {


   echo '<div class="alert alert-warning">
   <strong>Success!</strong> JOB COMPLETED UNPAID.
  </div>';
  header("Refresh: 1; URL=jobupdate.php?id=" . $job_id);
    
    //******** ADD A POP UP MESSAGE CONFIRMING JOB COMPLETION*/
}
else {
    //echo "ERROR: " . $conn->error . "</p>";
}

}
if (isset($_GET['submit_two'])) {
    $sql0 = "SELECT frequency FROM job WHERE id = $job_id;";

$result = $conn->query($sql0);
$row = $result->fetch_assoc();


$job_frequency = $row["frequency"];




$job_frequency_days = $job_frequency * 7;

    $sql2 = "UPDATE job SET dateLastDone = NOW() WHERE id = $job_id;
        UPDATE job SET dateNextDue = DATE_ADD(NOW(), INTERVAL $job_frequency_days DAY) WHERE id = $job_id;
        /*UPDATE job SET paid = 1 WHERE id = $job_id;*/
        INSERT INTO job_history (job_id, dateDone, paid) VALUES ($job_id, NOW(), 1);";

        if ($conn->multi_query($sql2) === TRUE) {
 
            echo '<div class="alert alert-success">
            <strong>Success!</strong> JOB COMPLETED PAID.
          </div>';
          header("Refresh: 1; URL=jobupdate.php?id=" . $job_id);
            
            
    
        }
        else {
           echo "ERROR: " . $connect_error . "</p>";
        }
}



$conn->close();
?>
<html>
    <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="/js/removeCompleteButtons.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<script src="jquery-3.6.0.min.js"></script>
<link href="main.css" rel="stylesheet">
</head>
<body>
<div class="d-grid gap-3">
<?php 
if ($ispaid == 1) { 
    $isjobpaid= "<B>PAID</b>";
}
else {
    $isjobpaid = "<b>NOT PAID</b>";
}

?>

<button onClick="location.href = 'jobs.php' ; " class="btn btn-primary" type="button">Home</button>
  <button onclick="location.href = 'profile.php' ; " class="btn btn-secondary" type="button">Manager mode</button>
</div>

<h1><?php echo $house_num . " " . $street_name?></h1>
<h2><a href="jobhistory.php?id=<?php echo $job_id?>">History</a></h2>
<div class="container">
<div class="row">
<div class="col-sm">



<!--echo php strings to create the buttons-->
<?php
$jobcompleteunpaid = '<form action="jobupdate.php" method="get"><input type="hidden" name="id" value="'.$job_id.'"><input id ="unpaid-button" class="btn btn-warning "type="submit" name="submit_button" value="JOB COMPLETE/UNPAID">';

$jobcompletepaid = '<form action="jobupdate.php" method="get"><input type="hidden" name="id" value="'.$job_id.'"><input class="btn btn-success" type="submit" name="submit_two" value="JOB COMPLETE/PAID"></form>';


echo $jobcompleteunpaid;
?>
</form>
</div>

<div class="col-sm">

<table class="table table-hover">
    <tr>
            <th>Last cleaned:</th>
            <td><?php echo $dateLastDone?></td>
            
</tr>
<tr>
    <th>Clean on:</th>
    <td><?php echo $dateNextDue?></td>
</tr>
<tr>
    <th>Zone:</th>
    <td><?php 
    
    echo $areanameprod?></td>
</tr>
<tr>
    <th>Price:</th>
    <td><?php echo "£" . $price?></td>
</tr>
<tr>
    <th>Frequency:</th>
    <td><?php echo $job_frequency . " weeks"?></td>
</tr>
<tr>
    <th>Job info:</th>
    <td><?php echo $info?></td>
</tr>
</table>
    
</div>



<div class="col-sm">


<?php
echo $jobcompletepaid
?>
</div>
<button onClick="location.href = 'jobview.php?id=<?php echo $job_id ?>'; " class="btn btn-danger" type="button">EDIT JOB</button>

</div>
</div>

</body>
</html>
