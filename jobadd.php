<?php 
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('location: index.html');
	exit;
}

	?>
<?php 
include "connectdb.php";

if ($_GET["job_add_submit"]) {
    $var_house_num = $_GET["house_num_form"];
    $var_street = $_GET["street_form"];
    $var_price = $_GET["price_form"];
    $var_frequency = $_GET["frequency_form"];
    $var_zone = $_GET["zone_form"];
    $var_info = $_GET["info_form"];

    $sql = "INSERT INTO job (houseNumName, streetName, price, frequency, zone_id, info) VALUES ('$var_house_num', '$var_street', '$var_price', '$var_frequency','$var_zone', '$var_info')";

    
    
    if ($conn->query($sql) ===TRUE) {
        echo '<div class="alert alert-success">
            <strong>Success!</strong> Job record added.
          </div>';
    }
    else {
        echo "Error: " . $conn->error; 
    }
}


?>
<html>
    <head>
    <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Winda Ninjas</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">    
<!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="main.css" rel="stylesheet">
    </head>
    <body>
    
  
  
    <div class="d-grid gap-3">
 
 
 <button onClick="location.href = 'jobs.php' ; " class="btn btn-primary" type="button">Home</button>
 <button onClick="location.href = 'profile.php' ; " class="btn btn-secondary" type="button">Manager Mode</button>

</div>
<h1>
        Add Job
    </h1>
<div class="container">
    <div class="mb-3">
    <form action="jobadd.php" method="get">
        <input type="text" name="house_num_form" placeholder="House Number/Name">
</div>
<div class ="mb-3">
        <input type="text" name="street_form" placeholder="Street Name">
</div>
<div class="mb-3">        
         <input type="number" name="price_form" placeholder="Price">
</div>
<div class="mb-3">
        <input type="number" name="frequency_form" placeholder="Frequency in weeks(number)">
        
</div>

<div class="mb-3" id="areaselect">
        <select class="form-select" name="zone_form" >
            <option value="1">Bayston Hill</option>
	        <option value="2">Belle Vue</option>
	        <option value="3">Copthorne</option>
	        <option value="4">Meole</option>
	        <option value="5">Monkmoor</option>
	        <option value="6">Mount Pleasant</option>
	        <option value="7">Radbrook</option>
	        <option value="8">Sundorne</option>
</select>
</div>
<div class="mb-3">
        <input type="text" name="info_form" placeholder="Information">
</div>
</div>
<div class="mb-3">        
        <input type="submit" name="job_add_submit" value="submit">
</div>
    </form>

    </body>
</html>