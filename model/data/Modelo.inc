<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

 require_once "field.inc";
 require_once "Marca.inc";



 class Structure_Modelo
 {
 	public $idModelo;
 	public $hash;
 	public $model;
 	public $ficha_tecnica;
 	public $estado;
 	public $idMarca;

 	public $Marca;

 	function __construct()
 	{

 		$this->idModelo = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->model = new Field("varchar");
 		$this->ficha_tecnica = new Field("varchar");
 		$this->estado = new Field("enum");
 		$this->idMarca = new Field("int");
 		
 		$this->Marca = new Structure_Marca;


 	}

 }

?>