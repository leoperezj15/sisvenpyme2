<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

 require_once "field.inc";
 require_once "Producto.inc";
 require_once "Precio.inc";

 class Structure_ProductoPrecio
 {
 	public $idProducto;
 	public $idPrecio;
 	public $fechaAsig;
 	public $fechaInicio;
 	public $fechaFin;
 	public $estado;

 	public $Producto;
 	public $Precio;

 	function __construct()
 	{
 		$this->idProducto = new Field("int", true);
 		$this->idPrecio = new Field("int", true);
 		$this->fechaAsig = new Field("datetime");
 		$this->fechaInicio = new Field("datetime");
 		$this->fechaFin = new Field("datetime");
 		$this->estado = new Field("enum");

 		$this->Producto = new Structure_Producto;
 		$this->Precio = new Structure_Precio;
 	}
 }


?>