<?php

require_once "field.inc";

class Structure_Precio
{
	public $idPrecio;
	public $precioCompra;
	public $precioVenta;
	public $fecha;
	public $motivo;
	public $estado;

	function __construct()
	{
		$this->idPrecio = new Field("int", true);
		$this->precioCompra = new Field("float");
		$this->precioVenta = new Field("float");
		$this->fecha = new Field("datetime");
		$this->motivo = new Field("varchar");
		$this->motivo = new Field("enum");
	}
}
?>