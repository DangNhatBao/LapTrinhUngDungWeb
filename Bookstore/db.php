<?php
    $severname = 'localhost';
    $username = 'root';
    $pass = '123456';
    $dbname = 'nhasach';
    $conn = new mysqli($severname, $username, $pass, $dbname);
    if ($conn -> connect_error){
        die("Connection failed: ".$conn -> connect_error);
    }
?>