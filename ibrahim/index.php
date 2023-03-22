<?php
session_start();
if(isset($_SESSION['userId'])){
  $user=$_SESSION['userId'];
  require_once '../connection.php';

if (!empty($_REQUEST["to"])) {
    $to = ($_REQUEST['to']);
    $from = ($_REQUEST['from']);
    $que = "SELECT * FROM orders where user_id=$user
    AND (created_at BETWEEN '". $from ." 00:00:01' and '". $to ." 23:59:59' )  order by id DESC ";
    $sql = $con->prepare($que);
    $sql->execute();
    $orders = $sql->fetchAll(PDO::FETCH_ASSOC);

}else {
    $to = "2022-12-31";
    $from = "2022-1-1";
    $que = "SELECT * FROM orders where user_id=$user and (created_at BETWEEN '". $from ." 00:00:01' and '". $to ." 23:59:59') order by id DESC";
    $sql = $con->prepare($que);
    $sql->execute();
    $orders = $sql->fetchAll(PDO::FETCH_ASSOC);
}
$total = 0;
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel = "stylesheet" href = "./css/style.css">
</head>
<body>
    <div class="tm-top-header">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="../img/logo.png" style="width: 50px; height: 50px;" alt="Logo" class="tm-site-logo">
              <h1 class="tm-site-name tm-handwriting-font">Cafe House</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
                <li><a href="../home.php" class="ws">Home</a></li>
                <li><a href="../logout.php" class="ws">logout</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    <section class="main-container">
        <h1>My Orders</h1>
        <form action = ""  method = "POST" enctype="multipart/form-data" class="search-data">
            <label for = "from">from</label>
            <input type = "date" id = "from" name = "from">
            <label for = "to"> to </label>
            <input type = "date" id = "to" name = "to">
            <input type = "submit">
        </form>
        <table class="table-order">
            <thead>
                <th>Order Date</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php if(!empty($orders)) {
                    foreach ($orders as $order) :?>
                    <tr>
                        <td id = "show">
                            <?= $order["created_at"] ?>
                            <form action = "" method = "POST" class="orderDate">
                                <input type = "hidden" name = "id" value = "<?= $order["id"]; ?>">
                                <input type = "submit" value ="+" class="show-image">
                            </form>
                        </td>
                        <td>
                            <?= $order["status"] ?>
                        </td>
                        <td>
                            <?= $order["total"]."EG"?>
                        </td>
                        <td>
                            <?php if($order["status"] == "in processing"):?>
                                <form action="./cancel.php" class="">
                                  <input type = "hidden" name ='id' value = "<?= $order["id"];?>">
                                  <button  class = "cancel" data-id=<?= $order["id"];?>>Cancel</button>
                                </form>
                            <?php endif; ?> 
                        </td>
                    </tr>
                    <?php 
                    $total += $order["total"];
                    ?>
                <?php endforeach ;} ?>
            </tbody>
        </table>
        <div class="products">
        <?php 
            if (!empty($_REQUEST['id'])){
                $id = $_REQUEST['id'];
                $query = "SELECT img, price from products where id in (SELECT product_id from orderproduct where order_id =$id) ";
                $sql = $con->prepare($query);
                $sql->execute();
                $images = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($images as $img):?>
                
                    <div class="product">
                        <div class="title">
                            <span>tea</span>
                        </div>
                        <img src = "<?= $img["img"] ?>" alt="">
                        <div class="salary">
                            <span >34 EL</span>
                        </div>
                    </div>
            <?php endforeach;
        }?>
        </div>
        <p class="total">Total <?= $total; ?></p>
    </section>
    <footer>
      <div class="tm-black-bg">
        <div class="container">
          <div class="row margin-bottom-60">
            <nav class="col-lg-3 col-md-3 tm-footer-nav tm-footer-div">
              <h3 class="tm-footer-div-title">Main Menu</h3>
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
</body>
</html>
<?php 
}
else{
  header('location:../index.php') ;
} 
?>
<script src = "./cancelOrder.js"></script>




