<?php


require_once "field.inc";


 class Structure_TipoPedido
 {
 	public $idtipoPedido;
 	public $nombre;
 	public $descripcion;
 	public $estado;

 	function __construct()
 	{
 		$this->idtipoPedido = new Field("int", true);
 		$this->nombre = new Field("varchar");
 		$this->descripcion = new Field("varchar");
 		$this->estado = new Field("enum");

 	}
 }



?>