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

    function connect(){
        $this->conn= mysqli_connect($this->host,$this->user,$this->pass,$this->dbname);
        if(!$this->conn){
            echo 'Probleem andmebaasi ühendusega <br />';
            exit;
        }
    }

    function query($sql){
        $result = mysqli_query($this->conn,$sql);
        if(!$result){
            echo 'Probleem päringuga '.$sql.'<br />';
            return false;
        }
        return $result;
    }

    // andmete lugemine päringust

    function getdata($sql){
        $result = $this->query($sql); // saadame päringu andmebaasi
        $data = array(); // päringu andmete salvestamine
        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row; // loeme andmeid ridade kaupa
        }
        // kui probleem andmete lugemisega
        if (count($data) == 0){
            return false
        }
        return $data; // või tagastame andmed
    }
}