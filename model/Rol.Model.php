<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Rol.inc";
                     
class Rol_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Función para obtener la lista de rol(s) 
     * @return Lista de Structure_Rol
     */
    function GetList()
    {
        $sql = "Select * from rol where estado = 'Activo'";
        $res = $this->Execute($sql);
        
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osRol = new Structure_Rol;

 				$osRol->idRol->SetValue($item["idRol"]);
 				$osRol->hash->SetValue($item["hash"]);
 				$osRol->nombre->SetValue($item["nombre"]);
 				$osRol->estado->SetValue($item["estado"]);

 				$list[] = $osRol;                
            }            
        }
        
        return $list;
    }
    
    /** 
     * @abstract Función para obtener los Datos de rol(s)
     * @param string hash
     * @return Structure_Rol
     */
    function GetData($_hash)
    {
        $sql = "Select * from rol where hash = '". $_hash . "'";
        $res = $this->Execute($sql);
        
        $osRol = new Structure_Rol;
        
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);            
            
            foreach($data as $item)
            {
 				$osRol->idRol->SetValue($item["idRol"]);
 				$osRol->hash->SetValue($item["hash"]);
 				$osRol->nombre->SetValue($item["nombre"]);
 				$osRol->estado->SetValue($item["estado"]);
            }            
        }
        
        return $osRol;
    }
    
    /** 
     * @abstract Función para guardar rol
     * @param Structure_Rol osRol
     * @return bool
     */
    function Save($_osRol)
    {
        $sql = "Insert into rol values (
				" . $_osRol->idRol->GetValue() . ",
				'" . $_osRol->hash->GetValue() . "',
				'" . $_osRol->nombre->GetValue() . "',
				'" . $_osRol->estado->GetValue() . "')";

        $res = $this->Execute($sql);

		$id   = $this->GetLastIdAutoGenerated();
		$hash = sha1($id);
		$sql2 = "Update rol set hash = '". $hash ."' where idRol = " . $id;
		$res2 = $this->Execute($sql2);
        
        $r = ($res and $res2) ? true : false;
		return $r;
    }
    
    /** 
     * @abstract Función para actualizar rol
     * @param Structure_Rol osRol
     * @return bool
     */
    function Update($_osRol)
    {
        $sql = "Update rol set 
					nombre = '" . $_osRol->nombre->GetValue() . "',
					estado = '" . $_osRol->estado->GetValue() . "'
				where hash = '" . $_osRol->hash->GetValue() . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
    
    /** 
     * @abstract Función para eliminar rol
     * @param string hash
     * @return bool
     */
    function Delete($_hash)
    {
        $sql = "Update rol set estado = 'Inactivo' where hash = '" . $_hash . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
}
                
?>