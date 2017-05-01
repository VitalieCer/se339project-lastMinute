<?php
require 'db.php';
session_start();


$oldemail= $_SESSION['email'];
$result=$mysqli->query("SELECT id FROM users WHERE email='$oldemail'");
$id;
if ($result) {
    while($row = mysqli_fetch_row($result)) {
       $id=$row[0];
    }
}

$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];


$first_name;
$last_name;
$email;
$coverletter;
$reqProficiencies;


foreach ($_POST as $key => $value){
    if($key === "firstname"){
        $first_name = $mysqli->escape_string($value);
    }
    else if($key === "lastname"){
        $last_name = $mysqli->escape_string($value);
    }
    else if($key === "email"){
        $email = $mysqli->escape_string($value);
    }
    else if($key === "coverletter"){
        $coverletter = $mysqli->escape_string($value);
    }
    else if($key === "update"){
        
    }
    else{
        if(empty($reqProficiencies)){
            $reqProficiencies = $value;
        }else{
            $reqProficiencies = $reqProficiencies.", ".$value;
        }
    }
};



$sql = "UPDATE users 
        SET first_name='$first_name', last_name='$last_name', email='$email', coverletter='$coverletter', experiences='$reqProficiencies'
        WHERE id = '$id'";


if ( $mysqli->query($sql) ){

    header("location: freelancer.php"); 

}
