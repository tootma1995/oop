<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 18/01/2018
 * Time: 10:22
 */

class template
{
    // omadused
    var $file = '';
    var $content = false;
    var $vars = array();

    // meetodid

    // faili sisu lugemine
    /*function readFile($f){
        $fp = fopen($f,'rb');
        $this->content = fread($fp,filesize($f));
        fclose($fp);
    }*/
    function readFile($f){
        $this->content = file_get_contents($f);
    }
    // htmli vaadete faili kontroll ja kasutamine
    function loadFile(){
        // html vaade kausta olemasolu kontroll
        if(!is_dir(VIEWS_DIR)){
            echo 'Kataloogi '.VIEWS_DIR.' pole leitud<br />';
            exit;
        }
        // kui html vaade faili nimi antakse kujul: views/test.html
        $f = $this->file; //abiasendus
        if(file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        // kui html vaade faili nimi antakse kujul: test.html
        $f = VIEWS_DIR.$this->file;
        if(file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        // kui html vaade faili nimi antakse kujul: test
        $f = VIEWS_DIR.$this->file.'.html';
        if(file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        // kui html vaade faili nimi antakse kujul: alamkaust.test;
        $f = VIEWS_DIR.str_replace('.','/',$this->file).'.html';
        if(file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }

        if($this->content === false){
            echo 'Ei suutnud lugeda '.$this->file.' sisu';
        }
    }
}