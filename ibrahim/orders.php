<?php
session_start();
if (isset($_SESSION["adminId"])) {
  require_once '../connection.php';

$query = "SELECT created_at, name, orders.room_id as Room, ext, status, orders.id from orders
            inner join rooms on orders.room_id = rooms.id
            inner join users on orders.user_id = users.id ";
$sql = $con->prepare($query);
$sql->execute();
$orders = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>orders</title>


    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link 
    rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css//editStyle.css">
    <link rel = "stylesheet" href = "./css/style.css">
    
</head>
<body>
<div class="tm-top-header">
        <div class="container">
            <div class="row">
                <div class="tm-top-header-inner">
                    <div class="tm-logo-container">
                        <img src="../img/logo.png" alt="Logo" style="width: 50px; height: 50px;">
                        <h1 class="tm-site-name tm-handwriting-font">Cafe House</h1>
                    </div>
                    <div class="mobile-menu-icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <nav class="tm-nav ">
                        <ul class="nav ">
                          <li><a href="../showusers.php" class="active nav-link">Home</a></li>
                          <li><a href="../showproducts.php" class="nav-link">Products</a></li>
                          <li><a href="../addproductform.php" class="nav-link">Add Product</a></li>
                          <li><a href="../logout.php" class="nav-link">logout</a></li>
                        </ul>
                      </nav>   
                    </div>           
                  </div>    
                </div>
              </div>
    <section class="main-container">
        <h1>Orders</h1>
        <?php foreach($orders as $order): ?>
        <table>
            <thead>
                <th>Order Date</th>
                <th>Name</th>
                <th>Room</th>
                <th>Ext</th>
                <th>ِAction</th>
            </thead>
            <tbody>
                    <tr>
                        <td><?= $order["created_at"] ?></td>
                        <td><?= $order["name"] ?></td>
                        <td><?= $order["Room"] ?></td>
                        <td><?= $order["ext"] ?></td>
                        <td><?= $order["status"] ?></td>
                    </tr>
            </tbody>
        </table>
        <div class="products">
            <?php 
                $order_id = $order["id"];
                    $query2 = "SELECT * from products 
                        inner join orderproduct on products.id = orderproduct.product_id
                        inner join orders where orders.id =$order_id";  
                    $sql = $con->prepare($query2);
                    $sql->execute();
                    $imagesO = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($imagesO as $pro):
                      ?>      
                      <div class="product">
                          <div class="title">
                              <span><?= $pro["name"] ?></span>
                          </div>
                          <img src = "../<?= $pro["img"] ?>" alt="<?= $pro["img"] ?>">
                          <div class="salary">
                              <span ><?= $pro["price"]?> EL</span>
                          </div>
                      </div>
                    <?php endforeach; ?>
                <p class="total" style="">Total:<?= $pro["total"] ?></p>  
              <?php endforeach; ?>
              </div>
        
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
    </footer>  
</body>
</html>
<?php 
}
else {
  header("location:../adminlogin.php");
}
?>