<?php

session_start();
ob_start();

//Receber o id da URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//Verificar se o id possui valor
if(!empty($id)){
    require './Conn.php';
    require './User.php';

    //Instanciar a classe e criar objeto
    $deleteUser = new User();

    //Enviar o id para o atributo da classe User
    $deleteUser->id = $id;

    //Instanciar método apagar
    $value = $deleteUser->delete();

    if($value){
        $_SESSION['msg']= "<p style='color: green;'>Usuário apagado com sucesso!<p>";
        header("Location: index.php");
    }else{
        $_SESSION['msg']= "<p style='color: #f00;'>Usuário não apagado!<p>";
        header("Location: index.php");
    }

}else{
    $_SESSION['msg']= "<p style='color: #f00;'>Usuário não encontrado!<p>";
    header("Location: index.php");
}

?>