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
    <li><a href = "change.php" class="waves-effect waves-default ">change password</a></li>
    <li><a class="waves-effect waves-default " data-target = "modal4">guide</a></li>
  </ul>
      
  <nav class ="iq2">
    <div class="nav-wrapper">
      <a class="brand-logo center"> Lorem ipsum dolor sit amet </a>
      
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1">HELP<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
      
      <ul id="nav-mobile" class="right hide-on-med-and-down">


      <li><a href = "user.php" class="waves-effect waves-default" >DASHBOARD<i class="material-icons left">dashboard</i></a></li>
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

  <br/>
  <div class="container error2">
  <?php
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          if (strpos($url, 'error=old') !== false) {
            echo "<div class='error valign-wrapper'> &emsp;&emsp;&emsp;&emsp;&emsp; Invalid current password. Try again.</div>";
          }
          else if(strpos($url, 'error=new') !== false) {
            echo " <div class='error valign-wrapper'> &emsp;&emsp;&emsp; Error in confirming new password. Try again. </div>";
          }
          else if(strpos($url, 'error=length') !== false) {
            echo " <div class='error valign-wrapper'> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Invalid password length. Try again. </div>";
          }
          else if(strpos($url, 'success') !== false) {
            echo " <div class='error valign-wrapper green-text'>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Password changed.</div>";
          }
  ?>
  </div>
  <br/>

  <div class ="container" id = "changepwd">
    <div class='col s12'>
      <br>
      <h4 class = 'center-align'> <span id = "cpwd" class = 'black-text'> Change Password </span> </h4> 
    </div>
      
    <div class='row'>
      <br>

      <form action='change_pwd.php' method='POST' class='col s12' id = 'change'>    
        <div class='row'>
          <?php $idd = $_SESSION['id'];

            $sql = "SELECT uid from user WHERE id='$idd'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $username = $row['uid'];
            echo "<div class='input-field col s9 offset-s1' id = 'first_field'>
              <i class='material-icons prefix '>account_circle</i>
              <input id='disabled' disabled value = '".$username."' type='text' class='validate' name = 'uid' required>
                <label for='icon_accounts_circle'>Username</label>
              </div>"; 
          ?>
          <div class='input-field col col s9 offset-s1'>
            <i class='material-icons prefix'>lock_outline</i>
            <input id='icon_lock_outline' type='password' class='validate' name = 'pwd' required>
            <label for='icon_lock_outline'>Current Password</label>
          </div>
        </div>

        <div class='row'>
          <div class='input-field col col s9 offset-s1'>
            <i class='material-icons prefix'>lock</i>
            <input id='icon_lock_outline' type='password' class='validate' name = 'npwd' required>
            <label for='icon_lock_outline'> New Password</label>
          </div>
        </div>
             
        <div class='row'>
          <div class='input-field col col s9 offset-s1'>
            <i class='material-icons prefix'>lock</i>
            <input id='icon_lock' type='password' class='validate' name='ncpwd' required>
            <label for='icon_lock'>Confirm New Password</label>
          </div>
        </div>
              
        <div class = 'row'>
          <button class='btn waves-effect waves-light col s10 offset-s1' type='submit' name='action' id='submit-button'>CHANGE PASSWORD</button>
        </div>
        <br>  
      </form> 
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
