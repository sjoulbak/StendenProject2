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



function menuItems($items){

    $menu = [
        "home" => [
            "text" => "Home",
            "link" => "?",
        ],
        "tickets" => [
            "text" => "Tickets",
            "link" => "?",
        ],
        "newTicket" => [
            "text" => "Nieuwe ticket",
            "link" => "?newTicket",
        ],
    ];
    for($i=0;$i<count($items);$i++){
        echo '<li class=""><md-button class="menu_item" href="'.$menu[$items[$i]]['link'].'">'.$menu[$items[$i]]['text'].'</md-button></li>';
    }
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
    <link rel="stylesheet" type="text/css" href="https://gitcdn.xyz/repo/angular/bower-material/v0.11.0/angular-material.css">
    <link href="css/style.css" rel="stylesheet">


    <?php


        if(isset($_GET['view'])){
            echo '<link href="css/tickets.css" rel="stylesheet">';
        }
    ?>


    <!-- ANGULAR -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-animate.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-route.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-aria.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-messages.min.js"></script>
    <script src="//material.angularjs.org/latest/angular-material.min.js"></script>

    <script src="js/app.js"></script>



</head>

<body ng-app="app1" ng-controller="mainController">
<div id="background">
<toolbar-top>
	<md-card id="top_bar"layout="row" class="layout layout-row layout-fill md-default-theme" style=" height: 55px; opacity:0.9; background: #0cc2aa; ">
		<div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">	
      <div id="logo"></div>
      <div id="menu_bar">
        <ul class="menu">
            <?php
                // home, tickets, newTickets
                if($user['role'] == 1){
                    menuItems(["newTicket"]);
                }else{
                    menuItems(["home","tickets","newTicket"]);
                }
            ?>

<!--          <li class=""><md-button class="menu_item" href="?">Tickets</md-button></li>-->
<!--            <li class=""><md-button class="menu_item" href="?help">Help</md-button></li>-->
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
      echo $security->makePass("marijn", "marijn");
        if(isset($_GET['view'])){

            require_once("includes/Tickets.php");
            $tickets = new Tickets($core, $db, $user);
            $tickets->view($_GET['view']);
        }elseif(isset($_GET['delete'])){

            require_once("includes/Tickets.php");
            $tickets = new Tickets($core, $db, $user);
            $tickets->delete($_GET['delete']);
            $tickets->getAll();

        }elseif(isset($_GET['newTicket'])){

            require_once("includes/Tickets.php");
            $tickets = new Tickets($core, $db, $user);
            $tickets->newTicket();

        }else{

            require_once("includes/Tickets.php");
            $tickets = new Tickets($core, $db, $user);
            $tickets->getAll();
        }

?>
	</md-content>
        <?php
            $core->checkLoad();
        ?>
</div>
</body>
</html>