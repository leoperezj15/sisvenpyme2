<?php

 require_once "field.inc";
 require_once "Producto.inc";
 require_once "Compra.inc";

class Structure_DetalleCompra
{
    public $idCompra;
    public $idProducto;
    public $cantidad;
    public $precioCompra;

    public $Producto;
    public $Compra;

    function __construct()
    {
        $this->idCompra = new Field("int");
        $this->idProducto = new Field("int");
 		$this->cantidad = new Field("float");
 		$this->precioCompra = new Field("float"); 

		$this->Producto = new Structure_Producto;
        $this->Compra = new Structure_Compra;

    }
}