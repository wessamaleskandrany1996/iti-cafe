<?php
require_once './DB.php';
$admin_id = $_REQUEST['admin-id'];

if(isset($_REQUEST['product-id'])){
$id = $_REQUEST['product-id'];

add_to_adminselects($id,$admin_id );
$orderItems = getAdminSelects($admin_id);

}

if(isset($_REQUEST['cancel-id'])){
$id = $_REQUEST['cancel-id'];

admin_cancelproduct($id);
}

if(isset($_REQUEST['increase-id'])){
$id = $_REQUEST['increase-id'];

admin_increaseAmount($id);

}
if(isset($_REQUEST['decrease-id'])){
$id = $_REQUEST['decrease-id'];

admin_decreaseAmount($id);
}


?>
