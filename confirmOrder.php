<?php
require_once './DB.php';

if(isset($_REQUEST['user_login'])){

$user_login=$_REQUEST['user_login'];
insertOrder($_REQUEST['total'],$user_login,$_REQUEST['room_id'],$_REQUEST['order_note']);

$lastId = lastId();
$orderId = $lastId['lastId'];
$orderItems =getUserSelects($user_login);

foreach($orderItems as $item){
    insertOrderProduct($orderId,$item['product_id'],$item['amount']);
}
emptyUserSelects($user_login);
}

else if(isset($_REQUEST['admin_login'])){

 $admin_login = $_REQUEST['admin_login'];
insertOrder($_REQUEST['total'],$admin_login,$_REQUEST['room_id'],$_REQUEST['order_note']);

$lastId = lastId();
$orderId = $lastId['lastId'];  

$orderItems =getAdminSelects($admin_login);
foreach($orderItems as $item){
    insertOrderProduct($orderId,$item['product_id'],$item['amount']);
    insert_adminmakeorder($admin_id,$_REQUEST['user_id'],$orderId);
}
emptyAdminSelects($admin_login);
}


?>
