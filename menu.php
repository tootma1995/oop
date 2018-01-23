<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 23/01/2018
 * Time: 14:13
 */

// loome menu ehitamiseks vajalikud objektid
$menuTmpl = new template('menu.menu'); // menu mall
$itemTmpl = new template('menu.item'); // menu elemendi mall

// loome elemendi nimega esimene
$itemTmpl->set('name','esimene');
// lisame elemendi menusse
$menuItem = $itemTmpl->parse();
$menuTmpl->add('menu_items', $menuItem);


// loome elemendi nimega teine
$itemTmpl->set('name','teine');
// lisame elemendi menusse
$menuItem = $itemTmpl->parse();
$menuTmpl->add('menu_items', $menuItem);


// ehitame valmis
$menu = $menuTmpl->parse();

// lisame lehele
$mainTmpl->set('menu', $menu);