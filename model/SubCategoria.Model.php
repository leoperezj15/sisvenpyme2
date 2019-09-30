<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/SubCategoria.inc";
                     
class SubCategoria_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) 
     * @return Lista de Structure_ClienteGeneral
     */
    function GetListSubCategoria()
    {
        $sql = "SELECT * from sub_categoria WHERE estado = 'Activo'";
        $res = $this->Execute($sql);
        
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osSubCategoria = new Structure_SubCategoria;

 				$osSubCategoria->idSubCategoria->SetValue($item["idSubCategoria"]);
 				$osSubCategoria->nombre->SetValue($item["nombre"]);
 				$osSubCategoria->descripcion->SetValue($item["descripcion"]);
 				$osSubCategoria->estado->SetValue($item["estado"]);

 				$list[] = $osSubCategoria;                
            }            
        }
        
        return $list;
    }
    function GetListSubCategoriaByCategoria($_idCategoria)
    {
        $sql = "SELECT * FROM `sub_categoria` WHERE idCategoria=".$_idCategoria." and estado = 'Activo'";
        $res = $this->Execute($sql);
        
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osSubCategoria = new Structure_SubCategoria;

                $osSubCategoria->idsubCategoria->SetValue($item["idsubCategoria"]);
                $osSubCategoria->hash->SetValue($item["hash"]);
 				$osSubCategoria->nombre->SetValue($item["nombre"]);
 				$osSubCategoria->descripcion->SetValue($item["descripcion"]);
                $osSubCategoria->estado->SetValue($item["estado"]);
                $osSubCategoria->idCategoria->SetValue($item["idCategoria"]);

 				$list[] = $osSubCategoria;                
            }
            
        }
        return $list;
        
    }
    
}
                
?>