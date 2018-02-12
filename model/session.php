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

    var $timeout = 1800; // sessioni pikkus - 30 min (sek-s)
    var $anonymous = true; // kas lubatud anonuumne kasutamine

    /**
     * session constructor.
     * @param bool $http
     * @param bool $db
     */

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

    function clearSession(){
        $sql = 'DELETE FROM session WHERE '.
            time().'- UNIX_TIMESTAMP(changed) > '.
            $this->timeout;
        $this->db->query($sql);
    }

    //sesssioni seisundi kontroll
    function checkSession(){
        $this->clearSession(); // eemaldan aegunud asjad
        //kui sid pole ja anon lubatud avame uue sessioni
        if($this->sid === false and $this->anonymous){
            $this->createSession();
        }
        // kui sessioni id on kätte saadav
        if($this->sid !== false){
            $sql = 'SELECT * FROM session WHERE '.
                'sid='.fixdb($this->sid);
            $result = $this->db->getData($sql);
            //kui db-st andmeid ei saanud
            if($result == false){
                //loome uue anon sessioni, kui lubatud
                if($this->anonymous){
                    $this->createSession();
                } else {
                    //koristame andmed
                    $this->sid = false;
                    //koristada veebist
                    //... veel ei ole
                }
                // loon anonyymse kasutaja rolli ja user_id
                define('ROLE_ID',0);
                define('USER_ID',0);
            } else {
                //kasutame andmed dbst
                $vars = unserialize($result[0]['svars']);
                $this->vars = $vars;
                $user_data = unserialize($result[0]['user_data']);
                define('ROLE_ID',$user_data['role_id']);
                define('USER_ID',$user_data['user_id']);
                $this->user_data = $user_data;
            }
        } else {
            // kui sessioni pole
            define('ROLE_ID',0);
            define('USER_ID',0);
        }
    }
}