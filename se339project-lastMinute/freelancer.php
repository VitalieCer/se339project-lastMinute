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
if(trim($type) === "Client"){
    header("location: client.php"); 
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Freelancer Page</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">
            <ul class="tab-group">
                <li class="tab"><a href="#editprofile">Edit Profile</a></li>
                <li class="tab active"><a href="#viewavailablejobs">View Available Jobs</a></li>

            </ul>
        
            <div class="tab-content">
        
                
                <div id="viewavailablejobs">
                <h1>Job Description</h1>
                    <form action="freelancer.php" method="post" autocomplete="off">
                        <?php 
                        $result = $mysqli->query("SELECT experiences FROM `users` WHERE email='$email'");
                        $experiences;
                        if ($result) {
                            while($row = mysqli_fetch_row($result)) {
                               $experiences=$row[0];
                            }
                        }
                        $arrUser = explode(",",$experiences);
                        $experiences2;
                        $result = $mysqli->query("SELECT * FROM `jobs`");
                        if ($result) {
                            while($row = mysqli_fetch_row($result)) {
                               $experiences2 = $row[5];
                               $arrClient = explode(", ",$experiences2);
                                
                                if(array_intersect($arrClient,$arrUser)){
                                    ?>
                                <div id="boxes">
                                <ul>
                                    <li><a href="viewjobs.php?id=<?=$row[0]?>"><p><?=$row[2]?></p><b>Company:</b> <?=$row[3]?><br><b>Description:</b> <?=$row[4]?><br><b>Proficiencies Required:</b> <?=$row[5]?></a></li>
                                
                                </ul>
                                </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </form>
                     <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
                </div>
                <div id="editprofile">
                    <form action="editprofile.php" method="post" autocomplete="off">
                        <?php
                        
                        $result = $mysqli->query("SELECT * FROM `users` WHERE email='$email'");
                        
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
                        <br><br><hr><br>
                            <div class="field-wrap">
                              <label>
                                First Name<span class="req">*</span>
                              </label>
                              <input type="text" required autocomplete="off" name='firstname' />
                            </div>

                            <div class="field-wrap">
                              <label>
                                Last Name<span class="req">*</span>
                              </label>
                              <input type="text"required autocomplete="off" name='lastname' />
                            </div>
                          

                          <div class="field-wrap">
                            <label>
                              Email Address<span class="req">*</span>
                            </label>
                            <input type="email"required autocomplete="off" name='email' />
                          </div>
                            
                           <div class="field-wrap">
                            <label>
                                Cover Letter<span class="req">*</span>
                            </label>
                            <textarea rows="12" cols="50" name="coverletter" ></textarea>
                               
                            <div class="field-wrap">
                                <br><br><br>
                        <label>Choose Experienced Proficiencies</label>
                        <br><br><br>
                            <div class="input_fields_wrap">
                                <div><select class="button2" name="select0">
                                      <option class="blank" value=""></option>
                                      <option value="Algorithms" selected>Algorithms</option>
                                      <option value="Mathematics" >Mathematics</option>
                                      <option value="Functional Programming">Functional Programming</option>
                                      <option value="Artificial Intelligence" >Artificial Intelligence</option>
                                      <option value="cpp" >C++</option>
                                      <option value="Python" >Python</option>
                                      <option value="SQL" >SQL</option>
                                      <option value="Distributed Systems">Distributed Systems</option>
                                      <option value="Data Structures">Data Structures</option>
                                      <option value="Java">Java</option>
                                      <option value="Ruby">Ruby</option>
                                      <option value="Databases">Databases</option>
                                      <option value="Linux Shell">Linux Shell</option>
                                      <option value="Security">Security</option>
                                  </select>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="add_field_button button2">Add Proficiencies</button>
                            <br>
                        </div>
                        <button type="submit" class="button button-block" name="update" />Update Profile</button>
                        <br>
                        
                        </div>
                    
                    </form>
                </div>
                
                
            </div>
        </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
