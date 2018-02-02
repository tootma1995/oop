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

require_once 'control.php';

// reaalväärtuste määramine
$mainTmpl->set('site_lang','et');
$mainTmpl->set('site_title','PV');
$mainTmpl->set('user','Kasutaja');
$mainTmpl->set('title','Pealkiri');
$mainTmpl->set('lang_bar','Keeleriba');
// failist menu
require_once 'menu.php';

//$mainTmpl->set('content','Lehe sisu');

// echo '<pre>';
// print_r($mainTmpl);
// echo '</pre>';

// echo $mainTmpl->parse();

echo $mainTmpl->parse();

echo '<pre>';
print_r($http->vars);
echo '</pre>';

$db->query('SELECT NOW()');

echo '<pre>';
print_r($db);
echo '</pre>';