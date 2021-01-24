<?php
class Usuario {
	private $id;
	private $login;
	private $senha;
	private $perfil;
	private $nome;
	private $email;
	private $oab;
	private $codigo_verificacao;

  public function getID() {
		return $this->id;
	}
	public function setID($value) {
		$this->id = $value;
	}
	public function getLogin() {
		return $this->login;
	}
	public function setLogin($value) {
		$this->login = $value;
	}
	public function getCodigo_Verificacao() {
		return $this->codigo_verificacao;
	}
	public function setCodigo_Verificacao($value) {
		$this->codigo_verificacao = $value;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($value) {
		$this->email = $value;
	}
	public function getNome() {
		return $this->nome;
	}
	public function setNome($value) {
		$this->nome = $value;
	}
	public function getSenha() {
		return $this->senha;
	}
	public function setSenha($value) {
		$this->senha = $value;
	}
	public function getPerfil() {
		return $this->perfil;
	}
	public function setPerfil($value) {
		$this->perfil = $value;
	}
	public function getOab() {
		return $this->oab;
	}
	public function setOab($value) {
		$this->oab = $value;
	}

}
