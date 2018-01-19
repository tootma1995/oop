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

echo '<pre>';
print_r($mainTmpl);
echo '</pre>';