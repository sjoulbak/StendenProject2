<?php
session_start();

require_once("includes/Core.php");
require_once("includes/Database.php");
require_once("includes/Security.php");
$core = new Core();
$db = new Database();
$db->opendb();
$security = new Security($core, $db);
$user = false;
if($security->checksession()){
    $core->loadPage("index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Ticket system </title>
    <!-- JQUERY   -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script>
        window.onload = function() {
            document.getElementById('toggleProfile').addEventListener('click', function () {
                [].map.call(document.querySelectorAll('.profile'), function(el) {
                    el.classList.toggle('profile--open');
                });
            });
        };
    </script>
    <!--Google Font - Work Sans-->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <!-- BOOTSTRAP   -->
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/owfont-regular.min.css" rel="stylesheet">
    <!-- STYLES  -->
    <link href="css/login.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://gitcdn.xyz/repo/angular/bower-material/v0.11.0/angular-material.css">

    <!-- ANGULAR -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-animate.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-route.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-aria.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-messages.min.js"></script>
    <script src="//material.angularjs.org/latest/angular-material.min.js"></script>

    <script src="js/app.js"></script>


    <!-- SCRIPTS  -->
    <script type="text/javascript" src="js/script.js"></script>
</head>

<body ng-app="app1" ng-controller="mainController">
    <div id="background">
        <div class="container">
            <div class="profile profile--open">
                <button class="profile__avatar" id="toggleProfile">
                    <img src="https://pbs.twimg.com/profile_images/554631714970955776/uzPxPPtr.jpeg" alt="Avatar" />
                </button>
                <div class="profile__form">
                    <div class="profile__fields">
                        <form id="ajax" class="form-signin" action=" " method="post" name="userForm">
                            <?php
                                if(isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmpassword'])){
                                    $errors = $security->checkRegister($_POST['name'], $_POST['lastname'], $_POST['username'], $_POST['password'], $_POST['confirmpassword']);
                                    if($errors != null){
                                        echo $errors;
                                    } else {
                                      $security->checkLogin($_POST['username'], $_POST['password']);
                                    }
                                }
                            ?>
                            <md-input-container style = "width:225px;">
                                <label type="text" for="name">Naam</label>
                                <input id="#name" class="form-styling" type="text" name="name" ng-model="name" required/>
                            </md-input-container>
                            <md-input-container style = "width:225px;">
                                <label type="text" for="lastname">Achternaam</label>
                                <input id="#lastname" class="form-styling" type="text" name="lastname" ng-model="lastname" required/>
                            </md-input-container>
                            <md-input-container style = "width:225px;">
                                <label type="text" for="username">Gebruikersnaam</label>
                                <input id="#username" class="form-styling" type="text" name="username" ng-model="username" required/>
                            </md-input-container>
                            <md-input-container style = "width:225px;">
                                <label type="password" for="password">Wachtwoord</label>
                                <input id="#password" class="form-styling" type="password" name="password" ng-model="password" required/>
                            </md-input-container>
                            <md-input-container style = "width:225px;">
                                <label type="confirmpassword" for="confirmpassword">Nogmaals Wachtwoord</label>
                                <input id="#confirmpassword" class="form-styling" type="password" name="confirmpassword" ng-model="confirmpassword" required/>
                            </md-input-container>

                            <div id="row_login" layout="row" layout-align="center center">


                                <md-button   type="submit" ng-disabled="userForm.name.$error.required || userForm.lastname.$error.required || userForm.username.$error.required || userForm.password.$error.required || userForm.confirmpassword.$error.required" class="md-raised circular-progress-button md-warn" >
                                    Register
                                </md-button>

                                <!-- <md-checkbox id="remember" ng-disabled="userForm.name.$error.required || userForm.lastname.$error.required || userForm.username.$error.required || userForm.password.$error.required || userForm.confirmpassword.$error.required" ng-model="data.cb1" aria-label="Checkbox 1">
                                    Remember

                                </md-checkbox><br> -->

                                <div class="login">
                                  <a href="./login.php">Login</a>
                                </div>
                                <input class="form-styling" type="hidden" name="remember" ng-model="remember" placeholder="{{ data.cb1 }}" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $core->checkLoad();
    ?>
</body>
</html>
