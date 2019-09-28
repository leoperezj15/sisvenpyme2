<?php
require_once "data/db.inc";
require_once "data/Modelo.inc";




class Modelo_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    /** 
     * @abstract Función para obtener Listado de Cliente Naturales 
     * @return Lista de Structure_Natural e Structure_Cliente
     */

    function GetModeloList()
    {
        $sql = "SELECT * FROM `modelo`";

        $res = $this->Execute($sql);

        $listaModelo = array();

        if($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osModelo = new Structure_Modelo;

               $osModelo->idModelo->SetValue($item["idModelo"]);
               $osModelo->hash->SetValue($item["hash"]);
               $osModelo->model->SetValue($item["model"]);
               $osModelo->ficha_tecnica->SetValue($item["ficha_tecnica"]);
               $osModelo->estado->SetValue($item["estado"]);
               $osModelo->idMarca->SetValue($item["idMarca"]);

               $listaModelo[] = $osModelo;

            }

        }
        return $listaModelo;
        

    }
    
    
    
}



?>