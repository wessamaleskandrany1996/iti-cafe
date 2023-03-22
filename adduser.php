<?php
session_start();
if (isset($_SESSION["adminId"])){
$id = $_SESSION["adminId"];

require('connection.php');
$files = $_FILES['img'];
$imgname = $files['name'];
move_uploaded_file($files['tmp_name'] , "$imgname");
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$room = $_REQUEST['room'];
$ext = $_REQUEST['ext'];
$query = "INSERT INTO rooms (number,ext) values ($room,$ext)";
$sql = $con->prepare($query);
$sql->execute();
$query1 = "SELECT id from rooms where number = $room ";
$sql1 = $con->prepare($query1);
$sql1->execute();
$int = $sql1->fetch(PDO::FETCH_ASSOC);
$integerIDs = implode('', $int);
$query2 = "INSERT INTO users (name,email,password,img,room_id,admin_id) VALUES ('$name','$email','$password','$imgname','$integerIDs',$id)";
$sql2 = $con->prepare($query2);
$sql2->execute();
header('location:showusers.php');
}else {
    header("location:adminlogin.php");
}