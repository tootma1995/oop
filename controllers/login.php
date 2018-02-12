<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 12/02/2018
 * Time: 11:08
 */

//votame kasutusele login.html faili
$loginFrom = new template('login');
// andmete tootlusfaili link
$link = $http->getLink(array('control'=>'login_do'));
// määrame andmed malli
$loginFrom->set('link',$link);
$loginFrom->set('kasutaja','Sisesta kasutajanimi: ');
$loginFrom->set('parool','Sisesta parool: ');
$loginFrom->set('nupp','Logi sisse');
// väljastame sisu peamalli sees
$mainTmpl->set('content',$loginFrom->parse());