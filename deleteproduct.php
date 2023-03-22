<?php
require('connection.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    echo($id);
    $query = "DELETE from products where id = $id";
    $sql = $con->prepare($query);
    $sql->execute();
    $query1 = "DELETE from adminselects where product_id = $id";
    $sql1 = $con->prepare($query1);
    $sql1->execute();
    $query2 = "DELETE from orderproduct where product_id = $id";
    $sql2 = $con->prepare($query2);
    $sql2->execute();
    $query3 = "DELETE from selects where product_id = $id";
    $sql3 = $con->prepare($query3);
    $sql3->execute();
}
header('location:./showproducts.php');