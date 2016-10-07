<?php
class ModeloBase extends EntidadBase{
    private $table;
    private $fluent;

    public function __construct($table, $adapter) {
        $this->table=(string) $table;
        parent::__construct($table, $adapter);

        $this->fluent=$this->getConetar()->startFluent();
    }

    public function fluent(){
        return $this->fluent;
    }



    /**
     * Dado una sentencia SQL, intenta crear un objeto o un array de objetos del resultado.
     * En caso de que no haya resultado en la consulta, devolverá un TRUE.
     * En caso de que no se haya podido llevar a cabo la cosulta, devolverá un FALSE.
     * @param $query
     * @return array|bool|null|object|stdClass
     */
    public function ejecutarSql($query){
        $resultSet = false;
        $query=$this->db()->query($query);
        if($query==true){
            if($query->num_rows>1){
                while($row = $query->fetch_object()) {
                    $resultSet[]=$row;
                }
            }elseif($query->num_rows==1){
                if($row = $query->fetch_object()) {
                    $resultSet=$row;
                }
            }else{
                $resultSet=true;
            }
        }else{
            $resultSet=false;
        }

        return $resultSet;
    }

    //Aqui podemos montarnos metodos para los modelos de consulta

}