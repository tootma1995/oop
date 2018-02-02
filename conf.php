<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 18/01/2018
 * Time: 09:35
 */

// konfig fail

// loome vajalikud abikonstandid
define('MODEL_DIR', 'model/');
define('VIEWS_DIR', 'views/');
define('CONTROL_DIR', 'controllers/');
define('LIB_DIR', 'lib/');

define('DEFAULT_CONTROL','default');

require_once LIB_DIR.'utils.php';

// nõuame vajalike failide olemasolu
require_once MODEL_DIR.'template.php'; //html vaade failide töötlus
require_once MODEL_DIR.'http.php';
require_once MODEL_DIR.'linkobject.php';
require_once MODEL_DIR.'mysql.php'; // db klass

require_once 'db_conf.php';

$http = new linkobject();
$db = new mysql(DB_HOST,DB_USER,DB_PASS,DB_NAME);