<?php

session_start();

ob_start();

//Receber o id
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar</title>
</head>
<body>

    <a href="index.php">Listar</a>
    <a href="create.php">Cadastrar</a>

    <h1>Detalhes do Usuário</h1>
    
    <?php
    
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    if(!empty($id)){
        require './Conn.php';
        require './User.php';
        
        $viewUser = new User();
        $viewUser->id = $id;
        $value_user = $viewUser->view();
        extract($value_user);
        echo "ID do usuário: $id <br>";
        echo "Nome do usuário: $nome <br>";
        echo "Número do usuário: $numero <br>";
        echo "Cidade do usuário: $cidade <br>";
    }else{
        $_SESSION['msg']= "<p style='color: #f00; '>Usuário não encontrado!<p>";
        header("Location: index.php");
    }

    ?>

</body>
</html>