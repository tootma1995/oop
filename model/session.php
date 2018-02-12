<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 12/02/2018
 * Time: 12:20
 */

class session
{
    var $sid = false; //sessioni id
    var $vars = array(); //sessioni ajal tekkinud andmed
    var $http = false; // otseühendus $http objektiga
    var $db = false; // otseühendus $db objektiga

    /**
     * session constructor.
     * @param bool $http
     * @param bool $db
     */

    var $timeout = 1800; // sessioni pikkus - 30 min (sek-s)

    public function __construct(&$http, &$db)
    {
        $this->http = &$http;
        $this->db = &$db;
    }

    // sessioni tekitamine
    function createSession($user = false){
        if($user == false){
            // loome kasutaja andmestiku
            $user = array(
                'user_id' => 0,
                'username' => 'Anonymous',
                'role_id' => 0
            );
        }
        // loome sessioni id
        $sid = md5(uniqid(time().mt_rand(1,1000),true));

        //päringu sessiooni andmete salvestamiseks db-sse
        $sql = 'INSERT INTO session SET '.
            'sid='.fixdb($sid).', '.
            'user_id='.fixdb($user['user_id']).', '.
            'user_data='.fixdb(serialize($user)).', '.
            'login_ip='.fixdb(REMOTE_ADDR).', '.
            'created=NOW()';
        // saadame päring db-sse
        $this->db->query($sql);
        // määrame sessionile loodud id
        $this->sid=$sid;
        // paneme antud väärtuse ka veebi andmete sisse
        $this->http->set('sid',$sid);

    }
}