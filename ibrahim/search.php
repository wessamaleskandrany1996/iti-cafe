<?php
  require_once '../connection.php';
if (!empty($_REQUEST)) {
    $to =($_REQUEST['to']);
    $from =($_REQUEST['from']);
    $que = "SELECT * FROM orders where (created_at BETWEEN '". $from ." 00:00:01' and '". $to ." 23:59:59') order by id asc";
    $sql = $db->prepare($que);
    $sql->execute();
    $orders = $sql->fetchAll(PDO::FETCH_ASSOC);
    // header('Location: ' . $_SERVER['HTTP_REFERER'],true);

}else {
    $to = "2022-5-31";
    $from = "2022-1-1";
    $que = "SELECT * FROM orders where (created_at BETWEEN '". $from ." 00:00:01' and '". $to ." 23:59:59') order by id DESC";
    $sql = $db->prepare($que);
    $sql->execute();
    $orders = $sql->fetchAll(PDO::FETCH_ASSOC);   
}
