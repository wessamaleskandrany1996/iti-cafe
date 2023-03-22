<?php
session_start();
if (isset($_SESSION["adminId"])){
  require('connection.php');
  $query = "SELECT users.id,name,img,number,ext FROM users,rooms WHERE room_id = rooms.id";
  $sql = $con->prepare($query);
  $sql->execute();
  $users = $sql->fetchAll(PDO::FETCH_ASSOC);
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
      <link href="css/templatemo-style.css" rel="stylesheet">
      <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
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
                <img src="img/logo.png" alt="Logo" class="tm-site-logo" style="height:50px; width: 50px;">
                <h1 class="tm-site-name tm-handwriting-font">Cafe House</h1>
              </div>
              <div class="mobile-menu-icon">
                <i class="fa fa-bars"></i>
              </div>
              <nav class="tm-nav">
              
                <ul>
                  
                  <li><a href="addusers.php"> add user</a></li>
                  <li><a href="./ibrahim/orders.php">Orders</a></li>

                  <li><a href="./showproducts.php">products</a></li>
                  <li><a href="./esraa/checks.php"> checks </a></li>
                  <!-- <li><a href="./ManualOrder.php">manual order</a></li> -->
                  <li><a href=" logout.php"> logout</a></li>
                </ul>
              </nav>   
            </div>           
          </div>    
        </div>
      </div>
      <br>
      <br>

      <section class="main-container">
          <h1>All Users</h1>
          <table >
              <thead>
                  <th>name</th>
                  <th>room</th>
                  <th>image</th>
                  <th>ext</th>
                  <th>action</th>
              </thead>
              <tbody>
                  <?php foreach ($users as $user) : ?>
                      <tr >
                          <td><?php echo $user['name'] ?> </td>
                          <td><?php echo $user['number'] ?> </td>
                          <td><img  src="<?php echo $user['img'] ?>"> </td>
                          <td><?php echo $user['ext'] ?> </td>
                          <td>
                              <a style="background-color: #302f2f ;text-decoration: none; color:#c79c60 ;"  href='./edituserform.php?id=<?php echo ($user['id']);?>'>edit</a> 
                              <a style="background-color: #302f2f ;text-decoration: none; color:#c79c60 ;" href='./deleteuser.php?id=<?php echo ($user['id']);?>'>delete</a>
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
}
else {
  header("location:adminlogin.php");
}
?>