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

    /**
     * template constructor.
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file; // määrame html faili nime
        $this->loadFile(); // laadime html faili sisu
    }


    // meetodid

    // faili sisu lugemine
    /*function readFile($f){
        $fp = fopen($f,'rb');
        $this->content = fread($fp,filesize($f));
        fclose($fp);
    }*/
    function readFile($file){
        $this->content = file_get_contents($file);
    }
    // htmli vaadete faili kontroll ja kasutamine
    function loadFile(){
        // html vaade kausta olemasolu kontroll
        if(!is_dir(VIEWS_DIR)){
            echo 'Kataloogi '.VIEWS_DIR.' pole leitud<br />';
            exit;
        }
        // kui html vaade faili nimi antakse kujul: views/test.html
        $file = $this->file; //abiasendus
        if(file_exists($file) and is_file($file) and is_readable($file)){
            $this->readFile($file);
        }
        // kui html vaade faili nimi antakse kujul: test.html
        $file = VIEWS_DIR.$this->file;
        if(file_exists($file) and is_file($file) and is_readable($file)){
            $this->readFile($file);
        }
        // kui html vaade faili nimi antakse kujul: test
        $file = VIEWS_DIR.$this->file.'.html';
        if(file_exists($file) and is_file($file) and is_readable($file)){
            $this->readFile($file);
        }
        // kui html vaade faili nimi antakse kujul: alamkaust.test;
        $file = VIEWS_DIR.str_replace('.','/',$this->file).'.html';
        if(file_exists($file) and is_file($file) and is_readable($file)){
            $this->readFile($file);
        }

        if($this->content === false){
            echo 'Ei suutnud lugeda '.$this->file.' sisu';
        }
    }
    //$this->vars täiendamine väärtustega
    function set($name,$value){
        $this->vars[$name]=$value;
    }


}