<?php
//Sets timezone and inits session.
date_default_timezone_set("Europe/Oslo");
session_start();

//Just defines a directories, for ease of access later on.
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);
define('VIEW', ROOT . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('MODEL', ROOT . 'app' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR);
define('DATA', ROOT . 'app' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);
define('CORE', ROOT . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT . 'app' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR);
define('CONFIG', ROOT . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);
define('HELPERS', ROOT . 'app' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR);
define('LIB', ROOT . 'app' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
define('CONTENT', ROOT . 'public' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR);

require_once(CORE . 'Core.php');
//Init core and db.
$core = new Core;
//Only needed first time: 
#$core->sql->init_db();
#$core->sql->seed_database();
$modules = [ROOT, APP, CORE, CONTROLLER, DATA, MODEL, HELPERS, LIB, CONTENT];
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));

error_reporting(E_ALL);
ini_set('display_errors','on');

//Needed to make everything work on linux, as a followed bad naming conventions of files.
function autoCapital($class){
	include $class.'.php';
}
spl_autoload_register('autoCapital', false);
//Creates application instance, which handles routing of the request.
$App = new Application;
?>