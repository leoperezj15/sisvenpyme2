<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Compra.inc";
require_once "data/Almacen.inc";
require_once "data/Usuario.inc";
require_once "data/Proveedor.inc";
                     
class Compra_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    function GetListCompraFecha($_ini,$_fin)
    {
        $sql = "SELECT t1.idCompra AS t1_idCompra,
                t1.hash as t1_hash,
                t1.fecha_ingreso AS t1_fecha_ingreso,
                t1.fecha_compra AS t1_fecha_compra,
                t1.idProveedor as t1_idProveedor,
                t2.hash AS t2_hash,
                t2.nit AS t2_nit,
                t2.razon_social AS t2_razon_social,
                t1.idUsuario as t1_idUsuario,
                t3.hash as t3_hash,
                t3.username as t3_username,
                t1.monto_total as t1_monto_total,
                t1.idAlmacen as t1_idAlmacen,
                t4.hash as t4_hash,
                t4.nombre as t4_nombre,
                t4.sigla as t4_sigla,
                t1.nro_factura as t1_nro_factura,
                t1.estado as t1_estado
                FROM `compra` t1
                INNER JOIN `proveedor` t2 ON t2.idProveedor=t1.idProveedor
                INNER JOIN `usuario` t3 ON t3.idUsuario=t1.idUsuario
                INNER JOIN `almacen` t4 ON t4.idAlmacen=t1.idAlmacen
                WHERE t1.fecha_ingreso BETWEEN '".$_ini."' AND '".$_fin."'
                ORDER BY t1.fecha_ingreso";

        $res = $this->Execute($sql);
        
        $listaCompra = array();

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osCompra = new Structure_Compra;
                $osProveedor = new Structure_Proveedor;
                $osUsuario = new Structure_Usuario;
                $osAlmacen = new Structure_Almacen;


                $osAlmacen->idAlmacen->SetValue($item["t1_idAlmacen"]);
                $osAlmacen->hash->SetValue($item["t4_hash"]);
                $osAlmacen->nombre->SetValue($item["t4_nombre"]);
                $osAlmacen->sigla->SetValue($item["t4_sigla"]);

                $osUsuario->idUsuario->SetValue($item["t1_idUsuario"]);
                $osUsuario->hash->SetValue($item["t3_hash"]);
                $osUsuario->usurname->SetValue($item["t3_usurname"]);

                $osProveedor->idProveedor->SetValue($item["t1_idProveedor"]);
                $osProveedor->hash->SetValue($item["t2_hash"]);
                $osProveedor->nit->SetValue($item["t2_nit"]);
                $osProveedor->razon_social->SetValue($item["t2_razon_social"]);

                $osCompra->idCompra->SetValue($item["t1_idCompra"]);
                $osCompra->hash->SetValue($item["t1_hash"]);
                $osCompra->fecha_ingreso->SetValue($item["t1_fecha_ingreso"]);
                $osCompra->fecha_compra->SetValue($item["t1_fecha_compra"]);
                $osCompra->idProveedor->SetValue($item["t1_idProveedor"]);
                $osCompra->idUsuario->SetValue($item["t1_idUsuario"]);
                $osCompra->monto_total->SetValue($item["t1_monto_total"]);
                $osCompra->idAlmacen->SetValue($item["t1_idAlmacen"]);
                $osCompra->nro_factura->SetValue($item["t1_nro_factura"]);
                $osCompra->estado->SetValue($item["t1_estado"]);

                $osCompra->Almacen = $osAlmacen;
                $osCompra->Usuario = $osUsuario;
                $osCompra->Proveedor = $osProveedor;

                $listaCompra[] = $osCompra;
               
            }            
        }
        
        return $listaCompra;//devolver una lista[]
    }

    function GetListCompras()
    {
        $sql = "SELECT t1.idCompra AS t1_idCompra,
                t1.hash as t1_hash,
                t1.fecha_ingreso AS t1_fecha_ingreso,
                t1.fecha_compra AS t1_fecha_compra,
                t1.idProveedor as t1_idProveedor,
                t2.hash AS t2_hash,
                t2.nit AS t2_nit,
                t2.razon_social AS t2_razon_social,
                t1.idUsuario as t1_idUsuario,
                t3.hash as t3_hash,
                t3.username as t3_username,
                t1.monto_total as t1_monto_total,
                t1.idAlmacen as t1_idAlmacen,
                t4.hash as t4_hash,
                t4.nombre as t4_nombre,
                t4.sigla as t4_sigla,
                t1.nro_factura as t1_nro_factura,
                t1.estado as t1_estado
                FROM `compra` t1
                INNER JOIN `proveedor` t2 ON t2.idProveedor=t1.idProveedor
                INNER JOIN `usuario` t3 ON t3.idUsuario=t1.idUsuario
                INNER JOIN `almacen` t4 ON t4.idAlmacen=t1.idAlmacen
                ORDER BY t1.fecha_ingreso";

        $res = $this->Execute($sql);
        
        $listaCompra = array();

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osCompra = new Structure_Compra;
                $osProveedor = new Structure_Proveedor;
                $osUsuario = new Structure_Usuario;
                $osAlmacen = new Structure_Almacen;


                $osAlmacen->idAlmacen->SetValue($item["t1_idAlmacen"]);
                $osAlmacen->hash->SetValue($item["t4_hash"]);
                $osAlmacen->nombre->SetValue($item["t4_nombre"]);
                $osAlmacen->sigla->SetValue($item["t4_sigla"]);

                $osUsuario->idUsuario->SetValue($item["t1_idUsuario"]);
                $osUsuario->hash->SetValue($item["t3_hash"]);
                $osUsuario->username->SetValue($item["t3_username"]);

                $osProveedor->idProveedor->SetValue($item["t1_idProveedor"]);
                $osProveedor->hash->SetValue($item["t2_hash"]);
                $osProveedor->nit->SetValue($item["t2_nit"]);
                $osProveedor->razon_social->SetValue($item["t2_razon_social"]);

                $osCompra->idCompra->SetValue($item["t1_idCompra"]);
                $osCompra->hash->SetValue($item["t1_hash"]);
                $osCompra->fecha_ingreso->SetValue($item["t1_fecha_ingreso"]);
                $osCompra->fecha_compra->SetValue($item["t1_fecha_compra"]);
                $osCompra->idProveedor->SetValue($item["t1_idProveedor"]);
                $osCompra->idUsuario->SetValue($item["t1_idUsuario"]);
                $osCompra->monto_total->SetValue($item["t1_monto_total"]);
                $osCompra->idAlmacen->SetValue($item["t1_idAlmacen"]);
                $osCompra->nro_factura->SetValue($item["t1_nro_factura"]);
                $osCompra->estado->SetValue($item["t1_estado"]);

                $osCompra->Almacen = $osAlmacen;
                $osCompra->Usuario = $osUsuario;
                $osCompra->Proveedor = $osProveedor;

                $listaCompra[] = $osCompra;
               
            }            
        }
        
        return $listaCompra;//devolver una lista[]
    }
    function SaveCompra($_osCompra)
    {
        $sql = "INSERT INTO compra values(
            ".$_osCompra->idCompra->GetValue().",
            '".$_osCompra->hash->GetValue()."',
            '".$_osCompra->fecha_ingreso->GetValue()."',
            '".$_osCompra->fecha_compra->GetValue() ."',
            ".$_osCompra->idProveedor->GetValue().",
            ".$_osCompra->idUsuario->GetValue().",
            ".$_osCompra->monto_total->GetValue().",
            ".$_osCompra->idAlmacen->GetValue().",
            ".$_osCompra->nro_factura->GetValue().",
            '".$_osCompra->estado->GetValue()."'
        )";

        $res = $this->Execute($sql);

        $id   = $this->GetLastIdAutoGenerated();

        $hash = sha1($id);

        $sql2 = "UPDATE compra SET hash = '".$hash."' WHERE idCompra = ".$id;
        
        $res2 = $this->Execute($sql2);
        
        return $id;
    }
    
}