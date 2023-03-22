<?php
  require_once '../connection.php';
$id = $_REQUEST['id'];
$query = "DELETE FROM orderproduct WHERE order_id = $id";
$sql = $con->prepare($query);
$res = $sql->execute();
$query1 = "DELETE FROM orders WHERE id = $id";
$sql1 = $con->prepare($query1);
$res1 = $sql1->execute();
header("location:index.php");