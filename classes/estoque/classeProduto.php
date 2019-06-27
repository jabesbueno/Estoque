<?php
class classeProduto{
   
    private $ID_Produto;
    private $Nr_Codigo;
    private $Nm_Produto;
	private $Tp_Produto;
    private $Nr_Quantidade;
    private $Dt_Entrada;
   
    //Construtor da Classe
    public function __construct($Nr_Codigo, $Nm_Produto, $Tp_Produto, $Nr_Quantidade, $Dt_Entrada, $ID_Produto)
    {
	  $this->Nr_Codigo = $Nr_Codigo;
	  $this->Nm_Produto = $Nm_Produto;
	  $this->Tp_Produto = $Tp_Produto;
      $this->Nr_Quantidade = $Nr_Quantidade;
	  $this->Dt_Entrada = $Dt_Entrada;
	  $this->ID_Produto = $ID_Produto;
    }
    // GET
    public function get_ID_Produto() {
        return $this->ID_Produto;
    }
	
	public function get_Nr_Codigo() {
        return $this->Nr_Codigo;
    }
	
	public function get_Nm_Produto() {
        return $this->Nm_Produto;
    }
	
	public function get_Tp_Produto() {
        return $this->Tp_Produto;
    }
	
	public function get_Nr_Quantidade() {
        return $this->Nr_Quantidade;
    }
	
	public function get_Dt_Entrada() {
        return $this->Dt_Entrada;
    }
	// SET
	public function set_ID_Produto($ID_Produto) {
        $this->ID_Produto = $ID_Produto;
    }
	
	public function set_Nr_Codigo($Nr_Codigo) {
        $this->Nr_Codigo = $Nr_Codigo;
    }
	
	public function set_Nm_Produto($Nm_Produto) {
        $this->Nm_Produto = $Nm_Produto;
    }
	
	public function set_Tp_Produto($Tp_Produto) {
        $this->Tp_Produto = $Tp_Produto;
    }
	
	public function set_Nr_Quantidade($Nr_Quantidade) {
        $this->Nr_Quantidade = $Nr_Quantidade;
    }
	
	public function set_Dt_Entrada($Dt_Entrada) {
        $this->Dt_Entrada = $Dt_Entrada;
    }
}
?>