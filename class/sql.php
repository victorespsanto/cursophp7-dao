<?php 


// criação da classe Sql extendida da Classe PDO (recebe todos os métodos de PDO)

class Sql extends PDO {

    private $conn;

    // criação do método construtor para conexão ao banco de dados...

    public function __construct() {

        $this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");

    }


    // criação do método para inclusão de um parãmetro

    public function setParam($statement, $key, $value) {

            $statement->bindParam($key, $value);  // encaixando os parâmetros no comando

    }


    // criação do método para inclusão de vários  parãmetroa

    public function setParams($statement, $parameters = array()) {

        foreach ($parameters as $key => $value) {  // percorre todos os parâmetros dado como array
            $this->setParam($statement, $key, $value);   // chamando o método setParam() 
        }


    }


    // criação do método de pesquisa

    public function query($rawQuery, $params = array()) {

        $stmt = $this->conn->prepare($rawQuery);
        
        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;

        
    }

    public function select($rawQuery, $params = array()):array {

       $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}




?>