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
    <title>Editar</title>
</head>
<body>

    <a href="index.php">Listar</a>
    <a href="create.php">Cadastrar</a>

    <h1>Editar Usuário</h1>
    
    <?php
    
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    require './Conn.php';
    require './User.php';

    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($formData['SendEditUser'])){
        $editUser = new User();
        $editUser->formData = $formData;
        $value = $editUser->edit();
        if($value){
            $_SESSION['msg']= "<p style='color: green; '>Usuário editado com sucesso!<p>";
            header("Location: index.php");
        }else{
            echo "<p style='color: #f00; '>Usuário não editado!<p>";
        }
    }

    if(!empty($id)){
        $viewUser = new User();
        $viewUser->id = $id;
        $value_user = $viewUser->view();
        extract($value_user);
        
        ?>

    <form name="EditUser" method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <label for="">Nome:</label>
        <input type="text" name="nome" placeholder="Digite seu nome" required>
        <br><br>

        <label for="">Número:</label>
        <input type="text" name="numero" placeholder="(XX)XXXXX-XXXX" required>
        <br><br>

        <label for="">Cidade:</label>
        <input type="text" name="cidade" placeholder="Cidade-UF" required>
        <br><br>

        <input type="submit" value="Editar" name="SendEditUser">
    </form>

    
    <?php

    }else{
        $_SESSION['msg']= "<p style='color: #f00; '>Usuário não encontrado!<p>";
        header("Location: index.php");
    }

    ?>

</body>
</html>