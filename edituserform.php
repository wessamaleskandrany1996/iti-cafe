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
                            <li><a href="showusers.php" >Home</a></li>
                            <li><a href="./showproducts.php" >products</a></li>
                            <li><a href="./esraa/checks.php" >checks</a></li>
                            <li><a href="logout.php" >logout</a></li>
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
        $userid = $_GET['id'];
        $query= "SELECT name,img,number,ext FROM users,rooms WHERE users.id =:userid AND room_id=rooms.id";
        $statement = $con->prepare($query);
        $data = [':userid'=>$userid];
        $statement->execute($data);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $name = $result['name'];
        $number = $result['number'];
        $img = $result['img'];
        $ext = $result['ext'];
    }
    ?>

    <form action="edituser.php" class="editForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
        <div class="form-group">
            <label for="name">Name </label>
            <input  class="form-control" type="text" name="name" value="<?php echo $name ?>">
        </div>
        <div class="form-group">
            <label for="room">Room </label>
            <input type="number" min="1" class="form-control" name="number" value="<?php echo $number; ?>">
        </div>
        <div class="form-group">
            <label for="" name="img">Image</label>
            <input type="text" class="form-control" name="img" value="<?php echo $img; ?>">
        </div>
        <div class="form-group">
            <label for="ext">Ext</label>
            <input type="number" min="1"  class="form-control" name="ext" value="<?php echo $ext; ?>">
        </div>
        <button type="submit"class="w-50 tm-more-button btn  btn-lg"  value="update" name="update">Edit</button>
    </form>
</body>
</html>
<?php 
}else {
    header("location:adminlogin.php");
}