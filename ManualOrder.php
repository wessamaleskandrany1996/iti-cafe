<!--------------------------------------- Manual order ------------------------------->
<?php
require_once './DB.php';
$
$users = getUsers();
$products = getProducts();
$orderItems = getAdminSelects($login_id);
$rooms = getRooms();

 
function calculateTotal(){
  global $orderItems;
   $total=0;
  foreach($orderItems as $item){
    $total += $item['amount']*$item['price'];
  }
  return $total;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cafe House</title>
<!-- 
Cafe House Template
http://www.templatemo.com/tm-466-cafe-house
-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <style>
    h2,h3{
      display: inline-block;
    }
  </style>
  </head>
  <body>
    <div class="tm-top-header">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="img/logo.png" alt="Logo" class="tm-site-logo">
              <h1 class="tm-site-name tm-handwriting-font">Cafe House</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
                <li><a href="home.html" class="active"> Home </a></li>
                <li><a href=" logout.php"> logout</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    <div class="tm-main-section light-gray-bg" style="padding-top: 94px;">
      <div class="container" id="main" style="max-width:1500px ;" >
 <!--////////////////////////// make order ///////////////////////////////////////////-->
      <section class="tm-section tm-section-margin-bottom-0 row">
            <div class="col-lg-6 col-md-6">
            <div class="tm-section-header-container">
              <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo"> Make Order </h2>
              <div class="tm-hr-container">
                <hr class="tm-hr">
              </div>
            </div>
            <form  action="confirmOrder.php" method="POST" class="tm-contact-form">
                <input id="admin_login" type="hidden" name="admin_login" value="<?php echo $login_id?>">
                <table id="orderRow" style="width:80%">
                  <?php foreach($orderItems as $item):?>
                   <tr >
                  <td> 
                   <h2>
                   <?php echo $item['name']?> </h2>
                  </td>
                   <td>
                      <div class="form-group" style="width:40px ;display:inline-block;">
                      <button type="button" class="form-control decreaseAmount" data-decrease-id=
                      "<?php echo $item['product_id']?>"> - </button></div>
                   </td>
                <td><div class="form-group" style="width:80px ;display:inline-block;">
                <input type="text" class="form-control" value="<?php echo $item['amount']?>" readonly/>
                 </div>
                </td>
                <td>
                  <div class="form-group" style="width:40px ;display:inline-block;">
                   <button type="button" class="form-control increaseAmount" data-increase-id=
                      "<?php echo $item['product_id']?>"> + </button></div>
                </td>
                <td>
                 <h2><input type="hidden" value="<?php echo $item['price']?>"><?php echo $item['price'] . '$'?></h2>
                </td>
                <td>
                  <div class="form-group" style="width:40px ;display:inline-block;">
                   <button type="button" class="form-control cancel-product" data-cancel-id=
                   "<?php echo $item['product_id']?>"> X </button></div>
                </td>
                 </tr>
                 <?php endforeach ?>
                </table>
                <div class="form-group">
                  <h2> User </h2>
                <select name="user_id" class="form-control" style="width:30%;display:inline-block;">
                  <?php foreach($users as $user):?>
                  <option value="<?php echo $user['id']?>"><?php echo $user['id']?></option>
                  <?php endforeach?>
                </select>
                  <h2> Room </h2>
                <select name="room_id" class="form-control" style="width:30%;display:inline-block;">
                  <?php foreach($rooms as $room):?>
                  <option value="<?php echo $room['id']?>"><?php echo $room['number']?></option>
                  <?php endforeach?>
                </select>
               </div>
               <div class="form-group">
                <textarea name="order_note" class="form-control" rows="6" style="width:80%;" placeholder="Note" value=""></textarea>
               </div> 
                <div class="tm-hr-container"><hr class="tm-hr"></div>
                <div class="form-group" >
                  <h2> Total: </h2>
                <h3><input type="hidden" name="total" value="<?php echo calculateTotal()?>"><?php echo calculateTotal() .'$'?></h3>
               </div> 
                <div class="form-group">
                <button class="tm-more-button" type="submit"> Confirm </button> 
                </div>
            </form>
          </div>
          <!-- ///////////////////// products ////////////////////// -->
          
        <div class="col-lg-6">
          <div class="tm-section-header-container">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo">Menu</h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>
          <div class=" tm-popular-items-container">
            <?php foreach($products as $product): ?>
              
                <h4><?php echo $product['name']?></h4>
                  <button class="img-circle select-product" data-product-id="<?php echo $product['id']?>" style="border:0px;">
                  <img src="<?php echo $product['img'];?>" class="img-circle" ></button>
                   <h4><?php echo $product['price']?></h4>
          
              <?php endforeach ;?>
          </div> 
            
        </div>
    </section>
  
   <!-- JS -->
   <script src="js/makeOrder.js"></script>
   <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
   <script type="text/javascript" src="js/templatemo-script.js"></script><!-- Templatemo Script -->

 </body>
 </html>