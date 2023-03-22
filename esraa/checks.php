<?php
session_start();
if (isset($_SESSION["adminId"])) {
require_once './checksDb.php';



//===========get all orders without filteration=============
if(empty($_GET)){

  $sumname=getAllOrders();
}
//===========filter orders by date=============

if(isset($_REQUEST['from'])&&isset($_REQUEST['User'])&&$_REQUEST['User']=="All"){

  $filteredOrders=filterOrdersFromTo($_REQUEST['from'],$_REQUEST['to']); 
}
//===========filter orders by date and specific user=============
if (isset($_REQUEST['User'])&&isset($_REQUEST['from'])&&$_REQUEST['User']!="All") {
  
  $allOrders=filterOrderByIDFromTo($_REQUEST['from'],$_REQUEST['to'],$_REQUEST['User']);
  
  $sumname=getSumNameUser($_REQUEST['User']);
}
//===========display orders for user when I click=============

if (isset($_REQUEST['id'])){
  $allOrders=getOrderByID($_REQUEST['id']);
  
  $sumname=getSumName($_REQUEST['id']);
  
}
//get order products
if (isset($_REQUEST['order_id'])){
  $allOrderproducts=getOrderproduct($_REQUEST['order_id']);
}
//===========display orders for user when I click with filteration=============
if (isset($_REQUEST['id'])&& isset($_REQUEST['from'])){
  $allOrders=getOrdersForUser($_REQUEST['from'],$_REQUEST['to']);
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cafe House - Food and Drink Checks</title>
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
  

  </head>
  <body>
    <!-- Preloader -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Preloader -->
    <div class="tm-top-header">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="../img/logo.png" alt="Logo" class="tm-site-logo">
              <h1 class="tm-site-name tm-handwriting-font">Cafe House</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
                <li><a href="../showusers.php">Home</a></li>
                <li><a href="checks.php" class="active">Checks</a></li>
                <li><a href="../logout.php">logout</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    <section class="tm-welcome-section">
      <div class="container tm-position-relative">
        <div class="tm-lights-container">
          <img src="../img/light.png" alt="Light" class="light light-1">
          <img src="../img/light.png" alt="Light" class="light light-2">
          <img src="../img/light.png" alt="Light" class="light light-3">  
        </div>        
        
    </section>
    <br><br><br>
    <div class="tm-main-section light-gray-bg">
      <div class="container" id="main">
                 
    <section class="tm-section row">
        <div class="col-lg-12 tm-section-header-container margin-bottom-30">
          <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="../img/logo.png"  alt="Logo" class="tm-site-logo"> Checks</h2>
          <div class="tm-hr-container"><hr class="tm-hr"></div>
         </div>
         <div>
          <form action="">
              <label for="from">From:</label>
              <input type="date" id="from" name="from" value="<?php 
              if (isset($_REQUEST['from'])) {
                echo $_REQUEST['from'];
              }
              ?>">
  
              <label for="to">To:</label>
              <input type="date" id="to" name="to" value="<?php 
              if (isset($_REQUEST['to'])) {
                echo $_REQUEST['to'];
              }?>">
    
              <label>User</label>
              <select name="User" value="<?php 
              if (isset($_REQUEST['User'])) {
              echo $_REQUEST['User'];} 
              if (isset($_REQUEST['id'])) {
                echo $_REQUEST['id'];} ?>">
              
              <option>All</option>
              <?php  if(isset($sumname))
              {foreach($sumname as $order): ?>
              <option value="<?php echo $order['id']; ?>"><?php echo $order['name']; ?></option>
              <?php endforeach; }?>
              </select>
        
              <input type="submit">
              <br><br>
          </form>
          <br><br>
        </div>
        <div>
          <div class="col-lg-3 col-md-3">
          <div class="tm-position-relative margin-bottom-30">  
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Users</th>
                  <th scope="col">Total amount</th>
                </tr>
              </thead>   

              <!-- display all orders with filteration -->
           
                  <?php  if(isset($filteredOrders)){foreach($filteredOrders as $order): ?>
              <tbody>
                    <tr>
                      <td><a href="http://localhost/ITIcafe/esraa/checks.php?from=<?php echo $_REQUEST['from'] ?>&to=<?php echo $_REQUEST['to'] ?>&id=<?php echo $order['user_id'] ?>">

                         <?php echo $order['name']; ?> </a></td>
                      <td><?php echo $order['summ']; ?></td>
                      
                    </tr>
                    <?php endforeach; }?>
                    <!-- display all orders without filteration -->
                    <?php  if(isset($sumname)){foreach($sumname as $order): ?>
                  <tbody>
                    <tr>

                      <td><a href="http://localhost/ITIcafe/esraa/checks.php?id=<?php echo $order['user_id'] ?>"> "<?php
                       echo $order['name']; ?>" </a></td>
                      <td>"<?php 
                      
                      echo $order['sum'];  ?>"</td>
                      
                    </tr>
                    <?php endforeach; }?>
                  </tbody>
                </table>  
              </div>  
            </div>            
           
            <div class="tm-product">
              <h2 class="tm-section-header gold-text tm-handwriting-font">user order</h2>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Order date</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(isset($_REQUEST['id'])&&isset($_REQUEST['from'])){foreach($allOrders as $allOrder): ?>

              <tr>
                
                <td><a  href="http://localhost/ITIcafe/esraa/checks.php?from=<?php echo $_REQUEST['from'] ?>&to=<?php echo $_REQUEST['to'] ?>&order_id=<?php echo $allOrder['order_id'] ?>&id=<?php echo $_REQUEST['id'] ?>"> <?php if ($allOrder['user_id'] == $_REQUEST['id']) {
                  echo $allOrder['created_at'];
                } ?></td>
                <td><?php if ($allOrder['user_id']==$_REQUEST['id']) {
                  echo $allOrder['total'];
                } ?></a></td>
                
              </tr>
              <?php endforeach; }?>
              <?php  if(isset($_REQUEST['id'])&& !isset($_REQUEST['from'])){foreach($allOrders as $allOrder): ?>

              <tr>
                
                <td><a  href="http://localhost/ITIcafe/esraa/checks.php?&order_id=<?php echo $allOrder['order_id'] ?>&id=<?php echo $_REQUEST['id'] ?>"> <?php if ($allOrder['user_id'] == $_REQUEST['id']) {
                  echo $allOrder['created_at'];
                } ?></td>
                <td><?php if ($allOrder['user_id']==$_REQUEST['id']) {
                  echo $allOrder['total'];
                } ?></a></td>
                
              </tr>
              <?php endforeach; }?>
              <!-- filter by date and user -->
              <?php  if(isset($_REQUEST['User'])&&$_REQUEST['User']!="All"){foreach($allOrders as $allOrder): ?>

              <tr>
  
               <td><a href="http://localhost/ITIcafe/esraa/checks.php?from=<?php echo $_REQUEST['from'] ?>&to=<?php echo $_REQUEST['to'] ?>&order_id=<?php echo $allOrder['order_id'] ?>&User=<?php echo $_REQUEST['User'] ?>" ><?php if ($allOrder['user_id']==$_REQUEST['User']) {
                 echo $allOrder['created_at'];
               } ?></a></td>
               <td><?php if ($allOrder['user_id']==$_REQUEST['User']) {
                 echo $allOrder['total'];
               } ?></td>
               
             </tr>
             <?php endforeach; }?>
             
              
            </tbody>
          </table>  
          </div>        
        </section>
      </div>
    </div> 
    <div class="tm-product">
              <h2 class="tm-section-header gold-text tm-handwriting-font">The order</h2>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product Image</th>
                <th scope="col">Price</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(isset($_REQUEST['order_id'])){foreach($allOrderproducts as $allOrder): ?>

              <tr>
                
                <td><img src="../<?php  echo $allOrder['img']; ?>" width="100" height="100"></td>
                <td><?php  echo $allOrder['price']; ?></a></td>
                
              </tr>
              <?php endforeach; }?>
              
            </tbody>
          </table>  
          </div>        
        </section>
      </div>
    </div> 
    <footer>
      <div class="tm-black-bg">
        <div class="container">
          <div class="row margin-bottom-60">
            <nav class="col-lg-3 col-md-3 tm-footer-nav tm-footer-div">
              <h3 class="tm-footer-div-title">Main Checks</h3>
              <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Directory</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Our Services</a></li>
              </ul>
            </nav>
            <div class="col-lg-5 col-md-5 tm-footer-div">
              <h3 class="tm-footer-div-title">About Us</h3>
              <p class="margin-top-15">Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.</p>
              <p class="margin-top-15">Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.</p>
            </div>
            <div class="col-lg-4 col-md-4 tm-footer-div">
              <h3 class="tm-footer-div-title">Get Social</h3>
              <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante.</p>
              <div class="tm-social-icons-container">
                <a href="#" class="tm-social-icon"><i class="fa fa-facebook"></i></a>
                <a href="#" class="tm-social-icon"><i class="fa fa-twitter"></i></a>
                <a href="#" class="tm-social-icon"><i class="fa fa-linkedin"></i></a>
                <a href="#" class="tm-social-icon"><i class="fa fa-youtube"></i></a>
                <a href="#" class="tm-social-icon"><i class="fa fa-behance"></i></a>
              </div>
            </div>
          </div>          
        </div>  
      </div>      
      <div>
        <div class="container">
          <div class="row tm-copyright">
           <p class="col-lg-12 small copyright-text text-center">Copyright &copy; 2084 Your Cafe House</p>
         </div>  
       </div>
     </div>
   </footer> <!-- Footer content-->  
   <!-- JS -->
   <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>      
   <script type="text/javascript" src="../js/templatemo-script.js"></script>      <!-- Templatemo Script -->
   
 </body>
 </html>
 <?php 
}
else {
  header("location:../adminlogin.php");
}

 ?>