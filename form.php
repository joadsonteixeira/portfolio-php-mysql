<?php
session_start();
include('connection.php');

function updateValues($connection, $sql){
    return mysqli_query($connection, $sql);
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body class="vh-100 vw-100 container-fluid mx-auto d-flex flex-column align-items-center">
    <section id="personal" class="vw-20">
        <div class="mb-3" style="width: 500px">

            <h2>Informação pessoal</h2>

            <form enctype="multipart/form-data" action="register.php" method="POST">
                <label for="person-name">Nome</label>
                <br>
                <input class="w-100 mb-3" id="person-name" placeholder="Nome" type="text" name="person-name" >
                <br>
                <label for="person-phone">Contato</label>
                <br>
                <input class="w-100 mb-3" id="person-phone" name="person-phone" type="text" name="person-phone"placeholder="Celular" type="text">
                <br>
                <label for="person-email">E-mail</label>
                <br>
                <input class="w-100 mb-3" name="person-email" placeholder="Email" type="email" >
                <br>
                <label for="avatar-ref">Foto</label>
                <br>
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
        <div class="mb-3" style="width: 500px">
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
            <br>
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
        <div class="mb-3" style="width: 500px">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>