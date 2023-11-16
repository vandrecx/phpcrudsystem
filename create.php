<?php

session_start();
ob_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
</head>
<body>

    <a href="index.php">Listar</a>
    <a href="create.php">Cadastrar</a>

    <h1>Cadastrar Usuários</h1>
    
    <?php
    
    require './Conn.php';
    require './User.php';
    
    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($formData['SendAddUser'])){
        //var_dump($formData);
        $createUser = new User();
        $createUser->formData = $formData;
        $value = $createUser->create();

        if($value){
            $_SESSION['msg']= "<p style='color: green'>Usuário cadastrado com sucesso!<p>";
            header("Location: index.php");
        }else{
            echo "<p style='color: #f00;'>Erro: Usuário não cadastrado!<p>";
        }
    }

    ?>

    <form name="CreateUser" method="POST" action="">
        <label for="">Nome:</label>
        <input type="text" name="nome" placeholder="Digite seu nome" required>
        <br><br>

        <label for="">Número:</label>
        <input type="text" name="numero" placeholder="(XX)XXXXX-XXXX" required>
        <br><br>

        <label for="">Cidade:</label>
        <input type="text" name="cidade" placeholder="Cidade-UF" required>
        <br><br>

        <input type="submit" value="Cadastrar" name="SendAddUser">
    </form>

</body>
</html>