<?php
class ControladorBase{

    /**
     * ControladorBase constructor.
     */
    public function __construct() {

        require_once PATH_ROOT.'/core/EntidadBase.php';
        require_once PATH_ROOT.'/core/ModeloBase.php';

        /*
         * Carga todos los modelos. Tiene el pequeño inconveniente de que al tratarse
         * de una carga dinámica no puede evaluarse hasta el momento de la ejecución.
         */

        foreach(glob("model/*.php") as $file){
            require_once $file;
        }
    }

    //Plugins y funcionalidades

    /*
    * Este método lo que hace es recibir los datos del controlador en forma de array
    * los recorre y crea una variable dinámica con el indice asociativo y le da el
    * valor que contiene dicha posición del array, luego carga los helpers para las
    * vistas y carga la vista que le llega como parámetro. En resumen un método para
    * renderizar vistas.
    */
    public function view($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }

        require_once PATH_ROOT.'/core/AyudaVistas.php';
        $helper=new AyudaVistas();

        require_once PATH_ROOT.'/view/'.$vista.'View.php';
    }

    public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        header("Location:index.php?controller=".$controlador."&action=".$accion);
    }

    /*
     * Aquí podemos definir el método que podrán utilizar todos los controladores.
     *
     */

}
?>