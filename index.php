<?php

global $OUTPUT;
global $OPENED_FILES;
session_start();
define('APPLICATION_PATH', realpath(dirname(__FILE__)));
ini_set('include_path', ini_get('include_path').PATH_SEPARATOR. APPLICATION_PATH .DIRECTORY_SEPARATOR .'lib');

// Loading classes
include('Zend/Loader/Autoloader.php');
$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace('Zend');
$loader->registerNamespace('FS');
$loader->registerNamespace('Collections');

if (!isset($_SESSION['historial'])) {
    $_SESSION['historial'] = '';
}

$OUTPUT = $_SESSION['historial'];

$OPENED_FILES = new Collections_List();
if (isset($_POST['comando'])) {
    $comando = $_POST['comando'];
    $options = explode(' ', $comando);
    $comando = $options[0];

    $lista = array('date', 'cal', 'clear', 'cat');
    if (in_array($options[0], $lista)) {

        include "include/$comando.php";
        
        $object_name = ucfirst($comando);
        $object = new $object_name();

        $OUTPUT .= '# ' . $comando . PHP_EOL;
        $object->main($options);
        $OUTPUT .= PHP_EOL;

    } else {
        $OUTPUT .= 'nch: ' . $comando . ': no se encontró la orden' . PHP_EOL;
    }

    $_SESSION['historial'] = $OUTPUT;
}


// Kernel initialization

function translate($path) {
    return APPLICATION_PATH . '/data/fs_example' . $path;
}

//View inirialization
$view = new Zend_View();
$view->setScriptPath('templates');

// Layout initialization;
$available_templates = array('carlos', 'crhyst', 'jmejia');
$random_index = rand(0, count($available_templates) - 1);
$random_template = $available_templates[$random_index];

if (!isset($_SESSION['template'])) {
    $_SESSION['template'] = $random_template . '.php';
}

$_SESSION['template'] = 'carlos.php';


$view->output = $OUTPUT;
$view->user = 'scesi';
$view->prompt= '$';
$view->hostname = 'nonchalant';

echo $view->render($_SESSION['template']);


/*
$db_connect = mysql_connect('localhost', 'carlos', 'asdf');
mysql_select_db('nonchalant');

if (!$db_connect) {
    die('No pudo conectarse: ' . mysql_error());
}

echo 'Conectado satisfactoriamente';


mysql_close($db_connect);
 */

?>
