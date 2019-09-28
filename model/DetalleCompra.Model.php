<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/DetalleCompra.inc";
                     
class DetalleCompra_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    function Save($_osDetalleCompra)
    {
        $sql = "INSERT into detalle_compra values (
				".$_osDetalleCompra->idCompra->GetValue().",
                ".$_osDetalleCompra->idProducto->GetValue().",
                ".$_osDetalleCompra->cantidad->GetValue().",
				".$_osDetalleCompra->precioCompra->GetValue().")";

        $res = $this->Execute($sql);
        
        return $res;
    }
    
    
}
                
?>