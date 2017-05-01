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
}
?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Client Page></title>
        <?php include 'css/css.html'; ?>
    </head>

    <body>
        <div class="form">
            <ul class="tab-group">
                <li class="tab"><a href="#createjob">Create Job</a></li>
                <li class="tab active"><a href="#viewjobs">View Your Jobs</a></li>
            </ul>
            <div class="tab-content">
            
            
            <div id="viewjobs">
                <h1>Your Created Jobs</h1>
                    <form action="client.php" method="post" autocomplete="off">
                        <?php
                        $result = $mysqli->query("SELECT * FROM `jobs` WHERE email='$email'");
                        if ($result) {
                            while($row = mysqli_fetch_row($result)) {
                                
                        ?>
                            <div id="boxes">
                                <ul>
                                    <li><a href="viewjobs.php?id=<?=$row[0]?>"><p><?=$row[2]?></p><b>Company:</b> <?=$row[3]?><br><b>Description:</b> <?=$row[4]?><br><b>Proficiencies Required:</b> <?=$row[5]?></a></li>
                                
                                </ul>
                            </div>
                        <?php
                            
                            }
                        }
                        ?>
                        
                        
                    </form>
                <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
                </div>
            
            <div id="createjob">

                    <form action="createjob.php" method="post" autocomplete="off">

                        <div class="field-wrap">
                            <label>
                                Job Name<span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" name="jname"/>
                        </div>
                        
                        <div class="field-wrap">
                            <label>
                                Company Name<span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" name="cname"/>
                        </div>
                        
                        <div class="field-wrap">
                            <label>
                                Job Description<span class="req">*</span>
                            </label>
                            <textarea rows="12" cols="50" name="jdescription" ></textarea>
                        </div>
                        
                        <div class="field-wrap">
                        <label>Choose Required Proficiencies</label>
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
                        <button type="submit" class="button button-block" name="createjob" />Create Job</button>
                        
                    </form>
                <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/index.js"></script>