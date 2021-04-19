<?php
session_start();
include('connection.php');
include('consolelog.php');

$iconsdir = '/icons/';

$title = mysqli_real_escape_string($connection, trim($_POST['value-title']));
$description = mysqli_real_escape_string($connection, trim($_POST['value-description']));
$icon = mysqli_real_escape_string($connection, trim($iconsdir . $_FILES['icon-ref']['name']));

$uploaddir = realpath(dirname(__FILE__)) .'/icons/';
$uploadfile = $uploaddir . basename($_FILES['icon-ref']['name']);

try{
	if(!move_uploaded_file($_FILES['icon-ref']['tmp_name'], $uploadfile)){
		throw new Exception('Couldn\'t upload file!');
	}
	
}catch(Exception $error){
	$_SESSION['upload-icon-failed'] = true;
    exit;
}

$sql = "INSERT INTO valor (titulo, descricao, `icone-ref`, pessoa_idpessoa) VALUES ('$title', '$description', '$icon', '1')";

mysqli_query($connection, $sql);

if(mysqli_error($connection) != ""){
	echo mysqli_error($connection);
	exit;
}

$connection->close();

header('Location: form.php');

exit;