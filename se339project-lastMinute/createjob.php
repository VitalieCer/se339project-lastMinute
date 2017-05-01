<?php
require 'db.php';
session_start();
$val = mysql_query('select 1 from `accounts`.`jobs` LIMIT 1');

if($val === FALSE)
{
   $mysqli->query('
   CREATE TABLE `accounts`.`jobs` 
   (
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(100) NOT NULL,
    `jobName` VARCHAR(100) NOT NULL,
    `companyName` VARCHAR(100) NOT NULL,
    `description` VARCHAR(10000) NOT NULL,
    `reqProficiencies` VARCHAR(5000) NOT NULL,
    PRIMARY KEY (`id`) 
    );');
}
$email = $_SESSION['email'];
$jobName = "";
$companyName = "";
$description = "";
$reqProficiencies;
foreach ($_POST as $key => $value){
    if($key === "jname"){
        $jobName = $mysqli->escape_string($value);
    }
    else if($key === "cname"){
        $companyName = $mysqli->escape_string($value);
    }
    else if($key === "jdescription"){
        $description = $mysqli->escape_string($value);
    }
    else if($key === "createjob"){
        
    }
    else{
        if(empty($reqProficiencies)){
            $reqProficiencies = $value;
        }else{
            $reqProficiencies = $reqProficiencies.", ".$value;
        }
    }
};
echo "$email";

$sql = "INSERT INTO jobs (email, jobName, companyName, description, reqProficiencies) " . "VALUES ('$email','$jobName','$companyName','$description','$reqProficiencies')";

if ( $mysqli->query($sql) ){
        header("location: client.php");
}
?>