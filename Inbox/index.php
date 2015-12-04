<?php
session_start();
require_once('header.php');

$conn = mysqli_connect("localhost","root","root", "Ehelp");
if (!$conn) {
  die("Can not Connect:" .mysql_error());
}
$id = $_GET['id'];
$query = "SELECT * FROM Ticket WHERE id = ".$id ;
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);






echo "$test";
?>


<body ng-app="app1" ng-controller="mainController">
<div id="background">
<toolbar-top>
	<md-card id="top_bar"layout="row" class="layout layout-row layout-fill md-default-theme" style=" height: 55px; opacity:0.9; background: #0cc2aa; ">
		<div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">	
      <div id="logo"></div>
      <div id="menu_bar">
        <ul class="menu">
          <li class=""><md-button class="menu_item" href="http://google.com">Home</md-button></li>
          <li class=""><md-button class="menu_item" href="http://google.com">Tickets</md-button></li>
          <li class=""><md-button class="menu_item" href="http://google.com">Help</md-button></li>
        </ul>
      </div>
		</div>
		<div layout="row" layout-align="end center" flex class="flex layout layout-row layout-align-end-center">
			      
        <div id="avatar"></div>
            <div id="username">

        <?php
          echo "Tom Drent";
        ?>
        </div>


      <md-menu md-position-mode="target-right target">


         <!-- Trigger element is a md-button with an icon -->
         <md-button id="more" class="md-icon-button" aria-label="More" ng-click="$mdOpenMenu($event)">
              
<span id="triangle_bottom" class="glyphicon glyphicon-triangle-bottom"></span>
              
          </md-button>

          <md-menu-content >
              <md-menu-item><md-button ng-click="doSomething()" href="logout.php"><md-icon md-svg-icon="svg/ic_account_box_black_24px.svg"></md-icon>My Profile</md-button></md-menu-item>
              <md-menu-item><md-button ng-click="doSomething()" href="logout.php"><md-icon md-svg-icon="svg/ic_settings_black_24px.svg"></md-icon>Settings</md-button></md-menu-item>
              <md-menu-item><md-button ng-click="doSomething()" href="logout.php"><md-icon md-svg-icon="svg/ic_exit_to_app_black_24px.svg"></md-icon>Logout</md-button></md-menu-item>
          </md-menu-content>
        </md-menu>


		</div>
	</md-card>
</toolbar-top>


	<!-- main content -->
	<div id="content"flex ng-view class="flex ng-scope">
    <div id="content_top"><h2>Inbox</h2><span><a href="#" style="color:#0cc2aa;">Home</a>  / <a href=""style="color:#0cc2aa;">Tickets</a> / Inbox</span></div>

</body>
<?php
require_once('footer.php');
?>