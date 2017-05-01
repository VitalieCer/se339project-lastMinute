<?php

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'accounts';
$mysqli = new mysqli($host,$user,$pass,$db,3306) or die($mysqli->error);

$mysqli->query('
    CREATE TABLE `accounts`.`users` 
    (
    `id` INT NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50) NOT NULL,
     `last_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `hash` VARCHAR(32) NOT NULL,
    `type` VARCHAR(50) NOT NULL,
    `active` BOOL NOT NULL DEFAULT 1,
    `coverletter` VARCHAR(5000),
    `experiences` VARCHAR(1000),
    PRIMARY KEY (`id`) 
);')
    
    
?>