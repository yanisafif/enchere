<?php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

if ($_GET['action']){
    // fonction explode qui permet de séparer les paramètres
    $params = explode("/", $_GET['action']);
    // Si le premier paramètre existe on va le sauvegarder dans une variable no
    if($params[0] != ""){
        $controller = $params[0];
        $action = isset($params[1])? $params[1]: 'getAllItems';

        // On inclut le dossier controllers.
        require_once (ROOT.'controllers/'.$controller.'.php');
        if(function_exists($action)){
            if(isset($params[2]) && isset($params[3])){
                $action($params[2], $params[3]);
            }elseif (isset($params[2])){
                $action($params[2]);
            }else{
                $action();
            }
        }else{
            echo 'Page par défaut';
        }
    }

}else{
    require_once ('controllers/controllerItem.php');
    getAllItems();
}