<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 02/02/2018
 * Time: 08:49
 */

class linkobject extends http
{
    // klassi muutujad/väljad
    var $baseLink = false; // põhilink
    var $protocol = 'http://'; // HTTP protokoll
    var $eq = '='; // =
    var $delim = '&amp;'; // &
    /**
     * linkobject constructor.
     */
    public function __construct(){
        // kõigepealt defineerime vajalikud eelandmed
        parent::__construct();
        $this->baseLink = $this->protocol.HTTP_HOST.SCRIPT_NAME;
    }
    // moodustame paarid kujul nimi=väärtus
    // ja ühendame paarid omavahel kujul:
    // nimi1=vaartus1&nimi2=vaartus2 jne
    function addToLink(&$link, $name, $value){
        if($link != ''){
            $link = $link.$this->delim;
        }
        $link = $link.fixUrl($name).$this->eq.fixUrl($value);
    }
    // moodustame valmislink kasutades põhilingi ja
    // $this->addToLink funktisiooni abil valmistatud paarid
    // $pairs = array('control'=>'login', 'user'=>'test');
    // getLink($pairs);
    function getLink($add = array()){
        $link = '';
        foreach ($add as $name=>$value){
            $this->addToLink($link, $name, $value);
        }
        if($link != ''){
            //http://nk.ikt.khk.ee/oop/index.php?control=login&user=test
            $link = $this->baseLink.'?'.$link;
        } else {
            //http://nk.ikt.khk.ee/oop/index.php
            $link = $this->baseLink;
        }
        return $link;
    }
}