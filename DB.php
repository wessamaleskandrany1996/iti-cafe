<?php
      require_once 'connection.php';


function getUsers(){
  global $con;
  $query = "SELECT * FROM users";
   $sql = $con->prepare($query);
   $sql->execute();
   return $sql->fetchAll(PDO::FETCH_ASSOC);
        
}
function getProducts()
    {
      global $con;
       $query = "SELECT * FROM products";
        $sql = $con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        
    }
   
    function FindfromSelects($id){
      global $con;
     $query = "SELECT * FROM selects WHERE product_id = $id";
        $sql = $con->prepare($query);
          $sql->execute();
          return $sql->fetchAll(PDO::FETCH_ASSOC);
       
    }
 function add_to_selects($id,$user_id){
              $productSelected = FindFromSelects($id);
               
                if($productSelected == null){
                 return insertIntoSelects($id,$user_id,'1');
               
                }else{
                 return increaseAmount($id);
              
                }
            }

    function insertIntoSelects($id,$user_id,$amount){
      global $con;
       $query = "INSERT INTO selects (`product_id`,`user_id`,`amount`)
        VALUES ($id,$user_id,$amount)";
        $sql = $con->prepare($query);
       return $sql->execute();
    }
    function increaseAmount($id){
      global $con;
       $query = "UPDATE selects SET amount=amount+1 WHERE product_id=$id";
        $sql = $con->prepare($query);
       return $sql->execute();
    }
    function decreaseAmount($id){
      global $con;
       $query = "UPDATE selects SET amount=amount-1 WHERE product_id=$id";
        $sql = $con->prepare($query);
       return $sql->execute();
    }
 
    function getUserSelects($user_id){
       global $con;
       $query = "SELECT product_id ,name,amount,price FROM products , selects
        WHERE products.id = selects.product_id and user_id = $user_id ";
        $sql = $con->prepare($query);
        $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function cancelproduct($product_id){
       global $con;
       $query = "DELETE from selects where product_id=$product_id";
        $sql = $con->prepare($query);
         $result= $sql->execute();
         echo $result;
    }

    function getRooms(){
      global $con;
      $query = "SELECT * FROM rooms";
        $sql = $con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
      
    }

    function insertOrder($total,$user_id,$room_id,$note){
       global $con;
      $query = "INSERT INTO orders (`total`,`user_id`,`room_id`,`note`)
        VALUES ($total,$user_id,$room_id,'$note')";
        $sql = $con->prepare($query);
         return $sql->execute();
         
        
    }
    function lastId(){
      global $con;
      $query = "SELECT max(id) as 'lastId' FROM orders";
        $sql = $con->prepare($query);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function insertOrderProduct($order_id,$product_id,$amount){
       global $con;
      $query = "INSERT INTO orderproduct (`order_id`,`product_id`,`amount`)
        VALUES ($order_id,$product_id,$amount)";
        $sql = $con->prepare($query);
         return $sql->execute();   
    }

      function emptyUserSelects($user_id){
       global $con;
       $query = "DELETE from selects where user_id=$user_id";
        $sql = $con->prepare($query);
         return $sql->execute();
         
    }
    function getLastUserOrder($user_id){
      global $con;
      $query = "SELECT id FROM orders WHERE user_id=$user_id
       ORDER by created_at DESC LIMIT 1";
        $sql = $con->prepare($query);
          $sql->execute();
           return $sql->fetch(PDO::FETCH_ASSOC);
    }
    function getLastOrderProducts($lastOrderId){
      global $con;
      $query = "SELECT p.id, p.name,p.img, p.price from orderproduct,products p
      where product_id = p.id and order_id = $lastOrderId";
        $sql = $con->prepare($query);
          $sql->execute();
           return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    // --------------------------------admin tables ------------------------
   function getAdminSelects($admin_id){
     global $con;
       $query = "SELECT product_id ,name,amount,price FROM products , adminselects
        WHERE products.id = adminselects.product_id and adminselects.admin_id = $admin_id ";
        $sql = $con->prepare($query);
        $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);
   }
   function emptyAdminSelects($admin_id){
      global $con;
       $query = "DELETE from adminselects where admin_id=$admin_id";
        $sql = $con->prepare($query);
         return $sql->execute();
   }
   function insert_adminmakeorder($admin_id,$user_id,$order_id){
        global $con;
      $query = "INSERT INTO adminmakeorder (`admin_id`,`user_id`,`order_id`)
        VALUES ($admin_id,$user_id,$order_id)";
        $sql = $con->prepare($query);
         return $sql->execute();
   }
    function FindfromAdminSelects($id){
      global $con;
     $query = "SELECT * FROM adminselects WHERE product_id = $id";
        $sql = $con->prepare($query);
          $sql->execute();
          return $sql->fetchAll(PDO::FETCH_ASSOC);
       
    }
    function add_to_adminselects($id,$admin_id){
              $productSelected = FindFromAdminSelects($id);
               
                if($productSelected == null){
                 return insertIntoAdminSelects($id,$admin_id,'1');
               
                }else{
                 return increaseAmount($id);
              
                }
            }

    function insertIntoAdminSelects($id,$admin_id,$amount){
      global $con;
       $query = "INSERT INTO adminselects (`product_id`,`admin_id`,`amount`)
        VALUES ($id,$admin_id,$amount)";
        $sql = $con->prepare($query);
       return $sql->execute();
    }
    function admin_increaseAmount($id){
      global $con;
       $query = "UPDATE adminselects SET amount=amount+1 WHERE product_id=$id";
        $sql = $con->prepare($query);
       return $sql->execute();
    }
    function admin_decreaseAmount($id){
      global $con;
       $query = "UPDATE adminselects SET amount=amount-1 WHERE product_id=$id";
        $sql = $con->prepare($query);
       return $sql->execute();
    }
    function admin_cancelproduct($product_id){
       global $con;
       $query = "DELETE from adminselects where product_id=$product_id";
        $sql = $con->prepare($query);
         $result= $sql->execute();
         echo $result;
    }


    ?>