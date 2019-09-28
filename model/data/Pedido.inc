<?php

require_once "field.inc";
require_once "Cliente.inc";
require_once "Empleado.inc";

class Structure_Pedido
{
    public $idPedido;
    public $TotalPedido;
    public $estado;
    public $idtipoMovimiento;
    public $realizado_por;
    public $idCliente;

    public $Empleado;
    public $Cliente;

    function __construct()
    {
        $this->idPedido = new Field("int,true");
        $this->TotalPedido = new Field("float");
        $this->estado = new Field("enum");
        $this->idtipoMovimiento = new Field("int");
        $this->realizado_por = new Field("int");
        $this->idCliente = new Field("int");

        $this->Empleado = new Structure_Empleado;
        $this->Cliente = new Structure_Cliente;
        
    }
}




?>