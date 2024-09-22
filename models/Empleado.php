<?php

namespace Model;

class Cliente extends ActiveRecord
{
    protected static $tabla = 'empleado';
    protected static $idTabla = 'emp_id';  
    protected static $columnasDB = ['emp_nombre', 'emp_nit'];

    public $emp_id;
    public $emp_nombre;
    public $emp_nit;
    public $emp_situacion;

    public function __construct($args = [])
    {
        $this->emp_id = $args['emp_id'] ?? null;
        $this->emp_nombre = $args['emp_nombre'] ?? '';
        $this->emp_nit = $args['emp_nit'] ?? 0;
        $this->emp_situacion = $args['emp_situacion'] ?? 1;
    }

    public static function obtenerEmpleadosconQuery()
    {
        $sql = "SELECT * FROM empleado where emp_situacion = 1";
        return self::fetchArray($sql);
    }
    
    public static function buscar()
    {
        $sql = "SELECT * FROM empleado where emp_situacion = 1";
        return self::fetchArray($sql);
    }


}
