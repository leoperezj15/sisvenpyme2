<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2019
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/DetalleVenta.inc";
                     
class DetalleVenta_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    function SaveDetalleVenta($_osDetalleVenta)
    {
        $sql = "INSERT into detalle_venta values (
				".$_osDetalleVenta->idVenta->GetValue().",
                ".$_osDetalleVenta->idProducto->GetValue().",
                ".$_osDetalleVenta->cantidad->GetValue().",
                ".$_osDetalleVenta->precio->GetValue().",
                ".$_osDetalleVenta->descuento->GetValue().",
				".$_osDetalleVenta->descuento_porcentaje->GetValue().")";

        $res = $this->Execute($sql);
        
        return $res;
    }

    function GetListDetalleVenta($_idVenta)
    {
        $sql = "SELECT 
        t1.idVenta as t1_idVenta,
        t1.idProducto as t1_idProducto,
        t1.cantidad as t1_cantidad,
        t1.precio as t1_precio,
        t1.descuento as t1_descuento,
        t1.descuento_porcentaje as t1_descuento_porcentaje,

        t2.idProducto as t2_idProducto,
        t2.nombre as t2_nombre,
        t2.descripcion as t2_descripcion,
        t2.codigo as t2_codigo,
        t2.pcompra as t2_pcompra,
        t2.pventa as t2_pventa,

        t3.idModelo as t3_idModelo,
        t3.model as t3_model

        FROM `detalle_venta` t1
        INNER JOIN `producto` t2 on t1.idProducto = t2.idProducto
        INNER join `modelo` t3 on t2.idModelo = t3.idModelo
        WHERE idVenta = ".$_idVenta;

        $res = $this->Execute($sql);
        
        $listaDetalle = array();

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osModelo = new Structure_Modelo;

                $osModelo->idModelo->SetValue($item["t3_idModelo"]);
                $osModelo->model->SetValue($item["t3_model"]);

                $osProducto = new Structure_Producto;

                $osProducto->idProducto->SetValue($item["t2_idProducto"]);
                $osProducto->nombre->SetValue($item["t2_nombre"]);
                $osProducto->descripcion->SetValue($item["t2_descripcion"]);
                $osProducto->codigo->SetValue($item["t2_codigo"]);
                $osProducto->pcompra->SetValue($item["t2_pcompra"]);
                $osProducto->pventa->SetValue($item["t2_pventa"]);

                $osProducto->Modelo = $osModelo;

                $osDetalleVenta = new Structure_DetalleVenta;

                
                $osDetalleVenta->idProducto->SetValue($item["t1_idProducto"]);
                $osDetalleVenta->idVenta->SetValue($item["t1_idVenta"]);
                $osDetalleVenta->cantidad->SetValue($item["t1_cantidad"]);
                $osDetalleVenta->precio->SetValue($item["t1_precio"]);
                $osDetalleVenta->descuento->SetValue($item["t1_descuento"]);
                $osDetalleVenta->descuento_porcentaje->SetValue($item["t1_descuento_porcentaje"]);

                $osDetalleVenta->Producto = $osProducto;

                $listaDetalle[] = $osDetalleVenta;               
            }            
        }
        
        return $listaDetalle;//devolver una lista[]
    }
    
    
}
                
?>