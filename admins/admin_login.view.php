<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <link rel="icon" type="image/x-icon" href="img/favicon.png" />
    <script
      src="https://kit.fontawesome.com/225a355f8f.js"
      crossorigin="anonymous"
    ></script>
    <style>
        .card{
            width: 500px;
        }
        .col-md-4 {
            margin-top: 200px;
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
      .right {
        margin-top: 40px;
        display: flex;
        margin-left: 40px;
        justify-content: space-between;
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
    </style>
</head>
<body>
<?php 
require "config/QueryBuilder.php";
$status = false; 
if(isset($_POST['btn_login'])){
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];
    $out = $db->select("SELECT * FROM admins WHERE email='$email' AND password='$password'");
 if($out==true){
    $outputs = $db->select("SELECT * FROM admins WHERE email='$_POST[admin_email]' AND password='$_POST[admin_password]'");
    $name = "";
    foreach($outputs as $output){
        $name = $output['name']; 
        $email = $output['email'];
    }
    $_SESSION['admin_name'] = $name;
    $_SESSION['email'] = $email;
    header("Location: home");
 }else{
    $status = true; 
 }
}
?>    
<nav class="d-flex bg">
      <div class="text-white font-bold">Dashboard</div>
      <div class="list d-flex">
        <ul class="d-flex">
          <li><a href="admin_login">Login</a></li>
        </ul>
      </div>
    </nav>
<div class="container mt-1">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
        <div class="card shadow-sm">
            <form action="" method="POST">
                <div class="card-body">
                <?php if($status):?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email or password invalid!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <?php endif;?>
                    <div class="form-group">
                    <label>Email:</label>
                    <input placeholder="Enter admin email" name="admin_email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                    <label>Password:</label>
                    <input placeholder="Enter password" name="admin_password" type="password" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <button name="btn_login" type="submit" class="btn btn-primary">Login</button>
                </div>
                </form>
        </div>
        <div class="col-md-4">

        </div>
    </div>
    </div>
</div>

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