<?php
class classeUsuario{
	private $ID_Usuario;
	private $Nm_Usuario;
	private $Ds_Senha;
	private $Nr_Cpf;
	
	//Construtor da Classe
    public function __construct($Nm_Usuario, $Ds_Senha, $Nr_Cpf, $ID_Usuario)
    {
	  $this->Nm_Usuario = $Nm_Usuario;
	  $this->Ds_Senha = $Ds_Senha;
	  $this->Nr_Cpf = $Nr_Cpf;
	  $this->ID_Usuario = $ID_Usuario;
    }
	
	// GET
    public function get_ID_Usuario() {
        return $this->ID_Usuario;
    }
	
	public function get_Nm_Usuario() {
        return $this->Nm_Usuario;
    }
	
	public function get_Ds_Senha() {
        return $this->Ds_Senha;
    }
	
	public function get_Nr_Cpf() {
        return $this->Nr_Cpf;
    }
	// SET
	public function set_ID_Usuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }
	
	public function set_Nm_Usuario($Nm_Usuario) {
        $this->Nm_Usuario = $Nm_Usuario;
    }
	
	public function set_Ds_Senha($Ds_Senha) {
        $this->Ds_Senha = $Ds_Senha;
    }
	
	public function set_Nr_Cpf($Nr_Cpf) {
        $this->Nr_Cpf = $Nr_Cpf;
    }
}
?>