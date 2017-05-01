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
            <ul class="tab-group">
                <li class="tab"><a href="#viewjob">View Job Description</a></li>
                <?php if($type !== "Freelancer") : ?>
                    <li class="tab active"><a href="#viewcandidates">View Candidates/Applicants</a></li>
                <?php endif;?>   
        
            </ul>
            <div class="tab-content">
        
            <?php
                if($type !== "Freelancer") :
                ?>
                <div id="viewcandidates">
                <h1>Job Description</h1>
                    <form action="client.php" method="post" autocomplete="off">
                        <?php
                        $result = $mysqli->query("SELECT reqProficiencies FROM `jobs` WHERE email='$email'");
                        $experiences;
                        if ($result) {
                            while($row = mysqli_fetch_row($result)) {
                               $experiences=$row[0];
                            }
                        }
                        $arrUser = explode(", ",$experiences);
                        $experiences2;
                        $result = $mysqli->query("SELECT * FROM `users`");
                        if ($result) {
                            while($row = mysqli_fetch_row($result)) {
                               $experiences2 = $row[9];
                               $arrClient = explode(", ",$experiences2);
                                if(empty($row)){
                                    continue;
                                }
        
                                if(array_intersect($arrClient,$arrUser)){
                                   
                                    ?>
                                <div id="boxes">
                                <ul>
                                    <li><a href="viewfreelancer.php?id=<?=$row[0]?>"><p><?=$row[2]?>, <?=$row[1]?></p><b>Email:</b> <?=$row[3]?><br><b>Proficiencies:</b> <?=$row[9]?></a></li>
                                
                                </ul>
                                </div>
                        <?php
                                }
                            }
                        }
                ?>
                        
                        
                    </form>
                    <a href="client.php"><button class="button button-block"/>Back</button></a>
                <?php endif;?>
                </div>
                <div id="viewjob">
                    <form action="viewjobs.php" method="post" autocomplete="off">
                        <?php
                        $id = $_GET['id'];
                        $result = $mysqli->query("SELECT * FROM `jobs` WHERE id='$id'");
                        if ($result) {
                            while($row = mysqli_fetch_row($result)) {
                                
                        ?>
                            <div>
                                <ul>
                                    <h1><?=$row[2]?></h1>
                                    <div class="field-wrap">
                                        <div class="label2">
                                        
                                           Company  <span><?=$row[3]?></span>
                                       
                                        </div>
                                        
                                    </div>
                                    <div class="field-wrap">

                                        <div class="label2">
                                           Description  <span><?=$row[4]?></span>
                                        </div>

                                    </div>
                                    <div class="field-wrap">
                                         <div class="label2">
                                           Proficiencies  <span><?=$row[5]?></span>
                                        </div>
                                    </div>
                                
                                </ul>
                            </div>
                        <?php
                            }
                        };
                                ?>
                    </form>
                    
                   <?php if($type !== "Freelancer") : ?>
                    <a href="client.php"><button class="button button-block"/>Back</button></a>
                    <?php else: ?> 
                    <a href="freelancer.php"><button class="button button-block"/>Back</button></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/index.js"></script>