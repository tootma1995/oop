<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 02/02/2018
 * Time: 08:51
 */

$control = $http->get('control'); // kontrolleri faili nimi
$file = CONTROL_DIR.$control.'.php'; // kontrolleri faili tee
if(file_exists($file) and is_file($file) and is_readable($file)){
    require_once $file;
} else {
    // kui ei ole kontrolleri faili või
    // ei ole veel midagi valitud
    $file = CONTROL_DIR.DEFAULT_CONTROL.'.php';
    $http->set('control',DEFAULT_CONTROL);
    require_once $file;
}