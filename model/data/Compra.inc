<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Proveedor.inc";
require_once "Usuario.inc";
require_once "Almacen.inc";
                     
class Structure_Compra
{

    public $idCompra;
    public $hash;
    public $fecha_ingreso;
    public $fecha_compra;
    public $idProveedor;
    public $idUsuario; 
    public $monto_total;
    public $idAlmacen;
    public $nro_factura;
    public $estado;

    Public $Proveedor;
    Public $Usuario;
    Public $Almacen;
 
    function __construct()
    { 
     	$this->idCompra = new Field("int", true);
        $this->hash = new Field("varchar");
     	$this->fecha_ingreso = new Field("datetime");
     	$this->fecha_compra = new Field("date");
     	$this->idProveedor = new Field("int");
     	$this->idUsuario = new Field("int");
        $this->monto_total = new Field("float");
        $this->idAlmacen = new Field("int");
        $this->nro_factura = new Field("int");
        $this->estado = new Field("enum");

        $this->Proveedor = new Structure_Proveedor;
        $this->Usuario = new Structure_Usuario;
        $this->Almacen = new Structure_Empleado;
        
	}
}
                
?>