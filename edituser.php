<?php
include ('connecion.php');
if(isset($_POST['update'])){
    $userid = $_POST['userid'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $img = $_POST['img'];
    $ext = $_POST['ext'];
    try{
        $query = "UPDATE users,rooms 
        SET name=:name , img=:img , number=:number , ext=:ext 
        WHERE users.id=:userid 
        AND room_id = rooms.id";
        $statement = $con->prepare($query);
        $data = [
            ':name'=>$name,
            ':number'=>$number,
            ':img'=>$img,
            ':ext'=>$ext,
            ':userid'=>$userid
        ];
        $ws = $statement->execute($data);
        if ($ws) {
            header('location:showusers.php');
        }else{
            header('location:showusers.php');
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>