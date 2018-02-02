<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 19/01/2018
 * Time: 14:18
 */

// nõuame conf faili
require_once 'conf.php';

$mainTmpl = new template('main');

// reaalväärtuste määramine
$mainTmpl->set('site_lang','et');
$mainTmpl->set('site_title','PV');
$mainTmpl->set('user','Kasutaja');
$mainTmpl->set('title','Pealkiri');
$mainTmpl->set('lang_bar','Keeleriba');
// failist menu
require_once 'menu.php';
$mainTmpl->set('content','Lehe sisu');

// echo '<pre>';
// print_r($mainTmpl);
// echo '</pre>';

echo $mainTmpl->parse();