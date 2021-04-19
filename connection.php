<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'root');
define('DATABASE', 'portfolio');

$connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE) or die ("Unable to connect to database");