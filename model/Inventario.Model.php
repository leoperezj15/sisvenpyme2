<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Inventario.inc";
                     
class Inventario_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    function SaveInventario($_osInventario)
    {
        $sql = "INSERT into inventario values (
				".$_osInventario->idAlmacen->GetValue().",
                ".$_osInventario->idProducto->GetValue().",
                ".$_osInventario->stock->GetValue().",
				'".$_osInventario->estado->GetValue()."')";

        $res = $this->Execute($sql);
        
        return $res;
    }
    function Update($_osInventario)
    {
        $sql = "UPDATE inventario set 
        stock = '".$_osInventario->stock->GetValue()."' 
        WHERE idAlmacen = ".$_osInventario->idAlmacen->GetValue()." 
        AND idProducto = ".$_osInventario->idProducto->GetValue();

        $res = $this->Execute($sql);

        return $res;


    }
    function Verifcar($_osInventario)
    {
        $sql = "SELECT * From `inventario` 
        WHERE idAlmacen=".$_osInventario->idAlmacen->GetValue()."
        AND idProducto=".$_osInventario->idProducto->GetValue();

        $res = $this->Execute($sql);

        if($this->ContainsData($res))
        {

            $row = $this->FetchArray($res);
            $stock = $row["stock"];
            return $stock;
    
        }
        else
        {
            return "Sin Stock";
        }

    }
    function VerificarStock($_osInventario)
    {
        $sql = "SELECT stock FROM `inventario` 
        WHERE idAlmacen=".$_osInventario->idAlmacen->GetValue()." 
        AND idProducto=".$_osInventario->idProducto->GetValue();

        $res = $this->Execute($sql);

        if($this->ContainsData($res))
        {

            $row = $this->FetchArray($res);
            $Stock = $row["stock"];
            return $Stock;
    
        }
        else
        {
            return false;
        }

    }
    
    
}
                
?>