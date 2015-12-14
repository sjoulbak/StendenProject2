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
if(isset($_GET['deleteAll'])){
    $items = explode(",",$_POST['items']);
    foreach($items as $v){
        if($user['role'] == 2){
            $db->doquery("DELETE FROM {{table}} WHERE id='".$v."'","tickets");
            echo true;
        }elseif($user['role'] == 1){
            $q = $db->doquery("SELECT working_on FROM {{table}} WHERE id='".$v."' AND working_on='".$user['id']."'","tickets");
            if(mysqli_num_rows($q) > 0){
                $db->doquery("DELETE FROM {{table}} WHERE id='".$v."'","tickets");
                echo true;
            }else{
                echo "Assign ticket first to you.";
            }
        }else{
            $q = $db->doquery("SELECT user FROM {{table}} WHERE id='".$v."' AND user='".$user['id']."'","tickets");
            if(mysqli_num_rows($q) > 0){
                $db->doquery("DELETE FROM {{table}} WHERE id='".$v."'","tickets");
                echo true;
            }else{
                echo "Not you're ticket.";
            }
        }
    }

    $core->checkLoad();
    die();
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
                menuItems(["home","newTicket"]);
            ?>
        </ul>
        <div class="account">
            <div class="account-img" style="background-image: url('images/women.jpg');"></div>
<!--            <img src="" class="account-img" />-->
            <div id="acc-select">
                <a class="name"><?php echo $user['firstname']." ".$user['lastname']; ?> <i class="fa fa-caret-down"></i></a>
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
                    <?php
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

        var check_menu = false;
        function changeCheck(a){
            var classes = a.getAttribute("class");
            if(classes.indexOf("fa-square-o") < 0){
                classes = classes.replace("fa-check-square-o","fa-square-o");
            }else{
                check_menu = true;
                classes = classes.replace("fa-square-o","fa-check-square-o");
            }
            a.setAttribute("class", classes);
            needMenuForCheck();
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
            changeCheck(a);
            needMenuForCheck();
        }
        var deleteAllButton = document.getElementById("deleteAll");
        function needMenuForCheck(){
            var allChecks = document.getElementsByClassName("checkBox");
            check_menu = false;
            for(var i=0;i < allChecks.length;i++){
                if(allChecks[i].getAttribute("class").indexOf("fa-square-o") < 0){
                    check_menu = true;
                }
            }
            if(check_menu){
                deleteAllButton.style.display = "inline-block";
            }else{
                deleteAllButton.style.display = "none";
            }
        }
        deleteAllButton.onclick = function(){

            var allChecks = document.getElementsByClassName("checkBox");
            check_menu = false;
            var delItems = "";
            var items = {};
            for(var i=0;i < allChecks.length;i++){
                if(allChecks[i].getAttribute("class").indexOf("fa-square-o") < 0){
//                    removeEl(allChecks[i].parentNode.parentNode);
                    items[i] = allChecks[i].parentNode.parentNode;
                    delItems += allChecks[i].parentNode.parentNode.dataset.id+",";
//                    console.log(allChecks[i]);
                }else{
//                    console.log(allChecks[i]);
                }
            }
//            console.log(delItems);
            for(var item in items){
                removeEl(items[item]);
            }
            if(delItems.length > 0){
                ajax("POST","?deleteAll", {
                    items: delItems
                });
            }
            if(check_menu){
                deleteAllButton.style.display = "inline-block";
            }else{
                deleteAllButton.style.display = "none";
            }
        };
        function ajax(method, url, data=false){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange=function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    return xhttp.responseText;
                }
            };
            xhttp.open(method, url, true);
            if(data != false){
                var d = new FormData();
                for(var key in data) {
                    d.append(key, data[key]);
                }
                xhttp.send(d);
            }else{
                xhttp.send();
            }
        }
        function removeEl(el){
            el.parentNode.removeChild(el);
        }

    </script>
    <?php
        $core->checkLoad();
    ?>

</body>
</html>
