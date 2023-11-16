<?php

abstract class Conn{
    public string $db = "mysql";
    public string $host = "localhost";
    public string $user = "root";
    public string $pass = "";
    public string $dbname = "tiabd";
    public int $port = 3306;
    public object $connect;

    public function connectDb(){
        try{
            $this->connect = new PDO($this->db . ':host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->pass);
            //echo "Conexão com o banco de dados realizada com sucesso<br>";
            return $this->connect;
        }catch(Exception $err){
            die('Erro: Por favor tente novamente. Caso o problema persista entre o contato com o adm');
            //echo "Erro: Conexão com banco de dados não realizada! Erro gerado: " . $err->getMessage();
        }
    }
}

?>