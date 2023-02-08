<?php 

    include('conexao.php');

    session_start();

    include('verificar_login.php');

    if($_SESSION['logado'] == false){
        header('Location: login.php');
    }

    if(isset($_POST['acao'])){
        session_destroy();
        header('Location: login.php');
    }

    $horario = date('Y-m-d H:i');

    $username = $_SESSION['usuario'];

    //query user
    $query_user = "SELECT * FROM logins WHERE usuario = '$username'";
    $result_user = mysqli_query($conn, $query_user);
    $linha_user = mysqli_fetch_assoc($result_user);

    //query selecionar posts
    $query_selecionar_posts = "SELECT * FROM posts ORDER BY horario DESC LIMIT 3000";
    $result_selecionar_posts = mysqli_query($conn, $query_selecionar_posts);

    //query selecionar acervo
    $query_selecionar_acervo = "SELECT * FROM acervo ORDER BY titulo ASC";
    $result_selecionar_acervo = mysqli_query($conn, $query_selecionar_acervo);

    

    if(isset($_POST['acao_posts'])){

        $titulo_post = $_POST['titulo_post'];
        $texto_post = $_POST['texto_post'];
        $autor = $username;
        $imagem_post = $_POST['imagem_post'];

        $query_novo_post = "INSERT INTO posts(titulo, descricao, imagem, autor, horario, status) VALUES ('$titulo_post','$texto_post','$imagem_post','$autor','$horario','1')";
        $result_novo_post = mysqli_query($conn, $query_novo_post);
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

        .acervo{
            display: flex;
        }

        /**Reset Bootstrap*/
        .dropdown-toggle::after {
            content: none;
            display: none;
        }</style>
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
        <form action="" method="POST">
                    <input type="hidden" name="acao" value="acao">
                    <input style="width: 80px;" type="submit" value="Sair" name="unlog">
                </form>
    </nav>


    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body" >
                        
                        <div class="h5"><img src="<?php echo $linha_user['foto'];?>" alt="Avatar" class="avatar"><?php echo "@". $linha_user['usuario'];?></div>
                        
                        <div class="h7 text-muted">Nome Completo : <?php echo $linha_user['nome'];?></div>
                        <br/>
                        <div class="h7">
                            <ul>
                                <li><b>Séries</b>: Friends, The Office, Game of Thrones</li>
                                <li><b>Filmes</b>: Creed II, Clube da Luta, O Show de Truman</li>
                                <li><b>Livros</b>: Harry Potter, It, A Coisa, Percy Jackson</li>
                            </ul>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Seguidores</div>
                            <div style="font-size: 24px;"><b><?php echo $linha_user['seguidores'];?></b></div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Seguindo</div>
                            <div style="font-size: 24px;"><b><?php echo $linha_user['seguindo'];?></b></div>
                        </li>
                        <li class="list-group-item"><i><?php echo $linha_user['descricao'];?></i></li>
                    </ul>  
                </div>

                

            </div>




            
            <div class="col-md-6 gedf-main">

            

                <!--- \\\\\\\ CRIAR NOVO Post-->
                <form action="home.php" method="POST">
                    <input type="hidden" name="acao_posts" value="acao_posts">
                    <div class="card gedf-card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Faça uma Publicação</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Imagens</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <input type="text" name="titulo_post" class="form-control" id="message" rows="3" placeholder="Título do Post"><br/>
                                        <input type="text" name="texto_post" class="form-control" id="message" rows="3" placeholder="No que você está pensando?"><br/>

                                        <div class="acervo">
                                            <p><b>Acervo:</b>
                                            <select name="midia">
                                                <option value="0" selected>Selecione um tópico</option>
                                                <?php while($linha_selecionar_acervo = mysqli_fetch_assoc($result_selecionar_acervo)){ ?>
                                                <option value="<?php echo $linha_selecionar_acervo['id'];?>"><?php echo $linha_selecionar_acervo['titulo'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" name="imagem_post" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Enviar Imagem</label>
                                        </div>
                                    </div>
                                    <div class="py-4"></div>
                                </div>
                            </div>
                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <input type="submit" name="compartilhar_post" class="btn btn-primary" value="Compartilhar">
                                </div>
                                <div class="btn-group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-globe"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Público</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Amigos</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Apenas Eu</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- CRIAR NOVO Post /////-->













                <!--- \\\\\\\LISTANDO Post-->

                <?php while($linha_posts = mysqli_fetch_assoc($result_selecionar_posts)){

                        $usuario_foto = $linha_posts['autor'];
                    
                        $query_foto_posts = "SELECT foto FROM logins WHERE usuario = '$usuario_foto'";
                        $result_foto_posts = mysqli_query($conn, $query_foto_posts);
                    
                    ?>

                    <?php $autor = $linha_posts['autor']; ?>

                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="<?php while($linha_foto_post = mysqli_fetch_assoc($result_foto_posts)){echo $linha_foto_post['foto'];} ?>" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0"><?php echo "<a href='profile.php?user=$autor'>@".$autor. "</a>"; ?></div>
                                    <div class="h7 text-muted">teste</div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        <a class="dropdown-item" href="#">Save</a>
                                        <a class="dropdown-item" href="#">Hide</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i><?php echo $linha_posts['horario'];?></div>
                        <a class="card-link" href="#">
                            <h5 class="card-title"><?php echo $linha_posts['titulo'];?></h5>
                        </a>
                        <img src=<?php echo $linha_posts['imagem'];?> height="450px" width="780px">
                        
                        <p class="card-text">
                            <br/>
                            <?php echo $linha_posts['descricao'];?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-link"><i class="fa fa-gittip"></i> Gostei</a>
                        <a href="#" class="card-link"><i class="fa fa-comment"></i> Comentar</a>
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Compartilhar</a>
                    </div>
                </div>

                <?php } ?>
                <!-- LISTANDO Post /////-->


                



            </div>
            <div class="col-md-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Séries</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Entre em uma conversa ou crie uma!</h6>
                        <p class="card-text">
                            <ul>
                                <li><a href="#"><b>The 100</b></a></li>
                                <li><a href="#"><b>Vikings</b></a></li>
                                <li><a href="#"><b>Modern Family</b></a></li>
                            </ul>
                        </p>
                        <a href="#" class="card-link">Ver Todas</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
                <div class="card gedf-card">
                        <div class="card-body">
                            <h5 class="card-title">Filmes</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Entre em uma conversa ou crie uma!</h6>
                            <p class="card-text">
                                <ul>
                                    <li><a href="#"><b>Brilho eterno de uma mente sem lembranças</b></a></li>
                                    <li><a href="#"><b>Top Gun: Maverick</b></a></li>
                                    <li><a href="#"><b>Harry Potter e as Relíquias da Morte: Parte 1</b></a></li>
                                </ul>
                            </p>
                            <a href="#" class="card-link">Ver Todas</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                    <div class="card gedf-card">
                        <div class="card-body">
                            <h5 class="card-title">Livros</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Entre em uma conversa ou crie uma!</h6>
                            <p class="card-text">
                                <ul>
                                    <li><a href="#"><b>A Arte da Guerra</b></a></li>
                                    <li><a href="#"><b>O Cemitério</b></a></li>
                                    <li><a href="#"><b>Maze Runner: A Cura Mortal</b></a></li>
                                </ul>
                            </p>
                            <a href="#" class="card-link">Ver Todas</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</body>
</html>

