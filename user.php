<?php
  session_start();

  if(!isset($_SESSION['id'])) {
    header("Location:index.php?login");
    exit();
  }
  include 'dbh.php';
?>

<!DOCTYPE html>
<html lang = "en" >
<head>

  <title> IQuotient </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- Import materialize.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script> 

  <link rel = "stylesheet" href = "style.css">

  <!-- Import Font -->
  <link href="https://fonts.googleapis.com/css?family=Marcellus+SC" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=Simonetta:400i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> 

 <!-- Import Google Icon Font--> 
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
</head>
<body>
  
  <!-- Import jQuery and then materialize.js--> 
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

  <nav class ="head">
    <div class="nav-wrapper">
      <a class="brand-logo center">IQuotient</a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="leader.php"> leaderboard <i class="material-icons left">equalizer</i></a></li>
      </ul>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php
        include 'display_name.php';
      ?>
      </ul>
    </div>
  </nav>
  
  <!--  Dropdown Content -->
  <ul id="dropdown1" class="dropdown-content"> 
    <li><a href = "change.php" class="waves-effect waves-default " >change password</a></li>
    <li><a class="waves-effect waves-default " data-target = "modal4">guide</a></li>
  </ul>
      
  <nav class ="iq2">
    <div class="nav-wrapper">
      <a class="brand-logo center"> Lorem ipsum dolor sit amet </a>
      
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1">HELP<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
      
      <ul id="nav-mobile" class="right hide-on-med-and-down">


      <li><a class="waves-effect waves-default active" >DASHBOARD<i class="material-icons left">dashboard</i></a></li>
      <?php

        if(isset($_SESSION['id'])) {
          //echo $_SESSION['uid'];
          echo "<li><a href = 'logout.php' class ='waves-effect waves-default'><i class='material-icons left'>power_settings_new</i>LOGOUT</a></li>";
        } else {
           // echo "not logged in";
            echo "<li><a name = 'login' class='waves-effect waves-default' data-target = 'modal1'>LOGIN</a></li>"; 
        }
      ?> 

      </ul>
    
    </div>
  </nav>

  <br/><br/>

  <div class ="container">


    <div class="col s12"> 
   
    <?php
      include 'dbh.php';
      $users = "SELECT * FROM question ORDER BY date DESC";
      $result = mysqli_query($conn, $users);
      $isempty = true;
      $counter = 0;

      $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      echo "";
      if (strpos($url, 'error=opt') !== false) {
        echo "<div class = 'container' id = 'text3'>
                <div class = 'valign-wrapper error red-text'> 
                   &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Invalid Answer.
                </div>
              </div>";
      } else if (strpos($url, 'correct') !== false) {
        echo "<div class = 'container' id = 'text3'>
                <div class = 'valign-wrapper error green-text'> 
                   &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Correct Answer. +10 points.
                </div>
              </div>";
      } else if (strpos($url, 'wrong') !== false) {
        echo "<div class = 'container' id = 'text3'>
                <div class = 'valign-wrapper error red-text'> 
                   &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Wrong Answer. -3 points.
                </div>
              </div>";
      } else {
          ;
      }
      echo "</div>"; 

      function display($result){
        global $isempty;
        while($row = mysqli_fetch_assoc($result)) {
          $isempty = false;
          global $counter;
          $counter = $counter + 1;
          // Print "Name: ".$row['uid'] . " "; 
          echo "  <ul class='collapsible' data-collapsible='expandable'> 
                   <li id = 'post'>
                      <div class='collapsible-header'><span id ='heading'>".$counter.'.'.' '.$row['qname']."</span><span id = 'author'>".' ' ."by ".$row['username']."</span>
                       <span class = 'rightside'>Solved by :&emsp;".$row['solved']."</span></div>
                      <div class='collapsible-body'>
                        <span id = 'bbody'>".$row['ques']."</span> 
                        <form action='check.php' method = 'POST'>
                          <ul>
                            <br>
                            <li>1.".' '."  &emsp;".$row['opt1']."</li>
                            <li>2.".' '."  &emsp;".$row['opt2']."</li>
                            <li>3.".' '."  &emsp;".$row['opt3']."</li>
                            <li>4.".' '."  &emsp;".$row['opt4']."</li>
                          </ul>
                          <br>
                           <div class='row'>
                            <div class ='hid'>
                            <input id='qname' value = '".$row['qname']."' name = 'qname' type='text' class='validate'>
                            </div>
                            <div class='col s12'>
                                Your Answer : 
                                <div class='input-field inline'>";
                                    include 'dbh.php';
                                    $idd = $_SESSION['id'];
                                    $qname1 = $row['qname'];
                                    $sql1 = "SELECT uid from user WHERE id='$idd'";
                                    $result1 = mysqli_query($conn, $sql1);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $username = $row1['uid'];  //logged in 

                                    $sql2 = "SELECT username from question WHERE qname='$qname1'";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    $quid = $row2['username'];  // question maker

                                    $sql3 = "SELECT * FROM correct WHERE quname='$qname1' AND usid='$username'";
                                    $result3 = mysqli_query($conn, $sql3);
                                    $done = mysqli_num_rows($result3);

                                    $sql4 = "SELECT username from question WHERE qname='$qname1'";
                                    $result4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($result4);
                                    $quid = $row4['username'];

                                    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                                    if( $quid == $username ) {
                                      echo "
                                      <input id='disabled' disabled value = 'Your question.' name = 'ans' type='text' class='validate' required>
                                      <label for='ans'></label>
                                      </div>";
                                    }
                                    else if($done>0) {
                                      echo "
                                      <input id='disabled' disabled value = 'You have already answered.' name = 'ans' type='text' class='validate' required>
                                      <label for='ans'></label>
                                      </div>";
                                    }
                                    else {
                                      echo " <input id='ans' name = 'ans' type='text' class='validate' required>
                                      <label for='ans'></label>
                                      </div>
                                      <div class ='vert green-text'>
                                        &emsp; ";
                                        echo "<button class='btn waves-effect waves-light inline' type='submit' name='action' value = 'submit' id = 'up'>SUBMIT </button>
                                      </div>";
                                    }
                                    echo " </div>
                                    </div>
                    
                                </form>
                            </div>
                        </li>
                    </ul> ";
                  } 
                }

       display($result);
      if($isempty == true) {
        echo "<p> empty</p>";
      }
    
    ?>
     
    </div>

  </div>

  <?php
    include 'modal.php';
  ?>

  <script>

   $(document).ready(function(){
      $('.modal').modal(); 
    }); 

    (function($) {
      $(function() {
        $('.dropdown-button').dropdown({
          inDuration: 300,
          outDuration: 225,
          hover: true, // Activate on hover
          belowOrigin: true, // Displays dropdown below the button
          alignment: 'right' // Displays dropdown with edge aligned to the left of button
        });
      }); // End Document Ready
    })(jQuery); // End of jQuery name space

     
  $(document).ready(function() {
    Materialize.updateTextFields();
  });
  </script>

</body>
</html>﻿
