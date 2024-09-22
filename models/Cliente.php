<?php

namespace Model;

class Cliente extends ActiveRecord
{
    protected static $tabla = 'clientes';
    protected static $idTabla = 'cliente_id';  
    protected static $columnasDB = ['cliente_nombre', 'cliente_nit'];

    public $cliente_id;
    public $cliente_nombre;
    public $cliente_nit;
    public $cliente_situacion;

    public function __construct($args = [])
    {
        $this->cliente_id = $args['cliente_id'] ?? null;
        $this->cliente_nombre = $args['cliente_nombre'] ?? '';
        $this->cliente_nit = $args['cliente_nit'] ?? 0;
        $this->cliente_situacion = $args['cliente_situacion'] ?? 1;
    }

    public static function obtenerClientesconQuery()
    {
        $sql = "SELECT * FROM clientes where cliente_situacion = 1";
        return self::fetchArray($sql);
    }
    
    public static function buscar()
    {
        $sql = "SELECT * FROM clientes where cliente_situacion = 1";
        return self::fetchArray($sql);
    }


}
