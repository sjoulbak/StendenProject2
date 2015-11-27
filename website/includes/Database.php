<?php
/**
 * Created by PhpStorm.
 * User: Alwin
 * Date: 3-3-2015
 * Time: 15:50
 */

class Database{

    private $dbsettings = Array(
        //Dit moet aangepast worden.

        "server"        => "localhost",	// MySQL server naam.
        "user"          => "root",		// MySQL gebruikersnaam.
        "pass"          => "root",			// MySQL wachtwoord.
        "name"          => "school",	// MySQL database naam.
        "prefix"        => "ts");	    // Eerste deel van tabellen. ts = ticket-system

    private $mysqli;
    public function opendb() { // Maakt connectie met de database.

        extract($this->dbsettings);
        $this->mysqli = new mysqli($server, $user, $pass, $name);

        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
        //mysql_set_charset('utf8',$mysqli);
        return $this->mysqli;

    }

    public function doquery($query, $table) { // Een kleine hulpmiddel.
        $sqlquery = $this->mysqli->query(str_replace("{{table}}", $this->dbsettings["prefix"] . "_" . $table, $query));
        return $sqlquery;

    }

    public function esc_str($string){
        return $this->mysqli->real_escape_string($string);
    }
}
