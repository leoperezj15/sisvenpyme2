<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2019
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Categoria.inc";
                     
class Categoria_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) 
     * @return Lista de Structure_ClienteGeneral
     */
    function GetCategoriaList()
    {
        $sql = "SELECT * FROM `categoria` where estado = 'Activo'";
        $res = $this->Execute($sql);
        
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osCategoria = new Structure_Categoria;

                $osCategoria->idCategoria->SetValue($item["idCategoria"]);
                $osCategoria->hash->SetValue($item["hash"]);
 				$osCategoria->nombre->SetValue($item["nombre"]);
 				$osCategoria->descripcion->SetValue($item["descripcion"]);
 				$osCategoria->estado->SetValue($item["estado"]);

 				$list[] = $osCategoria;                
            }            
        }
        
        return $list;
    }
    
}
                
?>