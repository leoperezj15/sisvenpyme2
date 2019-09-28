<?php
require_once "data/db.inc";
require_once "data/Cliente.inc";
require_once "data/Natural.inc";



class Natural_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    /** 
     * @abstract Función para obtener Listado de Cliente Naturales 
     * @return Lista de Structure_Natural e Structure_Cliente
     */

    function GetListNatural()
    {
        $sql = "SELECT t1.idCliente as t1_idCliente,
        t1.nombre as t1_nombre,
        t1.ap_paterno as t1_ap_paterno,
        t1.ap_materno as t1_ap_materno,
        t1.fecha_nac as t1_fecha_nac,
        t1.ci as t1_ci,
        t1.genero as t1_genero,
        t2.direccion AS t2_direccion,
        t2.zona AS t2_zona,
        t2.tel_fijo as t2_tel_fijo, 
        t2.tel_celular as t2_tel_celular,
        t2.hash as t2_hash,
        t2.estado as t2_estado
        FROM `cliente_natural` t1
        inner join `cliente` t2 on t2.idCliente = t1.idCliente";

        $res = $this->Execute($sql);

        $listaNatural = array();

        if($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osNatural = new Structure_Natural;

               $osNatural->idCliente->SetValue($item["t1_idCliente"]);
               $osNatural->nombre->SetValue($item["t1_nombre"]);
               $osNatural->ap_paterno->SetValue($item["t1_ap_paterno"]);
               $osNatural->ap_materno->SetValue($item["t1_ap_materno"]);
               $osNatural->fecha_nac->SetValue($item["t1_fecha_nac"]);
               $osNatural->ci->SetValue($item["t1_ci"]);
               $osNatural->genero->SetValue($item["t1_genero"]);

                   $osCliente = new Structure_Cliente;

                   $osCliente->idCliente->SetValue($item["t1_idCliente"]);
                   $osCliente->hash->SetValue($item["t2_hash"]);
                   $osCliente->direccion->SetValue($item["t2_direccion"]);
                   $osCliente->zona->SetValue($item["t2_zona"]);
                   $osCliente->tel_fijo->SetValue($item["t2_tel_fijo"]);
                   $osCliente->tel_celular->SetValue($item["t2_tel_celular"]);
                   $osCliente->estado->SetValue($item["t2_estado"]);

               $osNatural->Cliente = $osCliente;

               $listaNatural[] = $osNatural;

            }

        }
        return $listaNatural;
        

    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) Naturales 
     * @return Lista de Structure_ClienteGeneral
     */
    
    function SaveNatural($_osNatural)
    {
        $sql = "Insert into `cliente_natural` values (
				    ".$_osNatural->idCliente->GetValue().",
				    '".$_osNatural->nombre->GetValue()."',
                '".$_osNatural->ap_paterno->GetValue()."',
                '".$_osNatural->ap_materno->GetValue()."',
                '".$_osNatural->fecha_nac->GetValue()."',
                '".$_osNatural->ci->GetValue()."',
                '".$_osNatural->genero->GetValue()."')";
        $res = $this->Execute($sql);
        if($res == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function VerificarCI($_ci)
    {
        $sql = "select * from `cliente_natural` where ci=".$_ci;
        $res = $this->Execute($sql);
        $osNatural = null;

        if ($this->ContainsData($res))
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
    function VerificarNatural($_idCliente)
    {
        $sql = "select t1.idCliente as t1_idCliente,
        t1.nombre as t1_nombre,
        t1.apPaterno as t1_apPaterno,
        t1.apMaterno as t1_apMaterno,
        t1.fechanacimiento as t1_fechanacimiento,
        t1.ci as t1_ci,
        t1.genero as t1_genero,
        t2.direccion AS t2_direccion, 
        t2.telefonoCelular as t2_telefonoCelular, 
        t2.telefonoFijo t2_telefonoFijo
        FROM `cliente_natural` t1
        inner join `cliente` t2 on t2.idCliente = t1.idCliente
        WHERE t1.idCliente =".$_idCliente." and t2.estado = 'Activo'";

        $res = $this->Execute($sql);

        $osNatural = new Structure_Natural;
        

        if($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
               $osNatural->idCliente->SetValue($item["t1_idCliente"]);
               $osNatural->nombre->SetValue($item["t1_nombre"]);
               $osNatural->apPaterno->SetValue($item["t1_apPaterno"]);
               $osNatural->apMaterno->SetValue($item["t1_apMaterno"]);
               $osNatural->fechanacimiento->SetValue($item["t1_fechanacimiento"]);
               $osNatural->ci->SetValue($item["t1_ci"]);
               $osNatural->genero->SetValue($item["t1_genero"]);

               $osCliente = new Structure_Cliente;

               $osCliente->idCliente->SetValue($item["t1_idCliente"]);
               $osCliente->direccion->SetValue($item["t2_direccion"]);
               $osCliente->telefonoCelular->SetValue($item["t2_telefonoCelular"]);
               $osCliente->telefonoFijo->SetValue($item["t2_telefonoFijo"]);

               $osNatural->Cliente = $osCliente;

            }
        }
        return $osNatural;

    }
    function UpdateNatural($_osNatural)
    {
        $sql = "Update `cliente_natural` set 
					nombre ='".$_osNatural->nombre->GetValue()."',
                    ap_paterno ='".$_osNatural->ap_paterno->GetValue()."',
                    ap_materno ='".$_osNatural->ap_materno->GetValue()."',
                    fecha_nac ='".$_osNatural->fecha_nac->GetValue()."',
                    ci ='".$_osNatural->ci->GetValue()."',
                    genero ='" . $_osNatural->genero->GetValue()."'
				where idCliente ='".$_osNatural->idCliente->GetValue()."'";
        $res = $this->Execute($sql);
        
        return $res;
    }

    
}



?>