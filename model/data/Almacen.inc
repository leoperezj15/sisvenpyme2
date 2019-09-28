<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Sucursal.inc";

                     
class Structure_Almacen
{

 	public $idAlmacen;
 	public $hash;
 	public $nombre;
 	public $sigla;
 	public $estado;
 	public $idSucursal;

    public $Sucursal; 
 
    function __construct()
    { 
 		$this->idAlmacen = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->sigla = new Field("varchar");
 		$this->estado = new Field("enum");
 		$this->idSucursal = new Field("int");
        

        $this->Sucursal = new Structure_Sucursal;

	}
}
                
?>