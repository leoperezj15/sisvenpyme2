<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Cliente.inc";
require_once "Usuario.inc";
require_once "Almacen.inc";
                     
class Structure_Venta
{

    public $idVenta;
    public $hash;
    public $idCliente;
    public $idUsuario;
    public $idAlmacen;
    public $fecha_hora;
    public $monto_total;
    public $monto_descuento;
    public $estado;
    
    

    Public $Cliente;
    Public $Usuario;
    Public $Almacen;
 
    function __construct()
    { 
        $this->idVenta = new Field("int", true);
        $this->hash = new Field("varchar");
        $this->idCliente = new Field("int");
        $this->idUsuario = new Field("int");
        $this->idAlmacen = new Field("int");
        $this->fecha_hora = new Field("datetime");
        $this->monto_total = new Field("float");
        $this->monto_descuento = new Field("float");
        $this->estado = new Field("enum");
        

        $this->Cliente = new Structure_Cliente;
        $this->Usuario = new Structure_Usuario;
        $this->Almacen = new Structure_Almacen;
        
	}
}
                
?>