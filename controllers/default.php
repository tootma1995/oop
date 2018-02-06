<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 02/02/2018
 * Time: 09:00
 */

$page_id= (int)$http->get('page_id'); // lehe id
$sql = 'SELECT * FROM content '.
    'WHERE content_id='.fixdb($page_id);
$result = $db->getData($sql);
if($result == false){
    $sql = 'SELECT * FROM content '.
        'WHERE is_first_page='.fixdb(1);
    $result = $db ->getData($sql);
}
if($result != false){
    $page = $result[0];
    $http->set('page_id',$page['content_id']);
    $mainTmpl->set('content', $page['content']);
}

