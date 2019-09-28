<?php
require_once "data/db.inc";
require_once "data/Sucursal.inc";



class Sucursal_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    function GetSucursalList()
    {
        $sql = "SELECT * FROM `sucursal`";
        $res = $this->Execute($sql);

        $list = array();
        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);
            
            foreach($data as $item)
            {
                $osSucursal = new Structure_Sucursal;

                $osSucursal->idSucursal->SetValue($item["idSucursal"]);
                $osSucursal->hash->SetValue($item["hash"]);
                $osSucursal->Nombre->SetValue($item["Nombre"]);
                $osSucursal->Ubicacion->SetValue($item["Ubicacion"]);
                $osSucursal->Descripcion->SetValue($item["Descripcion"]);
                $osSucursal->Direccion->SetValue($item["Direccion"]);
                $osSucursal->estado->SetValue($item["estado"]);

                $listaSucursal[] = $osSucursal;                
            }            
        }
        
        return $listaSucursal;//devolver una lista[]
    }

    function GetDataSucursal($_hash)
    {
        $sql = "SELECT * FROM `sucursal` WHERE hash='$_hash'";

        $res = $this->Execute($sql);

        $listaSucursal = array();

        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osSucursal = new Structure_Sucursal;

                $osSucursal->idSucursal->SetValue($item["idSucursal"]);
                $osSucursal->hash->SetValue($item["hash"]);
                $osSucursal->Nombre->SetValue($item["Nombre"]);
                $osSucursal->Ubicacion->SetValue($item["Ubicacion"]);
                $osSucursal->Descripcion->SetValue($item["Descripcion"]);
                $osSucursal->Direccion->SetValue($item["Direccion"]);
                $osSucursal->estado->SetValue($item["estado"]);

                $listaSucursal[] = $osSucursal;                
            }
            return $listaSucursal;//devolver una lista[]  

        }
        else
        {
            return false;
        }
        
        

    }

    function VerificarSucursal($_nombre,$_idSucursal)
    {
        if ($_idSucursal == Null) 
        {
            
            $sql = "SELECT * FROM `sucursal` WHERE nombre='$_nombre'";

            $res = $this->Execute($sql);

            $listaSucursal = array();

            if ($this->ContainsData($res))
            {
                $data = $this->DataListStructure($res);
                foreach($data as $item)
                {
                    $osSucursal = new Structure_Sucursal;

                    $osSucursal->idSucursal->SetValue($item["idSucursal"]);
                    $osSucursal->hash->SetValue($item["hash"]);
                    $osSucursal->Nombre->SetValue($item["Nombre"]);
                    $osSucursal->Ubicacion->SetValue($item["Ubicacion"]);
                    $osSucursal->Descripcion->SetValue($item["Descripcion"]);
                    $osSucursal->Direccion->SetValue($item["Direccion"]);
                    $osSucursal->estado->SetValue($item["estado"]);

                    $listaSucursal[] = $osSucursal;                
                }
                return $listaSucursal;//devolver una lista[]  

            }
            else
            {
                return false;
            }

        }
        else
        {
            $sql = "SELECT * FROM `sucursal` WHERE nombre='$_nombre' and hash!=$_idSucursal";

            $res = $this->Execute($sql);

            $listaSucursal = array();

            if ($this->ContainsData($res))
            {
                $data = $this->DataListStructure($res);
                foreach($data as $item)
                {
                    $osSucursal = new Structure_Sucursal;

                    $osSucursal->idSucursal->SetValue($item["idSucursal"]);
                    $osSucursal->hash->SetValue($item["hash"]);
                    $osSucursal->Nombre->SetValue($item["Nombre"]);
                    $osSucursal->Ubicacion->SetValue($item["Ubicacion"]);
                    $osSucursal->Descripcion->SetValue($item["Descripcion"]);
                    $osSucursal->Direccion->SetValue($item["Direccion"]);
                    $osSucursal->estado->SetValue($item["estado"]);

                    $listaSucursal[] = $osSucursal;                
                }
                return $listaSucursal;//devolver una lista[]  

            }
            else
            {
                return false;
            }
        }
        


        
        
    }

    function SaveSucursal($_osSucursal)
    {
        $sql = "INSERT INTO `sucursal` VALUES (
                ". $_osSucursal->idSucursal->GetValue().",
                '".$_osSucursal->hash->GetValue()."',
                '".$_osSucursal->Nombre->GetValue()."',
                '".$_osSucursal->Ubicacion->GetValue()."',
                '".$_osSucursal->Descripcion->GetValue()."',
                '".$_osSucursal->Direccion->GetValue()."',
                '".$_osSucursal->estado->GetValue()."')";

        $res = $this->Execute($sql);

        $id   = $this->GetLastIdAutoGenerated();
        $hash = sha1($id);
        $sql2 = "UPDATE sucursal SET hash = '".$hash."' WHERE idSucursal = " . $id;
        $res2 = $this->Execute($sql2);
        
        $r = ($res and $res2) ? true : false;
        return $r;
    }

    function UpdateSucursal($_osSucursal)
    {
        $sql = "UPDATE sucursal SET
                    Nombre='".$_osSucursal->Nombre->GetValue()."',
                    Ubicacion='".$_osSucursal->Ubicacion->GetValue()."',
                    Descripcion='".$_osSucursal->Descripcion->GetValue()."',
                    Direccion='".$_osSucursal->Direccion->GetValue()."',
                    estado='".$_osSucursal->estado->GetValue()."'
                WHERE hash='".$_osSucursal->hash->GetValue()."'";
        $res = $this->Execute($sql);

        return $res;
    }

    function DeleteSucursal($_hash)
    {
        $sql = "Update sucursal set estado = 'Inactivo' where hash = '" . $_hash . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }

    function ActiveSucursal($_hash)
    {
        $sql = "Update sucursal set estado = 'Activo' where hash = '" . $_hash . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }

}