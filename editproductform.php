<?php
session_start();
if (isset($_SESSION["adminId"])) {
include('connection.php');
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="./css/editStyle.css" rel="stylesheet">
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
                        <img src="img/logo.png" alt="Logo" class="tm-site-logo">
                        <h1 class="tm-site-name tm-handwriting-font">Cafe House</h1>
                    </div>
                    <div class="mobile-menu-icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <nav class="tm-nav">
                        <ul>
                            <li><a href="showusers.php" class="active  ws">Home</a></li>
                            <li><a href="./showproducts.php" class="ws">products</a></li>
                            <li><a href="./showusers.php" class="ws">Users</a></li>
                            <!-- <li><a href="#" class="ws">manual order</a></li> -->
                            <li><a href="#" class="ws">checks</a></li>
                            <li><a href="logout.php" class="ws">logout</a></li>
                        </ul>
                    </nav>   
                </div>           
            </div>    
        </div>
    </div>
    <br>
    <br>
    <?php 
        if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM products where id = $id";
        $sql = $con->prepare($query);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $name = $result['name'];
        $price = $result['price'];
        $img = $result['img'];
        }
    ?>
    <form action="./editproduct.php" method="POST" enctype="multipart/form-data" class="editForm">
        <input type="hidden" name="productid" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="name">Name </label>
            <input  class="form-control" type="text" Name="name" value="<?php echo $name ?>">
        </div>
        <div class="form-group">
            <label for="Price">Price</label>
            <input type="number" min="1"  class="form-control" name="Price" value="<?php echo $price ?>" >
        </div>
        <div class="form-group">
            <label for="" name="img">Image</label>
            <input type="text" class="form-control" name="img" value="<?php echo $img ?>">
        </div>
        <button type="submit"class="w-50 tm-more-button btn  btn-lg"  value="update" name="update">Edit</button>
    </form>
</body>
</html>
<?php 
}else {
    header("location:adminlogin.php");
}