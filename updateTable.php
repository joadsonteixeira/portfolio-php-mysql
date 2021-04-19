<?php
session_start();
include('connection.php');
include('consolelog.php');

$sql = "SELECT * FROM valor";
$result = mysqli_query($connection, $sql);

while(mysqli_fetch_array($result)){
    $id = $result['idvalor'];
};
