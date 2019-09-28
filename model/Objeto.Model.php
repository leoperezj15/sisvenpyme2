<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Objeto.inc";
require_once "data/Modulo.inc";
                     
class Objeto_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Función para obtener la lista de objeto(s) 
     * @return Lista de Structure_Objeto
     */
    function GetList()
    {
        $sql = "Select 
					t1.idObjeto as t1_idObjeto,
					t1.hash as t1_hash,
					t1.nombre as t1_nombre,
					t1.imagen as t1_imagen,
					t1.nombreControl as t1_nombreControl,
					t1.orden as t1_orden,
					t1.idModulo as t1_idModulo,
					t1.estado as t1_estado,
					t2.idModulo as t2_idModulo,
					t2.hash as t2_hash,
					t2.nombre as t2_nombre,
					t2.estado as t2_estado
				from objeto as t1
				inner join modulo as t2
					 on t1.idModulo = t2.idModulo
				where t1.estado = 'Activo'";

        $res = $this->Execute($sql);
        
        $list = array();

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osObjeto = new Structure_Objeto;

 				$osObjeto->idObjeto->SetValue($item["t1_idObjeto"]);
 				$osObjeto->hash->SetValue($item["t1_hash"]);
 				$osObjeto->nombre->SetValue($item["t1_nombre"]);
 				$osObjeto->imagen->SetValue($item["t1_imagen"]);
 				$osObjeto->nombreControl->SetValue($item["t1_nombreControl"]);
 				$osObjeto->orden->SetValue($item["t1_orden"]);
 				$osObjeto->idModulo->SetValue($item["t1_idModulo"]);
 				$osObjeto->estado->SetValue($item["t1_estado"]);

					$osModulo = new Structure_Modulo;

 					$osModulo->idModulo->SetValue($item["t2_idModulo"]);
 					$osModulo->hash->SetValue($item["t2_hash"]);
 					$osModulo->nombre->SetValue($item["t2_nombre"]);
 					$osModulo->estado->SetValue($item["t2_estado"]);


				$osObjeto->Modulo = $osModulo;

 				$list[] = $osObjeto;                
            }            
        }
        
        return $list;
    }
    
    /** 
     * @abstract Función para obtener la lista de objeto(s)
     * @param int idModulo
     * @return Lista de Structure_Objeto
     */
    function GetListByModulo($_idModulo)
    {
        $sql = "Select 
					t1.idObjeto as t1_idObjeto,
					t1.hash as t1_hash,
					t1.nombre as t1_nombre,
					t1.imagen as t1_imagen,
					t1.nombreControl as t1_nombreControl,
					t1.orden as t1_orden,
					t1.idModulo as t1_idModulo,
					t1.estado as t1_estado,
					t2.idModulo as t2_idModulo,
					t2.hash as t2_hash,
					t2.nombre as t2_nombre,
					t2.estado as t2_estado,
                    t2.icono as t2_icono
				from objeto as t1
				inner join modulo as t2
					 on t1.idModulo = t2.idModulo
				where t1.idModulo = " . $_idModulo . " and t1.estado = 'Activo'";

        $res = $this->Execute($sql);
        
        $list = array();

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osObjeto = new Structure_Objeto;

 				$osObjeto->idObjeto->SetValue($item["t1_idObjeto"]);
 				$osObjeto->hash->SetValue($item["t1_hash"]);
 				$osObjeto->nombre->SetValue($item["t1_nombre"]);
 				$osObjeto->imagen->SetValue($item["t1_imagen"]);
 				$osObjeto->nombreControl->SetValue($item["t1_nombreControl"]);
 				$osObjeto->orden->SetValue($item["t1_orden"]);
 				$osObjeto->idModulo->SetValue($item["t1_idModulo"]);
 				$osObjeto->estado->SetValue($item["t1_estado"]);

					$osModulo = new Structure_Modulo;

 					$osModulo->idModulo->SetValue($item["t2_idModulo"]);
 					$osModulo->hash->SetValue($item["t2_hash"]);
 					$osModulo->nombre->SetValue($item["t2_nombre"]);
 					$osModulo->estado->SetValue($item["t2_estado"]);
                    $osModulo->icono->SetValue($item["t2_icono"]);


				$osObjeto->Modulo = $osModulo;

 				$list[] = $osObjeto;                
            }            
        }
        
        return $list;
    }
    
    /** 
     * @abstract Función para obtener los Datos de objeto(s)
     * @param string hash
     * @return Structure_Objeto
     */
    function GetData($_hash)
    {
        $sql = "Select 
					t1.idObjeto as t1_idObjeto,
					t1.hash as t1_hash,
					t1.nombre as t1_nombre,
					t1.imagen as t1_imagen,
					t1.nombreControl as t1_nombreControl,
					t1.orden as t1_orden,
					t1.idModulo as t1_idModulo,
					t1.estado as t1_estado,
					t2.idModulo as t2_idModulo,
					t2.hash as t2_hash,
					t2.nombre as t2_nombre,
					t2.estado as t2_estado
				from objeto as t1
				inner join modulo as t2
					 on t1.idModulo = t2.idModulo
				where t1.hash = '". $_hash . "'";

        $res = $this->Execute($sql);
        
        $osObjeto = new Structure_Objeto;
        
        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);            
            
            foreach($data as $item)
            {
 				$osObjeto->idObjeto->SetValue($item["t1_idObjeto"]);
 				$osObjeto->hash->SetValue($item["t1_hash"]);
 				$osObjeto->nombre->SetValue($item["t1_nombre"]);
 				$osObjeto->imagen->SetValue($item["t1_imagen"]);
 				$osObjeto->nombreControl->SetValue($item["t1_nombreControl"]);
 				$osObjeto->orden->SetValue($item["t1_orden"]);
 				$osObjeto->idModulo->SetValue($item["t1_idModulo"]);
 				$osObjeto->estado->SetValue($item["t1_estado"]);

					$osModulo = new Structure_Modulo;

 					$osModulo->idModulo->SetValue($item["t2_idModulo"]);
 					$osModulo->hash->SetValue($item["t2_hash"]);
 					$osModulo->nombre->SetValue($item["t2_nombre"]);
 					$osModulo->estado->SetValue($item["t2_estado"]);


				$osObjeto->Modulo = $osModulo;
            }            
        }
        
        return $osObjeto;
    }
    
    /** 
     * @abstract Función para guardar objeto
     * @param Structure_Objeto osObjeto
     * @return bool
     */
    function Save($_osObjeto)
    {
        $sql = "Insert into objeto values (
				" . $_osObjeto->idObjeto->GetValue() . ",
				'" . $_osObjeto->hash->GetValue() . "',
				'" . $_osObjeto->nombre->GetValue() . "',
				'" . $_osObjeto->imagen->GetValue() . "',
				'" . $_osObjeto->nombreControl->GetValue() . "',
				" . $_osObjeto->orden->GetValue() . ",
				" . $_osObjeto->idModulo->GetValue() . ",
				'" . $_osObjeto->estado->GetValue() . "')";

        $res = $this->Execute($sql);

		$id   = $this->GetLastIdAutoGenerated();

		$hash = sha1($id);

		$sql2 = "Update objeto set hash = '". $hash ."' where idObjeto = " . $id;

		$res2 = $this->Execute($sql2);
        
        $r = ($res and $res2) ? true : false;

		return $r;
    }
    
    /** 
     * @abstract Función para actualizar objeto
     * @param Structure_Objeto osObjeto
     * @return bool
     */
    function Update($_osObjeto)
    {
        $sql = "Update objeto set 
					nombre = '" . $_osObjeto->nombre->GetValue() . "',
					imagen = '" . $_osObjeto->imagen->GetValue() . "',
					nombreControl = '" . $_osObjeto->nombreControl->GetValue() . "',
					orden = " . $_osObjeto->orden->GetValue() . ",
					idModulo = " . $_osObjeto->idModulo->GetValue() . ",
					estado = '" . $_osObjeto->estado->GetValue() . "'
				where hash = '" . $_osObjeto->hash->GetValue() . "'";

        $res = $this->Execute($sql);
        
        return $res;
    }
    
    /** 
     * @abstract Función para eliminar objeto
     * @param string hash
     * @return bool
     */
    function Delete($_hash)
    {
        $sql = "Update objeto set estado = 'Inactivo' where hash = '" . $_hash . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
}
                
?>