<?php
  
  require_once '../connection.php';
//===========get all orders without filteration=============

      function getAllOrders()
      {
        global $con;
        $query = "SELECT sum(total) as sum,u.name,o.id as order_id,o.user_id,o.created_at,u.id, u.admin_id	
       FROM `orders` as o,`users` AS u where o.user_id =u.id
       GROUP BY o.user_id";
        $sql = $con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        
      }
      //===========get all orders by date=============

      function filterOrdersFromTo( $from, $to)
       {
        global $con;
        $query = "SELECT sum(total) as summ,u.name,o.id as order_id,o.user_id,o.created_at,u.id, u.admin_id	
        FROM `orders` as o,`users` AS u where o.user_id =u.id
        and o.created_at BETWEEN '$from' AND '$to'
        GROUP BY o.user_id";
        $sql = $con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        
       }
//===========get all orders by date and specific user=============

    function filterOrderByIDFromTo($from, $to,$user)
    {
      global $con;
        $query = "SELECT u.name ,o.id as order_id,o.user_id ,o.created_at ,u.id , u.admin_id,o.total 		
        FROM `orders` as o,`users` AS u 
        where o.user_id =u.id And u.id =$user
        and o.created_at BETWEEN '$from' AND '$to'
        ";
         $sql = $con->prepare($query);
         $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);
        
    }
    function getSumNameUser($user)
    {
      global $con;
      $query = "SELECT sum(total) as sum,u.name ,o.id as order_id,o.user_id ,o.created_at ,u.id , u.admin_id,o.total
       FROM `orders` as o,`users` AS u
        where o.user_id=u.id AND o.user_id=$user";
       $sql = $con->prepare($query);
       $sql->execute();
       return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    //===========display orders for user when I click=============

    function getOrderByID($id)
    {
        global $con;
        $query = "SELECT u.name ,o.id as order_id,o.user_id ,o.created_at ,u.id , u.admin_id,o.total 
        FROM `orders` as o,`users` AS u 
        where o.user_id=u.id AND o.user_id=$id";
         $sql = $con->prepare($query);
         $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);
        
    }
    function getSumName($id)
    {
      global $con;
      $query = "SELECT sum(total) as sum,u.name ,o.id as order_id,o.user_id ,o.created_at ,u.id , u.admin_id,o.total FROM `orders` as o,`users` AS u where o.user_id=u.id AND o.user_id=$id";
       $sql = $con->prepare($query);
       $sql->execute();
       return $sql->fetchAll(PDO::FETCH_ASSOC);
      
    }
    //===========display orders for user when I click=============
    function getOrdersForUser($from, $to)
    {
      global $con;
        $query = "SELECT DISTINCT *	
        FROM `orders` as o,`users` AS u, `orderproduct` AS op where o.user_id =u.id
        and o.created_at BETWEEN '$from' AND '$to'
        group by o.created_at
        ";
         $sql = $con->prepare($query);
         $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);
        
    }
    // getAllOrderproducts
   function getOrderproduct($order_id)
   {
    global $con;
        $query = "SELECT DISTINCT op.order_id,p.id, p.img,p.price,op.amount FROM `orders` as o,`products` AS p, orderproduct op where op.order_id =o.id AND p.id=op.product_id AND op.order_id=$order_id
        ";
         $sql = $con->prepare($query);
         $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);
   }
  