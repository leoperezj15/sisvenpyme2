<?php


/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "field.inc";
require_once "Categoria.inc";

class Structure_SubCategoria
{
	public $idsubCategoria;
	public $hash;
	public $nombre;
	public $descripcion;
	public $estado;
	public $idCategoria;

	public $Categoria;

	function __construct()
	{
		$this->idsubCategoria = new Field("int", true);
		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->descripcion = new Field("varchar");
 		$this->estado = new Field("enum");
 		$this->idCategoria = new Field("int");

 		$this->Categoria = new Structure_Categoria;

	}

}

?>