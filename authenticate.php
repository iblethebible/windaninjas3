<?php
include "connectdb.php";
session_start();
ini_set('session.gc_maxlifetime', 30);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(30); 

if ( !isset($_POST['username'], $_POST['password'])) {
    exit('Please input credentials');
}
if ($stmt = $conn->prepare('SELECT id, password FROM users WHERE username= ?')) {
    $stmt->bind_param('s', $_POST['username']) ;
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password);
    $stmt->fetch();

    if (password_verify($_POST['password'], $password)) {
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        header('location: jobs.php');
    } else {
        header('location: index.html');
    }
    }else {
        echo 'Error incorrect credentials';
        header('location: index.html');
    }


    $stmt->close();
}
?>

