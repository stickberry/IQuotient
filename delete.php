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
    <li><a class="waves-effect waves-default " href = "change.php">change password</a></li>
    <li><a class="waves-effect waves-default " data-target = "modal4">guide</a></li>
  </ul>
      
  <nav class ="iq2">
    <div class="nav-wrapper">
      <a class="brand-logo center"> Lorem ipsum dolor sit amet </a>
      
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1">HELP<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
      
      <ul id="nav-mobile" class="right hide-on-med-and-down">


      <li><a href = "user.php" class="waves-effect waves-default">DASHBOARD<i class="material-icons left">dashboard</i></a></li>
      <?php

        if(isset($_SESSION['id'])) {
          //echo $_SESSION['id'];
          echo "<li><a href = 'logout.php' class ='waves-effect waves-default'><i class='material-icons left'>power_settings_new</i>LOGOUT</a></li>";
        } else {
           // echo "not logged in";
            echo "<li><a name = 'login' class='waves-effect waves-default' data-target = 'modal1'>LOGIN</a></li>"; 
        }
      ?> 

      </ul>
    
    </div>
  </nav>

  <br><br>
  <section id = "main">
    <div class ="container" id="text2">
      <div class ="row">
        <div class = "col s3">
          <ul class="collection">
            <li class="collection-item white-text" id="stats">QUICKSTATS</li>
            <?php
              include 'stats.php';
            ?>
          </ul>
        </div>
        <div class = "col s9">

          <nav id="options">
            <div class="nav-wrapper">
              <ul class="left hide-on-med-and-down">
                <li><a href="add.php">ADD QUESTION</a></li>
                <li><a href="modify.php">MODIFY QUESTION</a></li>
                <li class="active"><a>DELETE QUESTION</a></li>
              </ul>
            </div>
          </nav>

      <form class ="col s12 form1" action = "do_del.php" method = "POST">
       <div class="row">
        <div class="col s12 center-align" id = "inputtext">
          <span id = "format"> Enter The Question Name : </span>
          <div class="input-field inline">
            <input id="text" type="text" name="qname" class="validate">
            <button class="btn waves-effect waves-light pull-s5" type="submit" name="action">Delete <i class="material-icons right">delete</i></button>

          </div>
        </div>
      </div>

        
    </form>  
  
      
            
              
                
      
        </div>
      </div>
    </div>
  </section>

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
  </script>
  
</body>
</html>﻿
