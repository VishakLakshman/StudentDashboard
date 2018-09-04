<?php

//$hostname = "dbproject.cvcxhrez8fjl.us-west-2.rds.amazonaws.com";
//$username = "mithun";
//$password = "mithunjmistry";

$hostname = "localhost";
$username="root";
$password = "root";

$connection = mysqli_connect($hostname, $username, $password);

if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
    echo 'connection failed';
}
$select_db = mysqli_select_db($connection, 'mydb');
if (!$select_db){
    echo 'db selection failed';
    die("Database Selection Failed" . mysqli_error($connection));
}