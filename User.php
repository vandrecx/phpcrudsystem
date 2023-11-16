<?php

class User extends Conn{
    public object $conn;
    public object $query;
    public array $formData;
    public int $id;

    public function list() :array{
        $this->conn = $this->connectDb();
        $query_users = "SELECT id, nome, numero, cidade FROM jullychic ORDER BY id DESC";
        $result_users = $this->conn->prepare($query_users);
        $result_users->execute();
        $retorno = $result_users->fetchAll();
        //var_dump($retorno);

        return $retorno;
    }

    public function create(){
        $this->conn = $this->connectDb();

        $query = $this->conn->prepare("SELECT * FROM jullychic WHERE numero=:numero");
        $query->bindParam(":numero", $this->formData['numero']);
        $query->execute();
        $result = $query->fetch();

        if(!$result){
            $query_user = "INSERT INTO jullychic (nome, numero, cidade) VALUES (:nome, :numero, :cidade)";
            $add_user = $this->conn->prepare($query_user);
            $add_user->bindParam(":nome", $this->formData['nome']);
            $add_user->bindParam(":numero", $this->formData['numero']);
            $add_user->bindParam(":cidade", $this->formData['cidade']);
            $add_user->execute();

            if($add_user->rowCount()){
                return true;
            }
            else{
                return false;
            }
        }else{
            echo "<p style='color: #f00;'>O número em questão já corresponde na tabela<p>";
        }
    }

    public function view(){
        $this->conn = $this->connectDb();
        $query_user = "SELECT id, nome, numero, cidade 
                        FROM jullychic
                        WHERE id =:id
                        LIMIT 1";
        $result_user = $this->conn->prepare($query_user);
        $result_user->bindParam(':id', $this->id);
        $result_user->execute();
        $value = $result_user->fetch();
        return $value;
    }

    public function edit(){
        $this->conn = $this->connectDb();
        $query_user = "UPDATE jullychic SET nome =:nome, numero =:numero, cidade =:cidade
                        WHERE id=:id";
        $edit_user = $this->conn->prepare($query_user);
        $edit_user->bindParam(':nome', $this->formData['nome']);
        $edit_user->bindParam(':numero', $this->formData['numero']);
        $edit_user->bindParam(':cidade', $this->formData['cidade']);
        $edit_user->bindParam(':id', $this->formData['id']);
        $edit_user->execute();

        if($edit_user->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function delete(){
        $this->conn = $this->connectDb();
        $query_user = "DELETE FROM jullychic WHERE id =:id LIMIT 1";
        $delete_user = $this->conn->prepare($query_user);
        $delete_user->bindParam(':id', $this->id);
        $value = $delete_user->execute();

        return $value;
    }
}

?>