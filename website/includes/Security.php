<?php
/**
 * Created by PhpStorm.
 * User: Alwin
 * Date: 6-7-2015
 * Time: 13:13
 */


class Security{

    private $db;
    private $core;

    public function __construct(Core $core, Database $db){
        $this->db = $db;
        $this->core = $core;
    }

    public function checksession(){

        $row = false;

        if (isset($_SESSION['ticket-system'])) {
            $theuser = explode("//", $_SESSION['ticket-system']);
            $query = $this->db->doquery("SELECT * FROM {{table}} WHERE username='$theuser[0]' AND password='$theuser[1]'", "users");

            if (mysqli_num_rows($query) != 1) {
                die("Er is iets mis met de sessions (Error 1).");
                unset($_SESSION['ticket-system']);
            }
            $row = mysqli_fetch_array($query);
        }

        return $row;
    }
    public function logout(){

        unset($_SESSION['ticket-system']);
        $this->core->loadPage("login.php");
    }
    public function checkLogin($user, $pass){
        $user = $this->db->esc_str($user);
        $pass = $this->db->esc_str($pass);

        $query = $this->db->doquery("SELECT * FROM {{table}} WHERE username='$user' AND password='".$this->makePass($pass, $user)."'", "users");

        if (mysqli_num_rows($query) != 1) {
            return 'Verkeerde gebruikersnaam of wachtwoord.';
        }else{
            $_SESSION['ticket-system'] = $user."//".$this->makePass($pass, $user);
            $this->core->loadPage("index.php");
        }
        return null;
    }
   public function checkRegister($firstname, $lastname, $username, $password1, $password2){
       $username = $this->db->esc_str($username);
       $firstname = $this->db->esc_str($firstname);
       $lastname = $this->db->esc_str($lastname);
       $password1 = $this->db->esc_str($password1);
       $password2 = $this->db->esc_str($password2);



       $query = $this->db->doquery("SELECT * FROM {{table}} WHERE username='$username'", "users");

       if (mysqli_num_rows($query) > 0) {
           return 'Dit gebruikersnaam is bij ons al geregistreerd.';
       }

       $err = [];
       if(strlen($firstname) < 2){$err[] = "Voornaam is niet lang genoeg.";}
       if(strlen($lastname) < 2){$err[] = "Achternaam is niet lang genoeg.";}
       if(strlen($password1) < 2){$err[] = "Wachtwoord is niet lang genoeg.";}
       if($password1 != $password2){$err[] = "Wachtwoorden komen niet overeen.";}

       if(count($err) != 0){
           $error = "";
           foreach($err as $val){
               $error .= $val."<br />";
           }
           return $error;
       }

       $pass = $this->makePass($password1, $username);

       $query = $this->db->doquery("INSERT INTO {{table}} SET username='$username', firstname='$firstname', lastname='$lastname', password='$pass', role=1 ","users");

      //  $_SESSION['alfa-workshops'] = $username."//".$pass;
      //  $this->core->loadPage("index.php");


       return null;
   }

    public function makePass($pass, $user){
        return md5($pass.$user);
    }


}
