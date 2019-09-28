<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "field.inc";

 class Structure_Categoria
 {
 	public $idCategoria;
 	public $nombre;
 	public $descripcion;
 	public $estado;

 	function __construct()
 	{

 		$this->idCategoria = new Field("int", true);
 		$this->nombre = new Field("varchar");
 		$this->descripcion = new Field("varchar");
 		$this->estado = new Field("enum");
 	}
 }


?>