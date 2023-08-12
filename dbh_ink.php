<?php


$servername='localhost';
$hostname='root';
$password='';
$database='book';

$conn = mysqli_connect($servername, $hostname, $password, $database);

if(!($conn)){

    die("Connection Failed:" . mysqli_connect_error());
}

?>