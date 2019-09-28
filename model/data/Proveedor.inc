<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "field.inc";

class Structure_Proveedor
 {
 	public $idProveedor;
 	public $hash;
	public $nit;
 	public $razon_social;
 	public $contacto;
 	public $cargo_contacto;
 	public $direccion;
 	public $tel_fijo;
 	public $tel_celular;
 	public $correo;
 	public $web;
 	public $estado;

 	function __construct()
 	{
 		$this->idProveedor = new Field("int", true);
 		$this->hash = new Field("varchar");
		$this->nit = new Field("int");
 		$this->razon_social = new Field("varchar");
 		$this->contacto = new Field("varchar");
 		$this->cargo_contacto = new Field("varchar");
 		$this->direccion = new Field("varchar");
 		$this->tel_fijo = new Field("varchar");
 		$this->tel_celular = new Field("varchar");
 		$this->correo = new Field("varchar");
 		$this->web = new Field("varchar");
 		$this->estado = new Field("enum");

 	}
 }

?>