<?php
session_start();
include('connection.php');
include('consolelog.php');

$imagesdir = '/uploads/';

$person = mysqli_real_escape_string($connection, trim($_POST['person-name']));
$email = mysqli_real_escape_string($connection, trim($_POST['person-email']));
$phone = mysqli_real_escape_string($connection, trim($_POST['person-phone']));
$linkedin = mysqli_real_escape_string($connection, trim($_POST['person-linkedin']));
$github = mysqli_real_escape_string($connection, trim($_POST['person-github']));
$avatar = mysqli_real_escape_string($connection, trim($imagesdir . $_FILES['avatar-ref']['name']));

$uploaddir = realpath(dirname(__FILE__)) .'/uploads/';
$uploadfile = $uploaddir . basename($_FILES['avatar-ref']['name']);

try{
	if(!move_uploaded_file($_FILES['avatar-ref']['tmp_name'], $uploadfile)){
		throw new Exception('Couldn\'t upload file!');
	}
	
}catch(Exception $error){
	$_SESSION['upload-failed'] = true;
}


$sql = "select count(*) as total from pessoa where idpessoa = 1";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 0) {
	$sql = "INSERT INTO pessoa (idpessoa, nome, email, celular, `avatar-ref`) VALUES (1,'$person', '$email', '$phone', '$linkedin', $github, '$avatar')";
}else{
	$sql = "update pessoa set nome = '$person', email = '$email', celular = '$phone', linkedin = '$linkedin', github = '$github', `avatar-ref` = '$avatar' where idpessoa = 1";
}

mysqli_query($connection, $sql);

if(mysqli_error($connection) != ""){
	echo mysqli_error($connection);
	exit;
}

$connection->close();

header('Location: form.php');

exit;