<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/RolModulo.inc";
require_once "data/Rol.inc";
require_once "data/Modulo.inc";
                     
class RolModulo_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Función para obtener la lista de rol_modulo(s) 
     * @return Lista de Structure_RolModulo
     */
    function GetList()
    {
        $sql = "Select 
					t1.idRol as t1_idRol,
					t1.idModulo as t1_idModulo,
					t1.hash as t1_hash,
					t1.estado as t1_estado,
					t2.idRol as t2_idRol,
					t2.hash as t2_hash,
					t2.nombre as t2_nombre,
					t2.estado as t2_estado,
					t3.idModulo as t3_idModulo,
					t3.hash as t3_hash,
					t3.nombre as t3_nombre,
					t3.estado as t3_estado
				from rol_modulo as t1
				inner join rol as t2
					 on t1.idRol = t2.idRol
				inner join modulo as t3
					 on t1.idModulo = t3.idModulo
				where t1.estado = 'Activo'";

        $res = $this->Execute($sql);
        
        $list = array();

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osRolModulo = new Structure_RolModulo;

 				$osRolModulo->idRol->SetValue($item["t1_idRol"]);
 				$osRolModulo->idModulo->SetValue($item["t1_idModulo"]);
 				$osRolModulo->hash->SetValue($item["t1_hash"]);
 				$osRolModulo->estado->SetValue($item["t1_estado"]);

					$osRol = new Structure_Rol;

 					$osRol->idRol->SetValue($item["t2_idRol"]);
 					$osRol->hash->SetValue($item["t2_hash"]);
 					$osRol->nombre->SetValue($item["t2_nombre"]);
 					$osRol->estado->SetValue($item["t2_estado"]);

					$osModulo = new Structure_Modulo;

 					$osModulo->idModulo->SetValue($item["t3_idModulo"]);
 					$osModulo->hash->SetValue($item["t3_hash"]);
 					$osModulo->nombre->SetValue($item["t3_nombre"]);
 					$osModulo->estado->SetValue($item["t3_estado"]);


				$osRolModulo->Rol = $osRol;
				$osRolModulo->Modulo = $osModulo;

 				$list[] = $osRolModulo;                
            }            
        }
        
        return $list;
    }
    
    /** 
     * @abstract Función para obtener la lista de rol_modulo(s) por Rol
     * @param int idRol
     * @return Lista de Structure_RolModulo
     */
    function GetListByRol($_idRol)
    {
        $sql = "Select 
					t1.idRol as t1_idRol,
					t1.idModulo as t1_idModulo,
					t1.hash as t1_hash,
					t1.estado as t1_estado,
					t2.idRol as t2_idRol,
					t2.hash as t2_hash,
					t2.nombre as t2_nombre,
					t2.estado as t2_estado,
					t3.idModulo as t3_idModulo,
					t3.hash as t3_hash,
					t3.nombre as t3_nombre,
					t3.estado as t3_estado,
                    t3.icono as t3_icono
				from rol_modulo as t1
				inner join rol as t2
					 on t1.idRol = t2.idRol
				inner join modulo as t3
					 on t1.idModulo = t3.idModulo
				where t1.idRol = ".$_idRol." and t1.estado = 'Activo'
                Group By t3.nombre";

        $res = $this->Execute($sql);
        
        $list = array();

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osRolModulo = new Structure_RolModulo;

 				$osRolModulo->idRol->SetValue($item["t1_idRol"]);
 				$osRolModulo->idModulo->SetValue($item["t1_idModulo"]);
 				$osRolModulo->hash->SetValue($item["t1_hash"]);
 				$osRolModulo->estado->SetValue($item["t1_estado"]);

					$osRol = new Structure_Rol;

 					$osRol->idRol->SetValue($item["t2_idRol"]);
 					$osRol->hash->SetValue($item["t2_hash"]);
 					$osRol->nombre->SetValue($item["t2_nombre"]);
 					$osRol->estado->SetValue($item["t2_estado"]);

					$osModulo = new Structure_Modulo;

 					$osModulo->idModulo->SetValue($item["t3_idModulo"]);
 					$osModulo->hash->SetValue($item["t3_hash"]);
 					$osModulo->nombre->SetValue($item["t3_nombre"]);
 					$osModulo->estado->SetValue($item["t3_estado"]);
                    $osModulo->icono->SetValue($item["t3_icono"]);


				$osRolModulo->Rol = $osRol;
				$osRolModulo->Modulo = $osModulo;

 				$list[] = $osRolModulo;                
            }            
        }
        
        return $list;
    }
    
    /** 
     * @abstract Función para obtener los Datos de rol_modulo(s)
     * @param string hash
     * @return Structure_RolModulo
     */
    function GetData($_hash)
    {
        $sql = "Select 
					t1.idRol as t1_idRol,
					t1.idModulo as t1_idModulo,
					t1.hash as t1_hash,
					t1.estado as t1_estado,
					t2.idRol as t2_idRol,
					t2.hash as t2_hash,
					t2.nombre as t2_nombre,
					t2.estado as t2_estado,
					t3.idModulo as t3_idModulo,
					t3.hash as t3_hash,
					t3.nombre as t3_nombre,
					t3.estado as t3_estado
				from rol_modulo as t1
				inner join rol as t2
					 on t1.idRol = t2.idRol
				inner join modulo as t3
					 on t1.idModulo = t3.idModulo
				where t1.hash = '". $_hash . "'";

        $res = $this->Execute($sql);
        
        $osRolModulo = new Structure_RolModulo;
        
        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);            
            
            foreach($data as $item)
            {
 				$osRolModulo->idRol->SetValue($item["t1_idRol"]);
 				$osRolModulo->idModulo->SetValue($item["t1_idModulo"]);
 				$osRolModulo->hash->SetValue($item["t1_hash"]);
 				$osRolModulo->estado->SetValue($item["t1_estado"]);

					$osRol = new Structure_Rol;

 					$osRol->idRol->SetValue($item["t2_idRol"]);
 					$osRol->hash->SetValue($item["t2_hash"]);
 					$osRol->nombre->SetValue($item["t2_nombre"]);
 					$osRol->estado->SetValue($item["t2_estado"]);

					$osModulo = new Structure_Modulo;

 					$osModulo->idModulo->SetValue($item["t3_idModulo"]);
 					$osModulo->hash->SetValue($item["t3_hash"]);
 					$osModulo->nombre->SetValue($item["t3_nombre"]);
 					$osModulo->estado->SetValue($item["t3_estado"]);


				$osRolModulo->Rol = $osRol;
				$osRolModulo->Modulo = $osModulo;
            }            
        }
        
        return $osRolModulo;
    }
    
    /** 
     * @abstract Función para guardar rol_modulo
     * @param Structure_RolModulo osRolModulo
     * @return bool
     */
    function Save($_osRolModulo)
    {
        $sql = "Insert into rol_modulo values (
				" . $_osRolModulo->idRol->GetValue() . ",
				" . $_osRolModulo->idModulo->GetValue() . ",
				'" . $_osRolModulo->hash->GetValue() . "',
				'" . $_osRolModulo->estado->GetValue() . "')";

        $res = $this->Execute($sql);

		$hash = sha1($_osRolModulo->idRol->GetValue() . "|" . $_osRolModulo->idModulo->GetValue());

		$sql2 = "Update rol_modulo set hash = '". $hash ."' where idRol = " . $_osRolModulo->idRol->GetValue() . " and idModulo = " . $_osRolModulo->idModulo->GetValue();
		$res2 = $this->Execute($sql2);
        
        $r = ($res and $res2) ? true : false;

		return $r;
    }
    
    /** 
     * @abstract Función para actualizar rol_modulo
     * @param Structure_RolModulo osRolModulo
     * @return bool
     */
    function Update($_osRolModulo)
    {
        $sql = "Update rol_modulo set 
					estado = '" . $_osRolModulo->estado->GetValue() . "'
				where hash = '" . $_osRolModulo->hash->GetValue() . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
    
    /** 
     * @abstract Función para eliminar rol_modulo
     * @param string hash
     * @return bool
     */
    function Delete($_hash)
    {
        $sql = "Update rol_modulo set estado = 'Inactivo' where hash = '" . $_hash . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
}
                
?>