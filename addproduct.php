<?php
require('connection.php');
session_start();
$admin=$_SESSION["adminId"];
$files = $_FILES['img'];
$imgname = $files['name'];
move_uploaded_file($files['tmp_name'] , "$imgname");
$name = $_REQUEST['name'];
$price = $_REQUEST['price'];
$category = $_REQUEST['category'];
$query1 = "SELECT id from category WHERE name = '$category'";
$sql1 = $con->prepare($query1);
$sql1->execute();
$int = $sql1->fetch(PDO::FETCH_ASSOC);
$integerIDs = implode('', $int);
$category_id = $integerIDs ;
$query = "INSERT INTO products (name,price,img,category_id,admin_id) VALUES ('$name',$price,'$imgname', $category_id , $admin )";
$sql = $con->prepare($query);
$sql->execute();
header('location:./showproducts.php');