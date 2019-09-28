<?php

 require_once "field.inc";
 require_once "Producto.inc";
 require_once "Venta.inc";

class Structure_DetalleVenta
{
    
    public $idProducto;
    public $idVenta;
    public $cantidad;
    public $precio;
    public $descuento;
    public $descuento_porcentaje;

    public $Producto;
    public $Venta;

    function __construct()
    {
        $this->idProducto = new Field("int");
        $this->idVenta = new Field("int");
 		$this->cantidad = new Field("float");
 		$this->precio = new Field("float");
        $this->descuento = new Field("float");
        $this->descuento_porcentaje = new Field("float");

		$this->Producto = new Structure_Producto;
        $this->Venta = new Structure_Venta;

    }
}