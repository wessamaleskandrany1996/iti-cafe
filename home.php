
<?php
session_start();
if(isset($_SESSION['userId'])){
  $login_id= $_SESSION["userId"];
  $userName= $_SESSION["userName"];

require_once './DB.php';

$products = getProducts();
$orderItems = getUserSelects($login_id);
$rooms = getRooms();

function calculateTotal(){
  global $orderItems;
   $total=0;
  foreach($orderItems as $item){
    $total += $item['amount']*$item['price'];
  }
  return $total;

}
$lastOrderId = getLastUserOrder(4);
// var_dump($lastOrderId);die;
if ($lastOrderId != null ){

  $lastOrderProducts = getLastOrderProducts($lastOrderId['id']);
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
                <li><a href="./home.php" class="active"> Home </a></li>
                <li><a href="./ibrahim/index.php"> My Orders </a></li>
                <li><a href="./logout.php"> logout</a></li>
                <li style="padding-top:15px; padding-left: 50px;">welcome <?= $userName?></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    <section class="tm-welcome-section">
      <div class="container tm-position-relative">
        <div class="tm-lights-container">
          <img src="img/light.png" alt="Light" class="light light-1">
          <img src="img/light.png" alt="Light" class="light light-2">
          <img src="img/light.png" alt="Light" class="light light-3">  
        </div>        
        <div class="row tm-welcome-content">
          <h2 class="white-text tm-handwriting-font tm-welcome-header"><img src="img/header-line.png" alt="Line" class="tm-header-line">&nbsp;Welcome,<?php echo $userName ?>!&nbsp;&nbsp;<img src="img/header-line.png" alt="Line" class="tm-header-line"></h2>
          <h2 class="gold-text tm-welcome-header-2">Cafe House</h2>
          <p class="gray-text tm-welcome-description">Cafe House template is a <span class="gold-text">mobile-friendly</span> responsive Bootstrap v3.3.5 layout by <span class="gold-text">templatemo</span>. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculusnec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
          <a href="#main" class="tm-more-button tm-more-button-welcome">Read More</a>      
        </div>
        <img src="img/table-set.png" alt="Table Set" class="tm-table-set img-responsive">
      </div>      
    </section>
    
    <div class="tm-main-section light-gray-bg" style="padding-top: 94px;">
      <div class="container" id="main" style="max-width:1500px ;" >
<!--/////////////////////////////// latest order ////////////////////////////////////-->
        <section class="tm-section tm-section-margin-bottom-0 row">
          <div class="col-lg-12 tm-section-header-container">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo">
              Latest Order</h2>
            <div class="tm-hr-container">
              <hr class="tm-hr">
            </div>
          </div>
          <div class=" col-lg-12 tm-popular-items-container" style="justify-content:flex-start;margin-bottom: -52px">
            <?php 
              if ($lastOrderId != null ){
            foreach($lastOrderProducts as $product):
             ?>
          <div class="">
              <img src="<?php echo $product['img'];?>" alt="Popular" class="tm-popular-item-img">
              <div class="tm-popular-item-description">
                <h3 class="tm-handwriting-font tm-popular-item-title"><?php echo $product['name']?></h3>
                <hr class="tm-popular-item-hr">
                <p><?php echo $product['price']?></p>
               
              </div>
            </div>
           <?php endforeach;};
            
       ?>
          </div>
        </section>
      
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
                <input id="user_login" type="hidden" name="user_login" value="<?= $login_id?>">
                <table id="orderRow" style="width:80%">
                  <?php foreach($orderItems as $item):?>
                   <tr >
                  <td> 
                   <h2>
                   <?php echo $item['name']?>
                   </h2>
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
                 <h2><input id="price" type="hidden" value="<?php echo $item['price']?>"><?php echo $item['price'] . '$'?></h2>
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
          <div class="row">
            <div class="col-lg-12">
              <div class="tm-section-header-container">
                <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo">Menu</h2>
                <div class="tm-hr-container "><hr class="tm-hr "></div>
              </div>

              <div class=" tm-popular-items-container">
                <div class="products">
                    <?php foreach($products as $product): ?>
                      <div class="col-lg-6">
                        <h4><?php echo $product['name']?></h4>
                        <button class="img-circle select-product"
                          data-product-id="<?php echo $product['id']?>" 
                          style="border:0px;">
                          <img src="<?php echo $product['img'];?>" 
                          class="img-circle" style="width:100px;height:100px" >
                        </button>
                        <h4>price <?php echo $product['price']?>$</h4>
                       </div>
                        <?php endforeach ;?>
              </div> 
              </div>
            </div>

          
            
            
        </div>
      </div>
    </section>
   <!-- JS -->
   <script src="./js/makeOrder.js"></script>
   <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
   <script type="text/javascript" src="js/templatemo-script.js"></script><!-- Templatemo Script -->
 </body>
 </html>
 <?php 
}
else {
  header("location:index.php");
}
?>