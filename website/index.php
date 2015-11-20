
<?php

session_start();

require_once("includes/Core.php");
require_once("includes/Database.php");
require_once("includes/Security.php");
$core = new Core();
$db = new Database();
$db->opendb();
$security = new Security($core, $db);
$user = $security->checksession();
if(!$user){
    $core->loadPage("login.php");
}

if(isset($_GET['logout'])){
    $security->logout();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Ticket-system </title>

    <!-- JQUERY   -->
    <script src="js/jquery.validate.js"></script>
    <script src="js/jquery-1.11.3.js"></script>

    <!-- BOOTSTRAP   -->
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/owfont-regular.min.css" rel="stylesheet">

    <!-- STYLES  -->
    <link href="css/style.css" rel="stylesheet">
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
<toolbar-top>
	<md-card id="top_bar"layout="row" class="layout layout-row layout-fill md-default-theme" style=" height: 55px; opacity:0.9; background: #0cc2aa; ">
		<div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">	
      <div id="logo"></div>
      <div id="menu_bar">
        <ul class="menu">
          <li class=""><md-button class="menu_item" href="?">Home</md-button></li>
          <li class=""><md-button class="menu_item" href="?">Tickets</md-button></li>
          <li class=""><md-button class="menu_item" href="?help">Help</md-button></li>
        </ul>
      </div>
		</div>
		<div layout="row" layout-align="end center" flex class="flex layout layout-row layout-align-end-center">
			      
        <div id="avatar"></div>
            <div id="username">

            <?php
              echo $user['firstname']." ".$user['lastname'];
            ?>
        </div>


      <md-menu md-position-mode="target-right target">


         <!-- Trigger element is a md-button with an icon -->
         <md-button id="more" class="md-icon-button" aria-label="More" ng-click="$mdOpenMenu($event)">
              
<span id="triangle_bottom" class="glyphicon glyphicon-triangle-bottom"></span>
              
          </md-button>

          <md-menu-content >
              <md-menu-item><md-button ng-click="doSomething()" href="?logout"><md-icon md-svg-icon="svg/ic_account_box_black_24px.svg"></md-icon>My Profile</md-button></md-menu-item>
              <md-menu-item><md-button ng-click="doSomething()" href="?logout"><md-icon md-svg-icon="svg/ic_settings_black_24px.svg"></md-icon>Settings</md-button></md-menu-item>
              <md-menu-item><md-button ng-click="doSomething()" href="?logout"><md-icon md-svg-icon="svg/ic_exit_to_app_black_24px.svg"></md-icon>Logout</md-button></md-menu-item>
          </md-menu-content>
        </md-menu>


		</div>
	</md-card>
</toolbar-top>
	<!-- main content -->
	<div id="content"flex ng-view class="flex ng-scope">
    <div id="content_top"><h2>Tickets(<?php echo $user['tickets']; ?>)</h2><span><a href="#" style="color:#0cc2aa;">Home</a> / Tickets</span></div>

      <?php
        if(isset($_GET['view'])){
            require_once("includes/Tickets.php");
            $tickets = new Tickets($core, $db);

            $tickets->view($_GET['view']);
        }else{
            echo '

    <div id="content_center">
      <md-content id="content_center_top" layout="row" class="md-whiteframe-1dp layout-row">
          <div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">

              <span id="content_center_top_setting" class="glyphicon glyphicon-cog"></span>

          </div>
          <div layout="row" layout-align="end center" flex class="flex layout layout-row layout-align-end-center">
              <md-menu md-position-mode="target-right target">
                asd
              </md-menu>
          </div>
      </md-content>

      <md-content style="border-bottom: 1px solid #D9DCDF;" id="content_center_subject" layout="row" class="md-whiteframe-1dp layout-row">
          <div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">
            <div class="inbox_subject" class="md-whiteframe-1dp layout-row">
                <div class="mails" id="inbox_subject2" layout="row">
                  <div id="container">
                      <md-checkbox ng-model="data.cb1" aria-label="Checkbox 1">
                      </md-checkbox>
                      <span id="envelope2" class="glyphicon glyphicon-envelope envelope_transparent"></span>
                      <div id="id">Ticket</div>
                      <div id="subject">Subject</div>
                      <div id="department">Department</div>
                      <div id="priority">Priority</div>
                      <div id="email">Email</div>
                      <div id="status">Status</div>
                      <div id="published">Published</div>
                      <span id="mark2" class="glyphicon glyphicon-flag"></span>
                  </div>
              </div>
            </div>
          </div>
      </md-content>
    <md-content id="inbox" class="md-whiteframe-1dp">
            ';
            $result = $db->doquery("SELECT * FROM {{table}} WHERE user='".$user['id']."' LIMIT 0,20","tickets");
            while($row = mysqli_fetch_array($result)){
                echo '
          <a href="?view=' . $row['id'] . '">
            <div class="mails" layout="row">
              <div id="container">
                  <md-checkbox ng-model="data.cb1" aria-label="Checkbox 1"></md-checkbox>
                  <span id="envelope" class="glyphicon glyphicon-envelope"></span>
                  <div id="id">'.$row["id"].'</div>
                  <div id="subject">'.$row["subject"].'</div>
                  <div id="department">'.$row["department"].'</div>
                  <div id="priority">'.$row["priority"].'</div>
                  <div id="email">'.$row["email"].'</div>
                  <div id="status">'.$row["status"].'</div>
                  <div id="published">'.$row["published"].'</div>
                  <md-button  class="md-icon-button" aria-label="More" ng-click="$mdOpenMenu($event)">
                    <span id="mark" class="glyphicon glyphicon-flag"></span>
                  </md-button>
              </div>
            </div>
          </a>
          ';
            }
            echo '

	</md-content>';
        }

?>
	</md-content>
        <?php

        ?>
</div>
</body>
</html>