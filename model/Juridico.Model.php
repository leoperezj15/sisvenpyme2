<?php
require_once "data/db.inc";
require_once "data/Cliente.inc";
require_once "data/Juridico.inc";



class Juridico_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    /** 
     * @abstract Función para obtener Listado de Cliente Juridico 
     * @return Lista de Structure_Juridico e Structure_Cliente
     */

    function GetListClienteJuridico()
    {
        $sql = "SELECT t1.idCliente as t1_idCliente,
        t1.razon_social as t1_razon_social,
        t1.rpte_legal as t1_rpte_legal,
        t1.nit as t1_nit,
        t2.direccion AS t2_direccion,
        t2.zona AS t2_zona,
        t2.tel_fijo as t2_tel_fijo, 
        t2.tel_celular as t2_tel_celular,
        t2.hash as t2_hash,
        t2.estado as t2_estado
        FROM `cliente_juridico` t1
        inner join `cliente` t2 on t2.idCliente = t1.idCliente";

        $res = $this->Execute($sql);

        $listaJuridico = array();

        if($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osJuridico = new Structure_Juridico;

               $osJuridico->idCliente->SetValue($item["t1_idCliente"]);
               $osJuridico->razon_social->SetValue($item["t1_razon_social"]);
               $osJuridico->rpte_legal->SetValue($item["t1_rpte_legal"]);
               $osJuridico->nit->SetValue($item["t1_nit"]);

               $osCliente = new Structure_Cliente;

               $osCliente->idCliente->SetValue($item["t1_idCliente"]);
               $osCliente->hash->SetValue($item["t2_hash"]);
               $osCliente->direccion->SetValue($item["t2_direccion"]);
               $osCliente->zona->SetValue($item["t2_zona"]);
               $osCliente->tel_fijo->SetValue($item["t2_tel_fijo"]);
               $osCliente->tel_celular->SetValue($item["t2_tel_celular"]);
               $osCliente->estado->SetValue($item["t2_estado"]);

               $osJuridico->Cliente = $osCliente;

               $listaJuridico[] = $osJuridico;

            }

        }
        return $listaJuridico;
        

    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) Naturales 
     * @return Lista de Structure_ClienteGeneral
     */
    
    function SaveJuridico($_osJuridico)
    {
        $sql = "INSERT INTO `cliente_juridico` VALUES (
          ".$_osJuridico->idCliente->GetValue().",
          '".$_osJuridico->razon_social->GetValue()."',
          '".$_osJuridico->rpte_legal->GetValue()."',
          '".$_osJuridico->nit->GetValue()."')";
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
    function VerificarNit($_nit)
    {
        $sql = "select nit from `cliente_juridico` where nit=".$_nit;
        $res = $this->Execute($sql);

        if ($this->ContainsData($res))//mysql_num_row
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    function UpdateJuridico($_osJuridico)
    {
        $sql = "UPDATE `cliente_juridico` SET
                    razon_social ='".$_osJuridico->razon_social->GetValue()."',
                    rpte_legal ='".$_osJuridico->rpte_legal->GetValue()."',
                    nit ='".$_osJuridico->nit->GetValue()."'
				        WHERE idCliente ='".$_osJuridico->idCliente->GetValue()."'";
        $res = $this->Execute($sql);
        
        return $res;
    }

    
}



?>