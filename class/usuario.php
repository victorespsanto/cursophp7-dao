<?php 


class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function setIdusuario($value) {
		$this->idusuario = $value;
	}

	public function getIdusuario() {
		return $this->idusuario;
	}

	public function setDeslogin($value) {
		$this->deslogin = $value;
	}

	public function getDeslogin() {
		return $this->deslogin;
	}

	public function setDessenha($value) {
		$this->dessenha = $value;
	}

	public function getDessenha() {
		return $this->dessenha;
	}

	public function setDtcadastro($value) {
		$this->dtcadastro = $value;
	}

	public function getDtcadastro() {
		return $this->dtcadastro;
	}

	public function loadById($id) {

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

		if ($result[0]) {

			$row = $result[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}

	}

	public static function getLista() {

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function search($login) {

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			":SEARCH"=>"%" . $login . "%"
		));

	}

	public function login($login, $password) {

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(

			":LOGIN"=>$login,
			":SENHA"=>$password
		));

		if ($result[0]) {

			$row = $result[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		} else {

			throw new Exception("Login e/ou senha inválidos!");
			
		}

	}

	public function __toString() {

		return json_encode(array(

			'idusuario'=>$this->getIdusuario(),
			'deslogin'=>$this->getDeslogin(),
			'dessenha'=>$this->getDessenha(),
			'dtcadastro'=>$this->getDtcadastro()->format('d/m/Y H:i:s')

		));
	}




}



 ?>