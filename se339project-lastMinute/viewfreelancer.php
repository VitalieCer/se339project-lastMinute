<?php

session_start();
require 'db.php';


if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $type = $_SESSION['type'];
    $id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php include 'css/css.html'; ?>
    </head>

    <body>
        <div class="form">
            <?php
                        
                        $result = $mysqli->query("SELECT * FROM `users` WHERE id='$id'");
                        
                        if ($result) {
                            
                            while($row = mysqli_fetch_row($result)) {
                                
                        ?>
                            <div>
                                <ul>
                                    <h1><?=$row[2]?></h1>
                                    <div class="field-wrap">
                                        <div class="label2">
                                        
                                           First Name <span><?=$row[1]?></span>
                                       
                                        </div>
                                        
                                    </div>
                                    <div class="field-wrap">

                                        <div class="label2">
                                           Last Name <span><?=$row[2]?></span>
                                        </div>

                                    </div>
                                    <div class="field-wrap">
                                         <div class="label2">
                                           Email <span><?=$row[3]?></span>
                                        </div>
                                    </div>
                                    
                                     <div class="field-wrap">
                                         <div class="label2">
                                           Cover Letter: <span><?=$row[8]?></span>
                                         </div>
                                    </div>
                                    <div class="field-wrap">
                                         <div class="label2">
                                           Proficiencies: <span><?=$row[9]?></span>
                                         </div>
                                    </div>
                                
                                </ul>
                            </div>
                        <?php
                            }
                        };
                                ?>
        <a href="client.php"><button class="button button-block"/>Back</button></a>
        </div>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/index.js"></script>