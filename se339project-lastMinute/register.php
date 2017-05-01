<?php

$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];
$_SESSION['type'] = $_POST['select'];


$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
$type = $mysqli->escape_string($_POST['select']);
      

$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());


if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");
    
}
else {

   
    $sql = "INSERT INTO users (first_name, last_name, email, password, hash, type, coverletter, experiences) " 
            . "VALUES ('$first_name','$last_name','$email','$password', '$hash', '$type', '', '')";

    if ( $mysqli->query($sql) ){

        $_SESSION['logged_in'] = true; 
        if(trim($type) === "Freelancer"){
            header("location: freelancer.php");
        }
        else if(trim($type) === "Client"){
            header("location: client.php");
        }

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}