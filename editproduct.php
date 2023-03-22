<?php
include ('connection.php');
if(isset($_POST['update'])){
    $productid = $_POST['productid'];
    $name = $_POST['name'];
    $price = $_POST['Price'];
    $img = $_POST['img'];
        $query = " UPDATE products 
        SET name=:name , img=:img , price=:price 
        WHERE id=:productid ";
        $statement = $con->prepare($query);
        $data = [
            ':name'=>$name,
            ':price'=>$price,
            ':img'=>$img,
            ':productid'=>$productid
        ];
        $ws = $statement->execute($data);
            header('location:showproducts.php');
        
    }
?>