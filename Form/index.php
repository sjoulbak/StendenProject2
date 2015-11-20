
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
	<section id="container">
	<section id="formblock">
		<h1 id="stelvraag">Stel uw vraag!</h1>
		<p>Door het formulier hieronder in te vullen kunt u uw vraag of klacht bij ons neerleggen.
			U krijgt meestal binnen 24 uur antwoord, het kan maximaal 5 dagen duren.
		  <form method="post" id="contactForm" action="" name="incidentForm">
			<div class="form">
				<label>Naam</label>
				<input type="text" placeholder="Naam" id="name">
			</div>
			<div class="form">
				<label>Email Adres</label>
				<input type="email" placeholder="Email Adres" id="email">
			</div>
			<div class="form">
					<label>type</label>
					<select id="selectmenu">
						<option value="" disabled selected>Prioriteit</option>
						<option>High</option>
						<option>Medium</option>
						<option>Low</option>
					</select>
			</div>
			<div class="form">
					<label>type</label>
					<select id="selectmenu">
						<option value="" disabled selected>Afdeling</option>
						<option>Afdeling1</option>
						<option>Afdeling2</option>
						<option>Afdeling3</option>
					</select>
			</div>
			<div class="form">
				<label>Onderwerp</label>
				<input type="text" placeholder="Onderwerp" id="name">
			</div>
			<div class="form">
				<label>Toelichting</label>
				<textarea rows="5" placeholder="Toelichting"></textarea>
			</div>
		<br>
			<button id="contactbutton" type="submit">Verstuur</button>
	</form>
	</section>
	<section id="QA">
		<h1 id="stelvraag">Veelgestelde vragen</h1>
		<p>Voor u uw vraag stelt kunt u ook kijken of uw vraag hier tussenstaat.
			Zo voorkom je dat je moet wachten op je vraag!
	  <ul>
	    <li id="question">Wanneer kan ik antwoord verwachten?<i class="fa fa-angle-down"></i></li>
	    <li id="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
				 Maecenas a mattis augue.
				Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
			<li id="question">Wat houdt de prioriteit in en wat vul ik daar in?<i class="fa fa-angle-down"></i></li>
		  <li id="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
					 Maecenas a mattis augue.
					Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
			<li id="question">Hoe weet ik naar welke afdeling mijn probleem moet?<i class="fa fa-angle-down"></i></li>
		  <li id="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
						 Maecenas a mattis augue.
						Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
			<li id="question">Ik kan niet inloggen wat kan ik nu doen?<i class="fa fa-angle-down"></i></li>
			<li id="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
					 Maecenas a mattis augue.
					Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
			<li id="question">Hoe kan ik me afmelden voor de helpservice?<i class="fa fa-angle-down"></i></li>
			<li id="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
					 Maecenas a mattis augue.
						Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
	  </ul>
	</section>
	</section>


</div>
</body>
<?php
require_once('footer.php');
?>
