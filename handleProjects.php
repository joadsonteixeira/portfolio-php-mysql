<?php
session_start();
include('connection.php');
include('consolelog.php');

$imagesdir = '/images/';

$title = mysqli_real_escape_string($connection, trim($_POST['project-title']));
$description = mysqli_real_escape_string($connection, trim($_POST['project-description']));
$image = mysqli_real_escape_string($connection, trim($imagesdir . $_FILES['image-ref']['name']));

$uploaddir = realpath(dirname(__FILE__)) .'/images/';
$uploadfile = $uploaddir . basename($_FILES['image-ref']['name']);

try{
	if(!move_uploaded_file($_FILES['image-ref']['tmp_name'], $uploadfile)){
		throw new Exception('Couldn\'t upload file!');
	}
	
}catch(Exception $error){
	$_SESSION['upload-image-failed'] = true;
    exit;
}

$sql = "INSERT INTO projeto (titulo, descricao, `imagem-ref`, pessoa_idpessoa) VALUES ('$title', '$description', '$image', '1')";

mysqli_query($connection, $sql);

if(mysqli_error($connection) != ""){
	echo mysqli_error($connection);
	exit;
}

$connection->close();

header('Location: form.php');

exit;