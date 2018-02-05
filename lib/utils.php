<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 02/02/2018
 * Time: 09:04
 */

function fixUrl($str){
    return urlencode($str);
}

function fixdb($str){ //abifunk paringu koostamiseks
    return '"'.addslashes($str).'"';
}