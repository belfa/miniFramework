<?php

/**
 * Se encarga de cargar un Controlador
 * @param $controller
 * @return mixed
 */
function cargarControlador($controller){
    $controlador=ucwords($controller).'Controller';
    $strFileController='controller/'.$controlador.'.php';

    if(!is_file($strFileController)){
        $strFileController='controller/'.ucwords(CONTROLADOR_DEFECTO).'Controller.php';
    }

    require_once $strFileController;
    $controllerObj=new $controlador();
    return $controllerObj;
}

/**
 * Se encarga de cargar la Acción
 * @param $controllerObj
 * @param $action
 */
function cargarAccion($controllerObj,$action){
    $accion=$action;
    $controllerObj->$accion();
}

/**
 * Lanza la acción que ha sido cargada previamente.
 * @param $controllerObj
 */
function lanzarAccion($controllerObj){
    if(isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])){
        cargarAccion($controllerObj, $_GET["action"]);
    }else{
        cargarAccion($controllerObj, ACCION_DEFECTO);
    }
}

