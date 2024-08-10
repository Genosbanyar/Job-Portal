<?php 
session_start();
if(!isset($_SESSION['admin_name'])){
  header("Location: admin_login");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="ftco-32x32.png" />

    <link rel="stylesheet" href="css/custom-bs.css" />
    <link rel="stylesheet" href="css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/line-icons/style.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/animate.min.css" />

    <!-- MAIN CSS -->

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      .bg {
        justify-content: space-between;
        padding: 20px 50px;
        background-color: grey;
      }
      .font-bold {
        font-size: 20px;
        font-weight: 600;
      }
      a {
        color: white;
        text-decoration: none;
      }
      ul {
        list-style: none;
      }
      .col-md-2 {
        height: 100vh;
      }
      .col-md-9 {
        height: 100vh;
      }
      .square_one {
        background-color: rgb(241, 234, 234);
        padding: 50px 30px;
        width: 300px;
        height: 150px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px,
          rgba(0, 0, 0, 0.22) 0px 10px 10px;
        border-radius: 10px;
      }
      .square_two {
        background-color: rgb(241, 234, 234);
        width: 300px;
        padding: 50px 30px;
        height: 150px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px,
          rgba(0, 0, 0, 0.22) 0px 10px 10px;
        border-radius: 10px;
      }
      .square_three {
        background-color: rgb(241, 234, 234);
        width: 300px;
        padding: 50px 30px;
        height: 150px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px,
          rgba(0, 0, 0, 0.22) 0px 10px 10px;
        border-radius: 10px;
      }
      .right {
        margin-top: 40px;
        margin-left: 40px;
      }
      .left {
        height: 30vh;
        margin-top: 30px;
      }
      .list-icon {
        font-size: 18px;
        margin-left: 20px;
        height: 180px;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
      }
      .mf-20 {
        margin-right: 20px;
      }
      h5 {
        font-weight: 600;
        color: black;
      }
      .dropdown {
        margin-left: 20px;
      }
      .header{
        font-size: 25px;
        font-weight: 600;
      }
      h4{
        font-size: 25px;
        font-weight: 600;
      }
      .card-title{
        padding: 10px 0px 0px 25px;
      }
    </style>
  </head>
  <body>
<?php
    require "config/QueryBuilder.php";
    $nameErr = "";
    $emailErr = "";
    $passErr = "";
    if(isset($_POST['btn_login'])){
     if(empty($_POST['admin_name'])){
        $nameErr = "Name field require!";
     } 
     if(empty($_POST['admin_email'])){
        $emailErr = "Email field require!";
    } 
   if(empty($_POST['admin_password'])){
        $passErr = "Password field require!";
    } 
    if(!empty($_POST['admin_name']) && !empty($_POST['admin_email']) && !empty($_POST['admin_password'])){
      $emailCount = $db->count("SELECT * FROM admins WHERE email='$_POST[admin_email]'");
    if($emailCount > 0){
      $emailErr = "Email is already taken!";
    }else{
      $db->insertAdmins([
      'name' => $_POST['admin_name'],
      'email' => $_POST['admin_email'],
      'password' => $_POST['admin_password']
    ]);
    $_SESSION['success'] = "Add a new admin successfully!";
    header("Location: admin_show");
    }
  }
}
?>
    <nav class="d-flex bg">
      <div class="text-white font-bold">Dashboard</div>
      <div class="list d-flex">
        <ul class="d-flex">
          <li class="mf-20"><a href="home">Home</a></li>
          <?php if(!isset($_SESSION['admin_name'])):?>
          <li><a href="admin_login">Login</a></li>
          <?php endif;?>
        </ul>
        <?php if(isset($_SESSION['admin_name'])):?>
        <div class="dropdown show">
          <a
            class="text-white dropdown-toggle"
            href="#"
            role="button"
            id="dropdownMenuLink"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
          <?= $_SESSION['admin_name']?>
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="admin_logout">Logout</a>
          </div>
        </div>
        <?php endif;?>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 bg-secondary">
          <div class="left">
            <ul class="list-icon">
              <li><a href="">Home</a></li>
              <li><a href="admin_show">Admins</a></li>
              <li><a href="categories_admin">Categories</a></li>
              <li><a href="admin_jobs">Posted Jobs</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-9 bg-white">
          <div class="right">
          <div class="container mt-1">
    <div class="row">
        <div class="col-md-8">
        <div class="card shadow-sm">
            <form action="" method="POST">
                <div class="card-title"><h5>Create Admins</h5></div>
                <div class="card-body">
                <div class="form-group">
                    <label>Name:</label>
                    <input placeholder="Enter admin name" name="admin_name" type="text" class="form-control">
                    <span class="text-danger"><?= $nameErr;?></span>
                    </div>
                    <div class="form-group">
                    <label>Email:</label>
                    <input placeholder="Enter admin email" name="admin_email" type="email" class="form-control">
                    <span class="text-danger"><?= $emailErr;?></span>
                    </div>
                    <div class="form-group">
                    <label>Password:</label>
                    <input placeholder="Enter password" name="admin_password" type="password" class="form-control">
                    <span class="text-danger"><?= $passErr;?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <button name="btn_login" type="submit" class="btn text-white btn-primary">Create</button>
                </div>
                </form>
                </div>
    </div>
    </div>
</div>
          </div>
        </div>
      </div>
    </div>

    <!-- SCRIPTS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/stickyfill.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>

    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>

    <script src="js/bootstrap-select.min.js"></script>

    <script src="js/custom.js"></script>

    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
