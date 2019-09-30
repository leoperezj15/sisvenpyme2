<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2019
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/UnidadMedida.inc";
                     
class UnidadMedida_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener Unidades de Medida
     * @return Lista de Structure_UnidadMedida
     */
    function GetUnidadMedidaList()
    {
        $sql = "SELECT * FROM `unidad_medida`";
        $res = $this->Execute($sql);
        
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osUnidadMedida = new Structure_UnidadMedida;

                $osUnidadMedida->idunidadMedida->SetValue($item["idunidadMedida"]);
 				$osUnidadMedida->nombre->SetValue($item["nombre"]);
 				$osUnidadMedida->abrev->SetValue($item["abrev"]);
 				$osUnidadMedida->descripcion->SetValue($item["descripcion"]);

 				$list[] = $osUnidadMedida;                
            }            
        }
        
        return $list;
    }
    
}
                
?>