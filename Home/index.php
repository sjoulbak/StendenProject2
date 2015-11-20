
<?php
require_once('header.php');
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
    <div id="content_top"><h2>Tickets(9)</h2><span><a href="#" style="color:#0cc2aa;">Home</a>  / Tickets</span></div>
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






      <?php
  $conn = mysqli_connect("localhost","root","root", "Ehelp");           
    if (!$conn) {
      die("Can not Connect:" .mysql_error());
    }

    $query = "SELECT * FROM Ticket" ; 
    $result = mysqli_query($conn, $query);

      
      while ($roww = mysqli_fetch_array($result)) {

        
?>


<?php echo '<a href="../Inbox/index.php?id=' . $roww ['id'] . '">'; ?> 
          
        
            <div class="mails" layout="row">
              <div id="container">
                  <md-checkbox ng-model="data.cb1" aria-label="Checkbox 1">
            
                  </md-checkbox>
                  <span id="envelope" class="glyphicon glyphicon-envelope"></span>
                    
                  <div id="id"><?php echo $roww["id"]; ?></div>

                  <div id="subject"><?php echo $roww["subject"]; ?></div>

                  <div id="department"><?php echo $roww["department"]; ?></div>
                  
                  <div id="priority"><?php echo $roww["priority"]; ?></div>

                  <div id="email"><?php echo $roww["email"]; ?></div>

                  <div id="status"><?php echo $roww["status"]; ?></div>

                  <div id="published"><?php echo $roww["published"]; ?></div>
                  

                  <md-button  class="md-icon-button" aria-label="More" ng-click="$mdOpenMenu($event)">
        
                  <span id="mark" class="glyphicon glyphicon-flag"></span>
                  </md-button>



              </div>   
          </div>
<?php echo "</a>";?>
               
         



          
        
<?php }


?>






































   






	</md-content>

















</div>
</body>
<?php
require_once('footer.php');
?>