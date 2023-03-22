<?php 
    session_start();
    if (isset($_SESSION["adminId"])) {
   
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
                        <li><a href="#" class="active">add category</a></li>
                        <li><a href="logout.php" >logout</a></li>
                    </ul>
                </nav>   
            </div>           
        </div>    
    </div>
</div>

    <div class="container my-5">
        <form class="m-auto text-center " action="addcategory.php" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-sm-6"><br><br><br><br><br><br>
                <label for="productTitle" class="form-label tm-handwriting-font1">Category name:</label>
                <input type="text" class="form-control " name="name" required="">
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <button class="w-50 tm-more-button btn  btn-lg"  type="submit">Add Category</button>
        </form>
    </div>
</body>
</html>
<?php
}else {
    header("location:adminlogin.php");
}