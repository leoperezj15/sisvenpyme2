<?php


require_once "field.inc";
require_once "Pedido.inc";
require_once "Empleado.inc";
                     
class Structure_Factura
{

 	public $idFactura;
 	public $hash;
 	public $montoTotal;
 	public $impuestoTotal;
    public $DescuentoTotal;
    public $totalpago;
    public $codigoControl;
    public $fechaImpresion;
    public $nroImpresion;
    public $tc;
    public $correlativo;
    public $autorizacion;
    public $fechalimiteEmision;
    public $qr;
 	public $estado;
    public $idPedido;
    public $facturadoPor;//pertenece a idEmpleado

    Public $Pedido;
    public $Empleado;
    
 
    function __construct()
    { 
 		$this->idFactura = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->montoTotal = new Field("float");
 		$this->impuestoTotal = new Field("float");
 		$this->DescuentoTotal = new Field("float");
        $this->totalpago = new Field("float");
 		$this->codigoControl = new Field("float");
 		$this->fechaImpresion = new Field("date");
 		$this->nroImpresion = new Field("varchar");
        $this->tc = new Field("float");
 		$this->correlativo = new Field("varchar");
 		$this->autorizacion = new Field("varchar");
 		$this->fechalimiteEmision = new Field("date");
        $this->qr = new Field("longtext");
 		$this->estado = new Field("enum");
 		$this->idPedido = new Field("int");
 		$this->facturadoPor = new Field("int");
        
        $this->Pedido = new Structure_Pedido;
        $this->Empleado = new Structure_Empleado;
	}
}

?>