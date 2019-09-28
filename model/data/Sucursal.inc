<?php


require_once "field.inc";

class Structure_Sucursal
{
	public $idSucursal;
	public $hash;
	public $Nombre;
	public $Ubicacion;
	public $Descripcion;
	public $Direccion;
	public $estado;

	function __construct()
	{
		$this->idSucursal = new Field("int", true);
		$this->hash = new Field("varchar");
 		$this->Nombre = new Field("varchar");
 		$this->Ubicacion = new Field("varchar");
		$this->Descripcion = new Field("varchar");
 		$this->Direccion = new Field("varchar");
 		$this->estado = new Field("enum");
	}

}

?>