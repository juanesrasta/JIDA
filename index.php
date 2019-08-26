<?php
require_once ("app/controller/Controller.php");
require_once ("app/controller/homeController.php");
require('library/Requests.php');

$map = array(
    'login' => array('controller' =>'Controller', 'action' =>'login'),    
    'session' => array('controller' =>'Controller', 'action' =>'initSession'),    
    'logout' => array('controller' =>'Controller', 'action' =>'logout'),    
    'home' => array('controller' =>'homeController', 'action' =>'home'),    
    'getposts' => array('controller' =>'homeController', 'action' =>'getPosts'),    
    'new' => array('controller' =>'homeController', 'action' =>'create'),    
    'create' => array('controller' =>'homeController', 'action' =>'createPosts'),    
    'edit' => array('controller' =>'homeController', 'action' =>'editPosts'),    
    'remove' => array('controller' =>'homeController', 'action' =>'removePosts'),    
);
 // Parseo de la ruta
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
				'</p></body></html>';
        exit;
     }
 } else {
     $ruta = 'login';
 }

 $controller = $map[$ruta];
 // Ejecución del controller asociado a la ruta

 if (method_exists($controller['controller'],$controller['action'])) {
     call_user_func(array(new $controller['controller'], $controller['action']));
 } else {

     header('Status: 404 Not Found');
     echo '<html><body><h1>Error 404: El controller <i>' .
            
             '</i> no existe</h1></body></html>';
 }
