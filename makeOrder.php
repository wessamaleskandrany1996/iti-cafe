<?php
require_once './DB.php';
$user_id = $_REQUEST['user-id'];

if(isset($_REQUEST['product-id'])){
$id = $_REQUEST['product-id'];

add_to_selects($id,$user_id);
$orderItems = getUserSelects($user_id);

}

if(isset($_REQUEST['cancel-id'])){
$id = $_REQUEST['cancel-id'];

cancelproduct($id);
}

if(isset($_REQUEST['increase-id'])){
$id = $_REQUEST['increase-id'];

increaseAmount($id);

}
if(isset($_REQUEST['decrease-id'])){
$id = $_REQUEST['decrease-id'];

decreaseAmount($id);
}


?>
