<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
                     
class Structure_Empleado
{

 	public $idEmpleado;
 	public $hash;
 	public $nombre;
 	public $a_paterno;
 	public $a_materno;
 	public $fecha_nac;
	public $ci;
	public $fecha_ingreso;
	public $fecha_despido;
	public $condicion;
 	public $estado; 
 
    function __construct()
    { 
 		$this->idEmpleado = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->a_paterno = new Field("varchar");
 		$this->a_materno = new Field("varchar");
 		$this->fecha_nac = new Field("datetime");
		$this->ci = new Field("varchar");
		$this->fecha_ingreso = new Field("date");
		$this->fecha_despido = new Field("date");
		$this->condicion = new Field("enum"); 
 		$this->estado = new Field("enum");
	}
}
                
?>