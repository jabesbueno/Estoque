<?php
class classeRetirada{
   
    private $ID_Retirada;
    private $ID_ProdutoR;
    private $Nr_QuantProd;
    private $Dt_Retirada;
	private $Nm_Responsavel;
   
    //Construtor da Classe
    public function __construct($ID_ProdutoR, $Nr_QuantProd, $Dt_Retirada, $Nm_Responsavel, $ID_Retirada)
    {
	  $this->ID_ProdutoR = $ID_ProdutoR;
	  $this->Nr_QuantProd = $Nr_QuantProd;
      $this->Dt_Retirada = $Dt_Retirada;
	  $this->Nm_Responsavel = $Nm_Responsavel;
	  $this->ID_Retirada= $ID_Retirada;
    }
    // GET
    public function get_ID_Retirada() {
        return $this->ID_Retirada;
    }
	
	public function get_ID_ProdutoR() {
        return $this->ID_ProdutoR;
    }
	
	public function get_Nr_QuantProd() {
        return $this->Nr_QuantProd;
    }
	
	public function get_Dt_Retirada() {
        return $this->Dt_Retirada;
    }
	
	public function get_Nm_Responsavel() {
        return $this->Nm_Responsavel;
    }
	
	// SET
	public function set_ID_ProdutoR($ID_ProdutoR) {
        $this->ID_ProdutoR = $ID_ProdutoR;
    }
	
	public function set_ID_Retirada($ID_Retirada) {
        $this->ID_Retirada = $ID_Retirada;
    }
	
	public function set_Nr_QuantProd($Nr_QuantProd) {
        $this->Nr_QuantProd = $Nr_QuantProd;
    }
	
	public function set_Dt_Retirada($Dt_Retirada) {
        $this->Dt_Retirada = $Dt_Retirada;
    }
	
	public function set_Nm_Responsavel($Nm_Responsavel) {
        $this->Nm_Responsavel = $Nm_Responsavel;
    }
	
}
?>