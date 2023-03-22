<?php
require('connection.php');
session_start();
$id = $_SESSION["adminId"]; 
$name = $_REQUEST['name'];
$query = "INSERT INTO category (name,admin_id) VALUES ('$name','$id')";
$sql = $con->prepare($query);
$sql->execute();
header('location:./addproductform.php');