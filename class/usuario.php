<?php 


class Usuario {

	// atributos da classe, campos da tabela do banco de dados

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	// fim da declaração dos atributos da classe


	// métodos getters e setters para manipulação dos atributos da classe

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

	// fim da declaração dos métodos getters e setters de manipulação dos atributos da classe

	// funcão para carregar os atributos da classe

	
	public function setData($data) {

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));

	}


	public function loadById($id) {

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

		if ($result[0]) {

			$row = $result[0];

			$this->setData($row);

		}

	}

	// fim do método

	// função para retornar todos os registros do banco de dados

	public static function getLista() {

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	// fim

	// função para retornar pesquisa de usuários do banco de dados

	public static function search($login) {

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(  // tag LIKE permite pesquisa de parte de registro do usuario. Uso de "%%"
			":SEARCH"=>"%" . $login . "%"
		));

	}

	// fim

	// função para autenticação de usuario pelo login e senha. Retorna erro se um dos valores estiver errado   

	public function login($login, $password) {  

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(   

			":LOGIN"=>$login,
			":SENHA"=>$password
		));

		if ($result[0]) {  // se o array tiver pelo menos um componente retorna TRUE

			$row = $result[0];

			$this->setData($row);

		} else {

			throw new Exception("Login e/ou senha inválidos!");   // retorna o erro caso for informado login e/ou senha errados.
			
		}

	}

	public function insert() {

		$sql = new Sql();

		$result = $sql->select("CALL tb_usuarios_insert(:LOGIN, :PASSWORD)", array(

			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if ($result[0]) {  // se o array tiver pelo menos um componente retorna TRUE

			$row = $result[0];

			$this->setData($row);

		}


	}

	//fim

	// funão toString para decriçao do objeto

	public function __toString() {

		return json_encode(array(   // retorna um array formatado em json.

			'idusuario'=>$this->getIdusuario(),
			'deslogin'=>$this->getDeslogin(),
			'dessenha'=>$this->getDessenha(),
			'dtcadastro'=>$this->getDtcadastro()->format('d/m/Y H:i:s')   // formatação de data e hora.

		));
	}

	// fim da função toString.

}



 ?>