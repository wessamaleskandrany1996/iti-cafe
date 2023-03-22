<?php
session_start();
if (isset($_SESSION["adminId"])){
require('connection.php');
$query = "SELECT id,name,price,img,status FROM products ";
$sql = $con->prepare($query);
$sql->execute();
$products = $sql->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafe House</title>


    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link 
    rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="./ibrahim/css/style.css">


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
                        <img src="img/logo.png" alt="Logo" style="width: 50px; height: 50px;">
                        <h1 class="tm-site-name tm-handwriting-font">Cafe House</h1>
                    </div>
                    <div class="mobile-menu-icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <nav class="tm-nav ">
                        <ul class="nav ">
                            <li><a href="./showproducts.php" class="active  nav-link">products</a></li>
                            <li><a href="./showusers.php" class="nav-link" >Users</a></li>
                            <li><a href="./addproductform.php" class="nav-link">Add Product</a></li>
                           
                            <li><a href="./ibrahim/orders.php" class="nav-link">Show Orders</a></li>
                            <li><a href="./esraa/checks.php" class="nav-link">checks</a></li>
                            <li><a href="logout.php" class="nav-link">logout</a></li>
                        </ul>
                    </nav>   
                </div>           
            </div>    
        </div>
    </div>
    
    <section class="main-container">
        <h1>All products</h1>
        <table >
            <thead>
                <th>name</th>
                <th>price</th>
                <th>image</th>
                <th>action</th>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $product['name'] ?> </td>
                        <td><?php echo $product['price'] ?> </td>
                        <td><img style="height: 150px ;width: 200px;" src="<?php echo $product['img'] ?>"> </td>
                        <td>
                            <form>
                                <P>
                                    <?php echo $product['status']?>
                                </P> 
                                <a  class="btn btn-info" href='./editproductform.php?id=<?php echo ($product['id']);?>'>edit</a> 
                                <a class="btn btn-danger" href='./deleteproduct.php?id=<?php echo ($product['id']);?>'>delete</a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
   <script type="text/javascript" src="js/templatemo-script.js"></script><!-- Templatemo Script -->
</body>
</html>
<?php
}else {
    header("location:adminlogin.php");
}