
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
}else{
    if($user['role'] != 1){
        $core->loadPage("index.php");
    }
}

if(isset($_GET['logout'])){
    $security->logout();
}



?>


<!doctype html>
<html>
<head>
    <title>Ticket indienen</title>
    <link rel="stylesheet" href="../noAngular/css/new_ticket.css"/>
</head>
    <body>
        <div id="form-main">
            <div id="form-div">
                <form class="form" id="form1">
                    <h2>Ticket toevoegen</h2>
                    <a class="logout" href="ticket.php?logout">Loguit</a>
                    <p class="subject">
                        <input name="subject" type="text" class="feedback-input" placeholder="Onderwerp" id="subject" />
                    </p>
                    <p class="message">
                        <textarea name="message" class="feedback-input" id="message" placeholder="Message"></textarea>
                    </p>
                    <p class="department">
                        <input name="department" type="text" class="feedback-input" placeholder="Department" id="department" />
                    </p>
                    <p class="priority">
                        <input name="priority" type="text" class="feedback-input" placeholder="Priority" id="priority" />
                    </p>
                    <p class="email">
                        <input name="email" type="text" class="feedback-input" id="email" placeholder="Email" />
                    </p>
                    <div class="submit">
                        <input type="submit" value="SEND" id="button-blue"/>
                        <div class="ease"></div>
                    </div>
                </form>
            </div>
        </div>
        <?php
            $core->checkLoad();
        ?>
    </body>
</html>
