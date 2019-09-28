<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

 require_once "field.inc";


 class Structure_ProductoGeneral
 {
 	public $idProducto;
 	public $descripcion;
 	public $nombre;
 	public $unidadMedida;
 	public $stock;
 	public $precioCompra;
 	public $precioVenta;
 	public $subCategoria;
	public $categoria;
	public $idAlmacen;
 	public $almacen;
 	public $abrevAlmacen;
 	public $sucursal;

 	function __construct()
 	{

 		$this->idProducto = new Field("int", true);
 		$this->descripcion = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->unidadMedida = new Field("varchar");
 		$this->stock = new Field("float");
 		$this->precioCompra = new Field("float");
 		$this->precioVenta = new Field("float");
 		$this->subCategoria = new Field("varchar");
		$this->categoria = new Field("varchar");
		$this->idAlmacen = new Field("int");
 		$this->almacen = new Field("varchar");
 		$this->abrevAlmacen = new Field("varchar");
 		$this->sucursal = new Field("varchar");

 	}

 }

?>