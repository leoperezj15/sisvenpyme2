<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Cliente.inc";

                     
class Structure_Natural
{

    public $idCliente;
    public $nombre;
    public $ap_paterno;
    public $ap_materno;
    public $fecha_nac;
    public $ci;
    public $genero;

    Public $Cliente;
 
    function __construct()
    { 
        $this->idCliente = new Field("int", true);
        $this->nombre = new Field("varchar");
        $this->ap_paterno = new Field("varchar");
        $this->ap_materno = new Field("varchar");
        $this->fecha_nac = new Field("date");
        $this->ci = new Field("varchar");
        $this->genero = new Field("enum");

        $this->Cliente = new Structure_Cliente;
	}
}
                
?>