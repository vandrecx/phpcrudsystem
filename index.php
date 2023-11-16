<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JullyChic</title>
</head>
<body>

    <a href="index.php">Listar</a>
    <a href="create.php">Cadastrar</a>

    <h1>Listar Usuários</h1>
    
    <?php
    
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    require './Conn.php';
    require './User.php';

    $listUsers = new User();
    $result_users = $listUsers->list();

    foreach($result_users as $row_user){
        extract($row_user);

        echo "ID: $id <br>";
        echo "Nome: $nome <br>";

        echo "<a href='view.php?id=$id'>Visualizar</a><br>";
        echo "<a href='edit.php?id=$id'>Editar</a><br>";
        echo "<a href='delete.php?id=$id'>Delete</a><br>";

        echo "<hr>";
    }

    ?>

</body>
</html>