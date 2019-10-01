<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Producto.inc";
require_once "data/Modelo.inc";
require_once "data/SubCategoria.inc";
require_once "data/UnidadMedida.inc";
                     
class Producto_Model extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    function GetListProducto()
    {
        $sql = "SELECT t1.idProducto as t1_idProducto,
                t1.hash as t1_hash,
                t1.nombre as t1_nombre,
                t1.descripcion as t1_descripcion,
                t1.estado as t1_estado,
                t1.peso as t1_peso,
                t1.madein as t1_madein,
                t1.codigo as t1_codigo,
                t1.pcompra as t1_pcompra,
                t1.pventa as t1_pventa,
                t1.idModelo as t1_idModelo,
                t2.hash as t2_hash,
                t2.model as t2_model,
                t2.idMarca as t2_idMarca,
                t3.hash as t3_hash,
                t3.nombre as t3_nombre,
                t1.idsubCategoria as t1_idsubCategoria,
                t4.nombre as t4_nombre,
                t4.idCategoria as t4_idCategoria,
                t5.nombre as t5_nombre,
                t1.idunidadMedida as t1_idunidadMedida,
                t6.abrev as t6_abrev
                FROM `producto` t1
                INNER JOIN `modelo` t2 on t1.idModelo=t2.idModelo
                INNER JOIN `marca` t3 on t2.idMarca=t3.idMarca
                INNER JOIN `sub_categoria` t4 on t1.idsubCategoria=t4.idsubCategoria
                INNER JOIN `categoria` t5 on t4.idCategoria=t5.idCategoria
                INNER JOIN `unidad_medida` t6 on t1.idunidadMedida=t6.idunidadMedida";

        $res = $this->Execute($sql);
        
        $listaProducto = array();

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
                $osUnidadMedida = new Structure_UnidadMedida;

                $osUnidadMedida->idunidadMedida->SetValue($item["t1_idunidadMedida"]);
                $osUnidadMedida->abrev->SetValue($item["t6_abrev"]);

                $osCategoria = new Structure_Categoria;

                $osCategoria->idCategoria->SetValue($item["t4_idCategoria"]);
                $osCategoria->nombre->SetValue($item["t5_nombre"]);

                $osSubCategoria = new Structure_SubCategoria;

                $osSubCategoria->idsubCategoria->SetValue($item["t1_idsubCategoria"]);
                $osSubCategoria->nombre->SetValue($item["t4_nombre"]);
                $osSubCategoria->idCategoria->SetValue($item["t4_idCategoria"]);

                $osSubCategoria->Categoria = $osCategoria;

                $osMarca = new Structure_Marca;

                $osMarca->idMarca->SetValue($item["t2_idMarca"]);
                $osMarca->hash->SetValue($item["t3_hash"]);
                $osMarca->nombre->SetValue($item["t3_nombre"]);

                $osModelo = new Structure_Modelo;

                $osModelo->idModelo->SetValue($item["t1_idModelo"]);
                $osModelo->hash->SetValue($item["t2_hash"]);
                $osModelo->model->SetValue($item["t2_model"]);

                $osModelo->Marca = $osMarca;


                $osProducto = new Structure_Producto;

                $osProducto->idProducto->SetValue($item["t1_idProducto"]);
                $osProducto->hash->SetValue($item["t1_hash"]);
                $osProducto->nombre->SetValue($item["t1_nombre"]);
                $osProducto->descripcion->SetValue($item["t1_descripcion"]);
                $osProducto->estado->SetValue($item["t1_estado"]);
                $osProducto->peso->SetValue($item["t1_peso"]);
                $osProducto->madein->SetValue($item["t1_madein"]);
                $osProducto->codigo->SetValue($item["t1_codigo"]);
                $osProducto->pcompra->SetValue($item["t1_pcompra"]);
                $osProducto->pventa->SetValue($item["t1_pventa"]);
                $osProducto->idModelo->SetValue($item["t1_idModelo"]);
                $osProducto->idsubCategoria->SetValue($item["t1_idsubCategoria"]);
                $osProducto->idunidadMedida->SetValue($item["t1_idunidadMedida"]);

                $osProducto->Modelo = $osModelo;
                $osProducto->SubCategoria = $osSubCategoria;
                $osProducto->UnidadMedida = $osUnidadMedida;

                $listaProducto[] = $osProducto;               
            }            
        }
        
        return $listaProducto;//devolver una lista[]
    }

    function GetProducto($_idProducto)
    {
        $sql = "SELECT * FROM `producto` WHERE hash='".$_idProducto."'";

        $res = $this->Execute($sql);

        if ($this->ContainsData($res))
        {
            $row = $this->FetchArray($res);

            $idProducto = $row["idProducto"];

            return $idProducto;

        }
        else
        {
            return false;
        }



    }


    function AutocompleteProducto($_parametro)
    {
        $sql = "SELECT t1.idProducto as t1_idProducto,
                t1.hash as t1_hash, 
                t1.codigo as t1_codigo,  
                t1.nombre as t1_nombre,
                t1.idModelo as t1_idModelo,
                t2.hash as t2_hash,
                t2.descripcion as t2_descripcion,
                t1.pcompra as t1_pcompra
                FROM producto t1
                INNER JOIN modelo t2 on t1.idModelo=t2.idModelo
                WHERE t1.nombre like '%".$_parametro."%' LIMIT 0, 100";

        $res = $this->Execute($sql);
        
        $return_Producto = array();

        if ($this->ContainsData($res))
        {
            $row = $this->FetchArray($res);

            while ($row)
            {

                $idProducto = $row['t1_hash'];
                $row_array['value'] = $row['t1_nombre'];
                $row_array['idproducto'] = $idProducto;
                $row_array['nombre2'] = $row['t1_nombre'];
                $row_array['codigo'] = $row['t1_codigo'];
                $row_array['idmodelo'] = $row['t2_hash'];
                $row_array['modelo'] = $row['t2_descripcion'];
                $row_array['precio'] = $row['t1_pcompra'];

                array_push($return_producto, $row_array);

                return $return_producto;
            }           
        }
        
        
    }
    function SaveProducto($_osProducto)
    {
        $sql = "INSERT INTO `producto` VALUES (
				".$_osProducto->idProducto->GetValue().",
				'".$_osProducto->hash->GetValue()."',
				'".$_osProducto->nombre->GetValue()."',
                '".$_osProducto->descripcion->GetValue()."',
                '".$_osProducto->estado->GetValue()."',
                '".$_osProducto->peso->GetValue()."',
                '".$_osProducto->madein->GetValue()."',
                '".$_osProducto->codigo->GetValue()."',
                ".$_osProducto->pcompra->GetValue().",
                ".$_osProducto->pventa->GetValue().",
                ".$_osProducto->idModelo->GetValue().",
                ".$_osProducto->idsubCategoria->GetValue().",
                ".$_osProducto->idunidadMedida->GetValue().")";

        $res = $this->Execute($sql);

		$id   = $this->GetLastIdAutoGenerated();
		$hash = sha1($id);
		$sql2 = "Update producto set hash = '".$hash."' where idProducto = ".$id;
		$res2 = $this->Execute($sql2);
        
        $r = ($res and $res2) ? true : false;
		return $r;
    }
    function VerificarProducto($_item,$_valor)
    {
        if ($_valor >= 1) 
        {
            $valor = $_valor;
        }
        else{
            $valor = "'$_valor'";
        }
        $sql = "SELECT * FROM `producto` WHERE $_item = $valor";
                    // echo '<pre>';
					// print_r($sql);
					// echo '</pre>';
					// return true;
        $res = $this->Execute($sql);

        $listaProducto = array();

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osProducto = new Structure_Producto;

                $osProducto->idProducto->SetValue($item["idProducto"]);
                $osProducto->hash->SetValue($item["hash"]);
                $osProducto->nombre->SetValue($item["nombre"]);
                $osProducto->descripcion->SetValue($item["descripcion"]);
                $osProducto->codigo->SetValue($item["codigo"]);
                $osProducto->estado->SetValue($item["estado"]);

                $listaProducto[] = $osProducto;                
            }
            return $listaProducto;//devolver una lista[]  

        }
        else
        {
            return null;
        }
    }
    
}