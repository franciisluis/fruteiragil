<?php
    require_once('inc.connect.php');
    session_start();

    isset($_POST['user'])       and !empty($_POST['user'])      ? $user     = $_POST['user']        : $error = 1;
    isset($_POST['password'])   and !empty($_POST['password'])  ? $password = $_POST['password']    : $error = 1;

    if ($error == 1) {
        header('Location: inc.login.php?error='.$error);
        exit;
    }

    $md5password = md5($password);

    $query = 'SELECT id_usuario, nome_usuario FROM usuario WHERE nome_usuario = "'.$user.'" AND senha_usuario = "'.$md5password.'"';
    
    $res = mysql_query($query, $link);
    $qtd = mysql_num_rows($res);

    if($qtd > 0){
        $_SESSION['login']['user'] = $user;
        $_SESSION['login']['pass'] = $password;
        $_SESSION['login']['dtho'] = date("Y-m-d H:i:s");

        header('Location: index.php?pg=home');
        exit;

    }
    
    $error = 2;
    header('Location: inc.login.php?error='.$error);
    exit;

?>