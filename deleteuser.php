<?php
require('connection.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE from users where id = $id";
    $query1 = "DELETE from selects where selects.user_id = $id";
    $query2 = "DELETE from orders where orders.user_id = $id";
    
    $query3 = "DELETE from adminmakeorder where adminmakeorder.user_id = $id";
    $sql = $con->prepare($query);
    $sql1 = $con->prepare($query1);
    $sql2 = $con->prepare($query2);
    $sql3 = $con->prepare($query3);
    
    $sql1->execute();
    $sql2->execute();
    $sql3->execute();
    $sql->execute();

}
header('location:./showusers.php');