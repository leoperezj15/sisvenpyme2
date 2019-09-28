<?php
require_once "data/db.inc";
require_once "data/Marca.inc";




class Marca_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    /** 
     * @abstract Función para obtener Listado de Cliente Naturales 
     * @return Lista de Structure_Natural e Structure_Cliente
     */

    function GetMarcaList()
    {
        $sql = "SELECT * FROM `marca`";

        $res = $this->Execute($sql);

        $listaMarca = array();

        if($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osMarca = new Structure_Marca;

               $osMarca->idMarca->SetValue($item["idMarca"]);
               $osMarca->hash->SetValue($item["hash"]);
               $osMarca->nombre->SetValue($item["nombre"]);
               $osMarca->descripcion->SetValue($item["descripcion"]);
               $osMarca->estado->SetValue($item["estado"]);

               $listaMarca[] = $osMarca;

            }

        }
        return $listaMarca;
        

    }
    
    
    
}



?>