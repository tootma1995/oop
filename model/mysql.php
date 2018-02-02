<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 02/02/2018
 * Time: 08:57
 */

class mysql
{
    var $conn = false;
    var $host = false;
    var $user = false;
    var $pass = false;
    var $dbname = false;

    public function __construct($host,$user,$pass,$dbname)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
        $this->connect();
    }

    function connect($host,$user,$pass,$dbname){
        $this->conn= mysqli_connect($this->host,$this->user,$this->pass,$this->dbname);
        if(!$this->conn){
            echo 'Probleem andmebaasi ühendusega <br />';
            exit;
        }
    }
}