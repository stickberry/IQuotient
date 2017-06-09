<?php
  
  if(isset($_SESSION['id']))
    session_start();
  
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
  <link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet"> 

 <!-- Import Google Icon Font--> 
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond" rel="stylesheet"> 
  
</head>
<body>
  
  <!-- Import jQuery and then materialize.js--> 
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

  <div class = "row"> 
      <div class="col s12 header"> <h2 class = "center-align"> <span class = "white-text"> IQuotient </span> </h2> </div>
  </div>

  <nav class ="iq">
    <div class="nav-wrapper">
      <a class="brand-logo center"> Lorem ipsum dolor sit amet </a>
      
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li class="active"><a href="about.html">About</a></li>
      </ul>
      
      <ul id="nav-mobile" class="right hide-on-med-and-down">


      <?php

        if(isset($_SESSION['id'])) {
          //echo $_SESSION['uid'];
          echo "<li><a href = 'logout.php' class ='waves-effect waves-default'>LOG OUT</a></li>";
        } else {
            //echo "not logged in";
            echo "<li><a name = 'login' class='waves-effect waves-default' data-target = 'modal1'>LOGIN</a></li>"; 
        }
      ?> 

        <li><a class="waves-effect waves-default " data-target = "modal2">SIGNUP</a></li>
      </ul>
    
    </div>
  </nav>

  <br/><br/>

  <div class ="container" id="text">

    <?php
      $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if (strpos($url, 'error=mismatch') !== false) {
          echo "<div class='error valign-wrapper'>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Login failed. Incorrect username or password. Try again.</div>";
        } else if(strpos($url, 'login') !== false) {
          echo " <div class='error valign-wrapper'> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Access denied. Login to continue. </div>";
        }
        else if(strpos($url, 'error=username') !== false) {
          echo " <div class='error valign-wrapper'> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Sign up failed. Username already exists. Try again. </div>";
        }
        else if(strpos($url, 'error=email') !== false) {
          echo " <div class='error valign-wrapper'> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Sign up failed. Email already registered. Try again. </div>";
        }
        else if(strpos($url, 'error=pwdmatch') !== false) {
          echo " <div class='error valign-wrapper'>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Sign up failed. Passwords don't match. Try again.</div>";
        }
        else if(strpos($url, 'error=uidlength') !== false) {
          echo " <div class='error valign-wrapper'> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Sign up failed. Username should be atleast 6 characters long. Try again. </div>";
        }
        else if(strpos($url, 'error=pwdlength') !== false) {
          echo " <div class='error valign-wrapper'> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Sign up failed. Password should be atleast 6 characters long. Try again. </div>";
        } else if(strpos($url, 'success') !== false) {
          echo " <div class='error valign-wrapper green-text'> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Sign up successful. Login to continue. </div>";
        }
        else 
            ;
    ?>

    <div class="col s12"> <h3 class = "center-align"> <span class = "black-text"> Welcome </span> </h3> </div>
    
    <p class = "diffont"> IQuotient is an online platform for users to share questions that they think will boost one's thinking skills. You can create and answer various questions and compete with fellow users. We welcome thinkers and problem solvers of all types and ages to create an account and join the community. <br/><br/>

    </div>

  <?php
    include 'modal.php';
  ?>
  
  <script>
    $(document).ready(function(){
      $('.modal').modal(); 
    }); 

     jQuery(function($) {
  $('.btn-login').click(function() {
    var post_url = 'login.php';

    $.ajax({
      type: 'POST',
      url: post_url,
      data: $('#login').serialize(),
      dataType: 'php',
      async: true,
      success: function(data) {
        $('#errorDiv1').append(data);
      }
    });
  })
});
  </script>
  

</body>
</html>﻿
