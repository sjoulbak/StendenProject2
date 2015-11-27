<?php
/**
 * Created by PhpStorm.
 * User: Alwin
 * Date: 27-11-2015
 * Time: 09:27
 */

?>

<html>
<head>
    <title>MakePassword</title>
</head>
<body>
    <form action="makePass.php" method="post">
        <input type="text" name="user" placeholder="Gebruikersnaam" /><br />
        <input type="password" name="pass" placeholder="Wachtwoord" /><br />
        <input type="submit" name="makePass" value="Maak Wachtwoord" /><br />
        <?php
            if(isset($_POST['makePass'])){
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                echo 'Wachtwoord: <input type="text" value="'.md5($pass.$user).'" />';
            }
        ?>
    </form>
</body>
</html>
