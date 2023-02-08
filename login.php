<?php 

    include('conexao.php');

    session_start();

    include('verificar_login.php');

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Patronum | Faça o Login ou Registre-se</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>


<div class="box">
    <div class="form">
        <form action="login.php" method="POST">
        <input type="hidden" name="acao" value="acao">

            <h2>Patronum</h2>
            <div class="inputBox">
                <input name="user" type="text" required>
                <span>Nome de Usuário</span> <i></i>
            </div>
            <div class="inputBox">
                <input name="pass" type="Password" required>
                <span>Senha</span> <i></i>
            </div>
            <div class="links">
                <br><br>    <a href="#">Esqueceu a Senha?</a>

                <a href="registro.php">Registre-se</a>
            </div>
            <input type="submit" value="Login" class="c">
        </form>
    </div>
</div>

</body>
</html>