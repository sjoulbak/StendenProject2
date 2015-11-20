<?php
include_once('functions.php');
require_once('header.php');
?>


<body ng-app="app1" ng-controller="mainController">
<div id="background">
<div class="container">
  <div class="profile">
    <button class="profile__avatar" id="toggleProfile">
     <img src="https://pbs.twimg.com/profile_images/554631714970955776/uzPxPPtr.jpeg" alt="Avatar" /> 
    </button>
    <div class="profile__form">
      <div class="profile__fields">
        <form id="ajax" class="form-signin" action=" " method="post" name="userForm">
          <md-input-container style = "width:225px;">
            <label type="text" for="username">Username</label>
            <input id="#username" class="form-styling" type="text" name="username" ng-model="username" required/>
          </md-input-container>
          <md-input-container style = "width:225px;">
            <label type="password" for="password">Password</label>
            <input id="#password"class="form-styling" type="password" name="password" ng-model="password" required/>
          </md-input-container>

          <div id="row_login" layout="row" layout-align="center center">


            <md-button   type="submit" ng-disabled="userForm.username.$error.required || userForm.password.$error.required " class="md-raised circular-progress-button md-warn" >
              Login
            </md-button>

                  <md-checkbox id="remember" ng-disabled="userForm.username.$error.required || userForm.password.$error.required " ng-model="data.cb1" aria-label="Checkbox 1">
                    Remember
        
        		</md-checkbox>
        		<input class="form-styling" type="hidden" name="remember" ng-model="remember" placeholder="{{ data.cb1 }}" />


          </div>

      
          </div>
     
              </form> 
      <?php
        if($_POST){
           $username = $_POST['username'];
           $password = md5($_POST['password']);
           $conn = mysqli_connect("localhost","root","root", "Ehelp");
          
           if (!$conn) {
            die("Can not Connect:" .mysql_error());
          }
           $query = "SELECT * FROM login WHERE username = '$username' AND password ='$password'"; 
           $result = mysqli_query($conn, $query);
            if ($result) {
              $row = mysqli_fetch_array($result);
            }
            if ($username == $row["username"] & $password == $row["password"]) {
              $_SESSION['username'] = $username;
              $_SESSION['id'] = $userId;
              $_SESSION['time']   = time();
              ?>
                <script>window.location = "../Home/index.php";</script>
              <?php
              exit();
            }
            else{
              echo "Username and or password incorrect.";
            }
          }
      ?>
      </div>
     </div>
  </div>
</div>
</div>
</body>
<?php
require_once('footer.php');
?>