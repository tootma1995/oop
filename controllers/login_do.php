<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 12/02/2018
 * Time: 11:22
 */

// kysime vormist tulnud andmed

$username = $http->get('username');
$password = $http->get('password');

$sql = 'SELECT * from user '.
    'WHERE username='.fixdb($username).
    ' AND password='.fixdb(md5($password));

$result = $db->getData($sql);

if($result != false){
    //logime, avame sessiooni
} else {
    //suuname tagasi
    $link = $http->getLink(array('control'=>'login'));
    $http->redirect($link);
}