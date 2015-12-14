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
            "text" => "Tickets",
            "link" => "?",
        ],
        "newTicket" => [
            "text" => "Nieuwe ticket",
            "link" => "?newTicket",
        ],
    ];
    for($i=0;$i<count($items);$i++){
        echo '<li><a href="'.$menu[$items[$i]]['link'].'">'.$menu[$items[$i]]['text'].'</a></li>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/base.css" />


    <script src="js/new-ticket.js" ></script>


</head>
<body>
    <header class="main">
        <img src="images/logo.jpg" class="logo" />
        <ul class="head-menu">
            <?php
            // home, tickets, newTickets
                if($user['role'] == 1){
                    menuItems(["newTicket"]);
                }else{
                    menuItems(["home","newTicket"]);
                }
            ?>
        </ul>
        <div class="account">
            <div class="account-img" style="background-image: url('images/women.jpg');"></div>
<!--            <img src="" class="account-img" />-->
            <div id="acc-select">
                <a class="name">Alwin Kroesen <i class="fa fa-caret-down"></i></a>
                <ul>
                    <li><a href="#item1">Account informatie</a></li>
                    <li><a href="#item5">Instellingen</a></li>
                    <li><a href="?logout">Uitloggen</a></li>
                </ul>
            </div>
        </div>
    </header>
    <section>
        <article>
            <h1>Tickets(9)</h1>
            <span class="breadcrumb">
                <a href="#home">Home</a> / Tickets
            </span>
                    <?php
                    //      echo $security->makePass("marijn", "marijn");
                        if(isset($_GET['view'])){

                            require_once("includes/Tickets.php");
                            $tickets = new Tickets($core, $db, $user);
                            $tickets->view($_GET['view']);

                        }elseif(isset($_GET['delete'])){

                            require_once("includes/Tickets.php");
                            $tickets = new Tickets($core, $db, $user);
                            $tickets->delete($_GET['delete']);
                            $tickets->getAll();

                        }elseif(isset($_GET['edit'])){

                            require_once("includes/Tickets.php");
                            $tickets = new Tickets($core, $db, $user);
                            $tickets->edit($_GET['edit']);

                        }elseif(isset($_GET['working_on'])){

                            require_once("includes/Tickets.php");
                            $tickets = new Tickets($core, $db, $user);
                            $tickets->workingOn($_GET['working_on']);

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
        </article>
    </section>

    <script>
        var account_show_menu = false;
        document.querySelector("#acc-select a").onclick = function (){
            var accountClass = account_show_menu ? "" : "show";
            document.getElementById("acc-select").setAttribute("class", accountClass);
            account_show_menu = !account_show_menu;
        };
        function changeCheck(a){
            var classes = a.getAttribute("class");
            if(classes.indexOf("fa-square-o") < 0){
                classes = classes.replace("fa-check-square-o","fa-square-o");
            }else{
                classes = classes.replace("fa-square-o","fa-check-square-o");
            }
            a.setAttribute("class", classes);
        }
        function changeCheckAll(a){
            var classes = a.getAttribute("class");
            var allChecks = document.getElementsByClassName("checkBox");
            if(classes.indexOf("fa-square-o") < 0){
                for(var i=0;i < allChecks.length;i++){
                    allChecks[i].setAttribute("class", allChecks[i].getAttribute("class").replace("fa-check-square-o","fa-square-o") );
                }
            }else{
                for(var i=0;i < allChecks.length;i++){
                    allChecks[i].setAttribute("class", allChecks[i].getAttribute("class").replace("fa-square-o","fa-check-square-o") );
                }

            }
        }
    </script>
    <?php
        $core->checkLoad();
    ?>

</body>
</html>