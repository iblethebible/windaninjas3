<?php 
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('location: index.html');
	exit;
}

 include "connectdb.php"; 


//Add up total owed from customers. select price from job where jobpaid = 0


//Select all jobs that are unpaid
$unpaidjobs = "SELECT paid FROM"


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





        </div>
    </body>
        </html>