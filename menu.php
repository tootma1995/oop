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

// kui andmed on db-s olemas, ss loome menu nende põhjal
if($result != false){
    foreach ($result as $page) {
        $itemTmpl->set('name',$page['title']);
        $link = $http->getLink(array('page_id'=>$page['content_id']));
        $itemTmpl->set('link',$link);
        $menuTmpl->add('menu_items',$itemTmpl->parse());
    }
}

//paneme paika valmis menu
$mainTmpl->set('menu',$menuTmpl->parse());