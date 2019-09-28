<?php

 require_once "field.inc";
 require_once "Producto.inc";
 require_once "Almacen.inc";
 require_once "Pedido.inc";

class Structure_ProductoAlmacen
{
    public $idProductoAlmacen;
    public $idProducto;
    public $idAlmacen;
    public $cantidad;
    public $idPedido;
    public $fechaMovimiento;
    public $estado;

    public $Producto;
    public $Almacen;
    public $Pedido;

    function __construct()
    
    {
        $this->idProductoAlmacen = new Field("int", true);
        $this->idProducto = new Field("int");
 		$this->idAlmacen = new Field("int");
 		$this->cantidad = new Field("float");
 		$this->idPedido = new Field("int");
 		$this->fechaMovimiento = new Field("date");
 		$this->estado = new Field("enum"); 

		$this->Producto = new Structure_Producto;
        $this->Almacen = new Structure_Almacen;
        $this->Pedido = new Structure_Pedido;

    }
}



?>