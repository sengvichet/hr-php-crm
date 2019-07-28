<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

function connectDB($host, $user, $pass, $db)
{
$link = mysqli_connect($host, $user, $pass, $db) or die("Error! ".mysqli_error($link));
return $link;
}
?>