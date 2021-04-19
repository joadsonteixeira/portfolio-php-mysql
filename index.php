<?php
    include('connection.php');

    function grid_item_component($project){
        return '<div class="card project col-3">
                    <img class="mx-auto card-image" src="'.$project['icon-ref'].'" alt="competence">
                    <div class="">
                        <h5 class="port-title">'.$project['title'].'</h5>
                        <p class="port-text">'.$project['description'].'</p>
                    </div>
                </div>';
    }

    $sql_person = "select * from pessoa where idpessoa = 1";
    $result = mysqli_query($connection, $sql_person);
    $person = mysqli_fetch_assoc($result);

    $sql_values = "select * from valor";
    $values = mysqli_query($connection, $sql_values);

    $sql_proj = "select * from projeto";
    $projects = mysqli_query($connection, $sql_proj);
    
    


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joadson Teixeira | Portfólio</title>
    <link rel="icon" href="img/favicon.png">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>


<body>
    <div>

        <header id="navbar">
            <div id="logo"><a href="#">
                    <h1>SITE</h1>
                </a></div>

            <div id="menu">
                <ul>
                    <a href="">
                        <li>HOME</li>
                    </a>
                    <a href="">
                        <li>CONTATO</li>
                    </a>
                    <a href="#valores">
                        <li>SOBRE</li>
                    </a>
                    <a href="form.php">
                        <li>ADMIN</li>
                    </a>
                </ul>
            </div>
        </header>

        <div id="container">
            <section id="cover">
                <div id="personal">
                    <div id="image-container">
                        <img src="<?php echo $person['avatar-ref'] ?>" alt="Foto do perfil">
                    </div>
                    <div id="intro">
                        <h1>Olá, eu sou <?php echo $person['nome'] ?> </h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut consectetur massa, nec dapibus mauris. Integer dictum lorem vitae magna mattis faucibus.</p>
                    </div>

                </div>
                <div id="details">

                </div>
            </section>

            <section id="valores">
                <div id="cards" class="container-fluid row justify-content-md-center">
                    <?php 
                        while ($value = mysqli_fetch_array($values)){ ?>
                            <div class="card col-sm-4">
                                <img class="mx-auto card-icon" src="<?php echo $value['icone-ref'] ?>" alt="competence">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><?php echo $value['titulo'] ?></h5>
                                    <p class="card-text text-center"><?php echo $value['descricao'] ?></p>
                                </div>
                            </div>
                        <?php
                        };
                    ?>
                </div>
            </section>

            <section id="portfolio">
                <div>
                    <h2>Meu Portfólio</h2>
                    <h5>Conheça alguns de meus trabalhos</h5>
                    <div class="portfolio">
                        <div id="grid" class="container row">

                        <?php 
                            while($project = mysqli_fetch_array($projects)){ ?>
                                <div class="card project col-3">
                                    <div class="card-image-container">
                                        <img class="mx-auto card-image" src="<?php echo $project['imagem-ref'] ?>" alt="competence">
                                    </div>
                                    <div class="">
                                        <h5 class="port-title"><?php echo $project['titulo'] ?></h5>
                                        <p class="port-text"><?php echo $project['descricao'] ?></p>
                                    </div>
                                </div>
                            <?php
                            }
                        ?>
                        </div>
                    </div>

                </div>
            </section>

        </div>

        <section id="contato">
            <footer id="footer-container" class="container row">
                <div class="col-sm footer-title">
                    <h5>Contato</h5>
                    <p>Celular: <?php echo $person['celular'] ?></p>
                    <p>E-mail: <?php echo $person['email'] ?></p>
                </div>

                <div class="col-sm footer-title">
                    <h5>Redes Sociais</h5>
                    <a class="text-light fw-bold" href="<?php echo $person['github'] ?>" target="_blank">GitHub</a>
                    <br>
                    <a class="text-light fw-bold" href="<?php echo $person['linkedin'] ?>" target="_blank">LinkedIn</a>
                </div>
            </footer>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>

</html>