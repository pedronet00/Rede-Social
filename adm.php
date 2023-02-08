<?php 

    include('conexao.php');

    session_start();

    include('verificar_login.php');

    if(isset($_POST['acao'])){
        session_destroy();
        header('Location: login.php');
    }

    if(isset($_POST['acao_livro'])){

        $nome_livro = $_POST['nome_livro'];
        $autor_livro = $_POST['autor_livro'];

        $query_inserir = "INSERT INTO livros(titulo, autor) VALUES ('$nome_livro','$autor_livro')";
        $result_inserir = mysqli_query($conn, $query_inserir);

        $query_inserir_acervo = "INSERT INTO acervo(titulo, tipo) VALUES ('$nome_livro','Livro')";
        $result_inserir_acervo = mysqli_query($conn, $query_inserir_acervo);
    } else{

        if(isset($_POST['acao_serie'])){

            $nome_serie = $_POST['nome_serie'];
            $temporadas = $_POST['temporadas'];
            $diretor_serie = $_POST['diretor_serie'];
    
            $query_inserir = "INSERT INTO series(titulo, temporadas, diretor) VALUES ('$nome_serie','$temporadas','$diretor_serie')";
            $result_inserir = mysqli_query($conn, $query_inserir);

            $query_inserir_acervo = "INSERT INTO acervo(titulo, tipo) VALUES ('$nome_serie','Série')";
            $result_inserir_acervo = mysqli_query($conn, $query_inserir_acervo);
        } else{

            if(isset($_POST['acao_filme'])){

                $nome_filme = $_POST['nome_filme'];
                $duracao_filme = $_POST['duracao'];
                $diretor_filme = $_POST['diretor_filme'];
        
                $query_inserir = "INSERT INTO filmes(titulo, diretor, duracao) VALUES ('$nome_filme','$diretor_filme','$duracao_filme')";
                $result_inserir = mysqli_query($conn, $query_inserir);

                $query_inserir_acervo = "INSERT INTO acervo(titulo, tipo) VALUES ('$nome_filme','Filme')";
                $result_inserir_acervo = mysqli_query($conn, $query_inserir_acervo);
            }
        }
    }

    

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Patronum | Página Inicial</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>

<style>

        body {
            background-color: #44464f;
        }

        .h7 {
            font-size: 0.8rem;
        }

        .gedf-wrapper {
            margin-top: 0.97rem;
        }

        @media (min-width: 992px) {
            .gedf-main {
                padding-left: 4rem;
                padding-right: 4rem;
            }
            .gedf-card {
                margin-bottom: 2.77rem;
            }
        }

        .avatar {
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
        }

        .h5{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /**Reset Bootstrap*/
        .dropdown-toggle::after {
            content: none;
            display: none;
        }

        .pai{
            display: flex;
            margin-left: 14%;
            margin-top: 10%;
        }
        
        .criar_livro{
            width: 400px;
            height: 300px;
            background-color: white;
            text-align: center;
            border-radius: 20px;
        }

        .criar_filme{
            width: 400px;
            height: 300px;
            background-color: white;
            margin-left: 5%;
            text-align: center;
            border-radius: 20px;
        }

        .criar_serie{
            width: 400px;
            height: 300px;
            background-color: white;
            margin-left: 5%;
            text-align: center;
            border-radius: 20px;
        }

        h1{
            text-align: center;
        }
        
        </style>
<body>
       
<nav class="navbar navbar-light" style="background-color: #23242a; text-align: center;">
    <a href="#" style="color: white; font-size: 24px; font-weight: bold; ">Patronum</a>
        <form class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" aria-label="Recipient's username"  value="Pesquisar" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
</nav>

<h1 style="color: white;">ADMINISTRAÇÃO</h1>

<div class="pai">

        

    <div class="criar_livro">

        <br/>

        <h3>Adicionar um novo Livro</h3>

        <br/>

            <form method="POST" action="">
                <input type="hidden" name="acao_livro" value="acao_livro">
                <input type="text" name="nome_livro" placeholder="Nome do Livro"><br/><br/>
                <input type="text" name="autor_livro" placeholder="Autor do Livro"><br/><br/>
                <input type="submit" value="Salvar" name="salvar_livro"><br/>
            </form>
    </div>

    <div class="criar_serie">

        <br/>

        <h3>Adicionar uma nova Série</h3>

        <br/>

        <form method="POST" action="">
            <input type="hidden" name="acao_serie" value="acao_serie">
            <input type="text" placeholder="Nome da Série" name="nome_serie"><br/><br/>
            <input type="text" placeholder="Quant. de Temporadas" name="temporadas"><br/><br/>
            <input type="text" placeholder="Diretor" name="diretor_serie"><br/><br/>
            <input type="submit" value="Salvar" name="salvar_serie">
        </form>
    </div>

    <div class="criar_filme">

        <br/>

        <h3>Adicionar um novo Filme</h3>

        <br/>

        <form method="POST" action="">
            <input type="hidden" name="acao_filme" value="acao_filme">
            <input type="text" placeholder="Nome do Filme" name="nome_filme"><br/><br/>
            <input type="text" placeholder="Duração" name="duracao"><br/><br/>
            <input type="text" placeholder="Diretor" name="diretor_filme"><br/><br/>
            <input type="submit" value="Salvar" name="salvar_filme">
        </form>

    </div>

</div>

<form action="" method="POST">
    <input type="hidden" name="acao" value="acao">
    <input style="width: 80px;" type="submit" value="Sair" name="unlog">
</form>

</body>
</html>