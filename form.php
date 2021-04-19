<?php
session_start();
include('connection.php');

function updateValues($connection, $sql){
    return mysqli_query($connection, $sql);
}

$sql_user = "select * from pessoa where idpessoa = 1";
$results = mysqli_query($connection, $sql_user);
$person = mysqli_fetch_assoc($results);


if($person['nome'] != null && $person['nome'] != "") {
    $_POST['person-name'] = $person['nome'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link rel="icon" href="img/favicon.png">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
        <header class="overflow-hidden" id="navbar">
            <div id="logo"><a href="index.php">
                    <h1>SITE</h1>
                </a></div>

            <div id="menu">
                <ul>
                    <a href="index.php">
                        <li>HOME</li>
                    </a>
                    <a href="index.php#contato">
                        <li>CONTATO</li>
                    </a>
                    <a href="index.php#valores">
                        <li>SOBRE</li>
                    </a>
                    <a href="form.php">
                        <li>ADMIN</li>
                    </a>
                </ul>
            </div>
        </header>

    <div class="vw-100 d-flex flex-row justify-content-center overflow-hidden">
        <section>
            <div class="my-3 mx-4" style="width: 25vw">

                <h2>Informação pessoal</h2>

                <form enctype="multipart/form-data" action="register.php" method="POST">
                    <label for="person-name">Nome</label>
                    <br>
                    <input class="w-100 mb-3" id="person-name" placeholder="Nome" type="text" name="person-name" 
                    <?php if($person['nome'] != null && $person['nome'] != "") {
                        echo "value=\"" . $person['nome'] . "\"";
                    }  ?> >
                    <br>
                    <label for="person-phone">Contato</label>
                    <br>
                    <input class="w-100 mb-3" name="person-phone" type="text" id="person-phone" placeholder="Celular" type="tel" maxlength="15"
                    <?php if($person['celular'] != null && $person['celular'] != "") {
                        echo "value=\"" . $person['celular'] . "\"";
                    }  ?>>
                    <br>
                    <label for="person-email">E-mail</label>
                    <br>
                    <input class="w-100 mb-3" name="person-email" placeholder="Email" type="email" 
                    <?php if($person['email'] != null && $person['email'] != "") {
                        echo "value=\"" . $person['email'] . "\"";
                    }  ?>>
                    <br>
                    <label for="person-linkedin">LinkedIn</label>
                    <br>
                    <input class="w-100 mb-3" name="person-linkedin" placeholder="LinkedIn" type="url" 
                    <?php if($person['linkedin'] != null && $person['linkedin'] != "") {
                        echo "value=\"" . $person['linkedin'] . "\"";
                    }  ?>>
                    <br>
                    <label for="person-github">GitHub</label>
                    <br>
                    <input class="w-100 mb-3" name="person-github" placeholder="Github" type="url" 
                    <?php if($person['github'] != null && $person['github'] != "") {
                        echo "value=\"" . $person['github'] . "\"";
                    }  ?>>
                    <br>
                    <label for="avatar-ref">Foto</label>
                    <br>
                    <div class="m-3" style="width: 80px; height:80px;border-radius:50%; overflow: hidden;">
                        <img style="width: 100%" src="<?php echo $person['avatar-ref'] ?>" alt="Avatar">
                    </div>
                    <input class="custom-file custom-file-input mb-3" name="avatar-ref" type="file">
                    <?php
                    if(isset($_SESSION['upload-failed'])):
                    ?>
                    <div class="alert alert-danger">
                        <p>ERRO: Não foi possível carregar a imagem selecionada.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['upload-failed']);
                    ?>
                    <br>
                    <button type="submit" class="btn btn-primary w-100">Salvar</button>
                </form>
            </div>
        </section>
        <section id="values">
            <div class="my-3 mx-4" style="width: 25vw">
                <form enctype="multipart/form-data" action="handleValues.php" method="POST">
                    <h2>Valores</h2>
                    <label for="value-title">Título</label>
                    <br>
                    <input class="w-100 mb-3" name="value-title" placeholder="Título" type="text">
                    <br>
                    <label for="value-description">Descrição</label>
                    <br>
                    <textarea class="w-100 mb-3" name="value-description" placeholder="Descrição" type="text"></textarea>
                    <br>
                    <label for="icon-ref">Ícone</label>
                    <br>
                    <input class="w-100 mb-3" class="custom-file-input" name="icon-ref" type="file">
                    <?php
                    if(isset($_SESSION['upload-icon-failed'])):
                    ?>
                    <div class="alert alert-danger">
                        <p>ERRO: Não foi possível carregar a imagem selecionada.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['upload-icon-failed']);
                    ?>
                    <br>
                    <button type="submit" class="btn btn-primary mb-3 w-100">Salvar</button>
                </form>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ícone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * from valor";
                        $result = updateValues($connection, $sql);
                        while($row = mysqli_fetch_array($result)){ 
                            echo '<tr><th scope="row">'.$row['idvalor'].'</th>
                            <td>'.$row['titulo'].'</td>
                            <td>'.$row['descricao'].'</td>
                            <td style="display: flex; flex-direction: column;align-items:center"><img style="width: 40px; height: auto" src="'.$row['icone-ref'].'">'.$row['icone-ref'].'</td>
                            </tr>';
                        }
                            ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="projects">
            <div class="my-3 mx-4" style="width: 25vw">
                <form enctype="multipart/form-data" action="handleProjects.php" method="POST" >
                    <h2>Projetos</h2>
                    <label for="project-title">Título</label>
                    <input class="w-100 mb-3" placeholder="Título" name="project-title" type="text">
                    <br>
                    <label for="project-description">Descrição</label>
                    <textarea class="w-100 mb-3" placeholder="Descrição" name="project-description" type="text"></textarea>
                    <br>
                    <label for="image-ref">Imagem</label>
                    <input class="w-100 mb-3" name="image-ref" type="file">
                    <?php
                    if(isset($_SESSION['upload-icon-failed'])):
                    ?>
                    <div class="alert alert-danger">
                        <p>ERRO: Não foi possível carregar a imagem selecionada.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['upload-image-failed']);
                    ?>
                    <br>
                    <button type="submit" class="btn btn-primary mb-3 w-100">Salvar</button>
                </form>
            
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ícone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * from projeto";
                        $result = updateValues($connection, $sql);
                        while($row = mysqli_fetch_array($result)){ 
                            echo '<tr><th scope="row">'.$row['idprojeto'].'</th>
                            <td>'.$row['titulo'].'</td>
                            <td>'.$row['descricao'].'</td>
                            <td style="display: flex; flex-direction: column;align-items:center"><img style="width: 80px; height: auto;" src="'.$row['imagem-ref'].'">'.$row['imagem-ref'].'</td>
                            </tr>';
                        }
                            ?>
                    </tbody>
                </table>
            </div>

        </section>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#person-phone').mask("(00) 00000-0000")
    </script>
</body>
</html>