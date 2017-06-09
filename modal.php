  <!--  Login modal   -->
  <div id='modal1' class='modal'> 
    
    <div class='modal-content'>
      <div class='col s12'> <h4 class = 'center-align'> <span class = 'black-text'> Login </span> </h4> </div>
      <p id = 'desc' class = 'center-align'>Login here to continue</p> 
    </div>

    <div class='row'>
      <form class='col s12' action = 'login.php' method='POST'>
        <div class='row'>
          <div class='input-field col s12' id = 'first_field'>
            <i class='material-icons prefix '>account_circle</i>
            <input id='username' type='text' class='validate' name='uid' required>
            <label for='text'>Username</label>
          </div>

          <div class='input-field col s12'>
            <i class='material-icons prefix'>lock</i>
            <input id='password' type='password' class='validate' name='pwd' required>
            <label for='icon_telephone'>Password</label>
          </div>
        </div>
        
        <div class = 'row modal-footer'>
          <button class='btn waves-effect waves-light col s12 modal-action' type='submit' name='action'>LOGIN NOW</button>
        </div>      
      </form>
    </div>
  </div> 
 
  <!-- Sign up modal -->
  <div id='modal2' class='modal'> 
    <div class='modal-content'>
      <div class='col s12'> <h4 class = 'center-align'> <span class = 'black-text'> SignUp </span> </h4> </div>
      <p id = 'desc' class = 'center-align'>SignUp here to continue</p>
    </div>
    
    <div class='row'>
      <form action='signup.php' method='POST' class='col s12'>
        
        <div class ='row' id = "field1">
          <div class='input-field col s6'>
            <i class='material-icons prefix'>person</i>
            <input id='first' type='text' class='validate' name = 'first' required>
            <label for='icon_lock_outline'>First Name</label>
          </div>
       
          <div class='input-field col s6'>
            <i class='material-icons prefix'>person</i>
            <input id='last' type='text' class='validate' name='last' required>
            <label for='icon_lock'> Last Name</label>
          </div>
        </div>

        <div class='row'>
          <div class='input-field col s12' id = 'first_field'>
            <i class='material-icons prefix '>account_circle</i>
            <input id='uid' type='text' class='validate' name = 'uid' placeholder="Minimum 6 characters" required>
            <label for='icon_accounts_circle'>Username</label>
          </div> 
        </div>
    
        <div class = 'row'>
          <div class='input-field col s12' id = 'first_field'>
            <i class='material-icons prefix'> mail</i>
            <input id='email' type='email' class='validate' name = 'email' required>
            <label for='email' data-error='Incorrect Email ID' data-success=' ' >Email Id</label>
          </div>
        </div>
    
        <div class ='row'>
          <div class='input-field col s6'>
            <i class='material-icons prefix'>lock_outline</i>
            <input id='pwd' type='password' class='validate' name = 'pwd' placeholder="Minimum 6 characters" required>
            <label for='icon_lock_outline'>Password</label>
          </div>
       
          <div class='input-field col s6'>
            <i class='material-icons prefix'>lock_outline</i>
            <input id='pwd' type='password' class='validate' name = 'cpwd' placeholder="Minimum 6 characters" required>
            <label for='icon_lock_outline'>Confirm Password</label>
          </div>
        </div>

        <div class = 'row modal-footer'>
          <button class='btn waves-effect waves-light col s6 pull-s3 modal-action' id="sign_up" type='submit' name='action'>SIGN UP</button>
        </div>

      </form> 
    </div>
  </div>


  <!-- Guide -->

  <div id="modal4" class="modal">
    <div class="modal-content">
        <h4>Here's Help!</h4>
        <p id = 'guide'><i class = "material-icons"></i>&emsp;&emsp;&emsp;Create New Question : Your profile -> Add Question <br>
         &emsp;&emsp;&emsp;Modify Existing Question : Your profile -> Modify Question <br>
         &emsp;&emsp;&emsp;Delete Question : Your profile -> Delete Question </p>
        <h4> scoring : </h4>
        <p id = 'guide'> 
          &emsp;&emsp;&emsp; Each correct answer : <strong> +10 points </strong> <br>
          &emsp;&emsp;&emsp; Each incorrect attempt : <strong> -3 points </strong> <br>
        </p>
        <h4> note: </h4>
          <p id = 'guide'> &emsp;&emsp;&emsp;1. You can only delete/modify questions that <strong> you added</strong>. <br>
              &emsp;&emsp;&emsp;2. You <strong> cannot </strong> modify the question name. (Alt : Delete and add again to change the question name)<br>
              &emsp;&emsp;&emsp;3. The usernames of only those users with <strong> non zero </strong> score will be displyed in the leaderboard.
          </p>
    </div>
    <div class="modal-footer" id = "foot">
      <a class="modal-action modal-close waves-effect waves-green btn-flat btn"><span class ="white-text">Thanks <i class=" medium material-icons">mood</i> </span></a>
    </div>
  </div>
