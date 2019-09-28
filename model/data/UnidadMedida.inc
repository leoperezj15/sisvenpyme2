<?php

require_once "field.inc";


 class Structure_UnidadMedida
 {
 	public $idunidadMedida;
 	public $nombre;
 	public $abrev;
 	public $descripcion;

 	function __construct()
 	{
 		$this->idunidadMedida = new Field("int", true);
 		$this->nombre = new Field("varchar");
 		$this->abrev = new Field("varchar");
 		$this->descripcion = new Field("varchar");

 	}
 }



?>