<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 23/01/2018
 * Time: 14:13
 */

// loome menüü ehitamiseks vajalikud objektid
$menuTmpl = new template('menu.menu'); // menüü mall
$itemTmpl = new template('menu.item'); // menüü elemendi mall

//koostame menu loomise päringu
$sql = 'SELECT content_id, content, title '.
    'FROM content WHERE parent_id='.fixdb(0).' '.
    'AND show_in_menu='.fixdb(1);
$result = $db->getData($sql); // loeme andmed dbst
echo '<pre>';
print_r($result);
echo '</pre>';


// avalele element
$itemTmpl->set('name', 'avaleht');
$link = $http->getLink();
$itemTmpl->set('link', $link);
$menuTmpl->add('menu_items', $itemTmpl->parse());
// avalehe element on valmis
// loome üks menüü element nimega esimene
// määrame menüüs väljastava elemendi nime
$itemTmpl->set('name', 'esimene');
// määrata menüüs väljastava elemendiga seotud link
// http://anna.ikt.khk.ee/oop_vs17_2/index.php?control=esimene
$link = $http->getLink(array('control'=>'esimene'));
$itemTmpl->set('link', $link);
// lisame antud element menüüsse
$menuItem = $itemTmpl->parse(); // string, mis sisaldab ühe nimekirja elemendi lingiga
$menuTmpl->add('menu_items', $menuItem); // nüüd olemas paar 'menu_items'=>'<li>...</li>
// loome veel üks menüü element nimega teine
$itemTmpl->set('name', 'teine');
// määrata menüüs väljastava elemendiga seotud link
// http://nk.ikt.khk.ee/oop_vs17_2/index.php?control=esimene
$link = $http->getLink(array('control'=>'teine'));
$itemTmpl->set('link', $link);
// lisame antud element menüüsse
$menuItem = $itemTmpl->parse(); // string, mis sisaldab ühe nimekirja elemendi lingiga
$menuTmpl->add('menu_items', $menuItem); // nüüd olemas paar 'menu_items'=>'<li>...</li>



// ehitame valmis menüü
$menu = $menuTmpl->parse();

// lisame valmis menüü lehele
//$mainTmpl->set('menu', $menu);
// ehitame valmis
//$menu = $menuTmpl->parse();

// lisame lehele
$mainTmpl->set('menu', $menu);