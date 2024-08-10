<?php 
require "view/partials/header.php";
?>  
<!-- NAVBAR -->
<?php 
require "view/components/nav.php";
require "config/QueryBuilder.php";

if(isset($_SESSION['name'])){
  header("Location: /");
}

$name="";
$user_type = "";
$user_email = "";
$user_img = "";
$status = false;
//login system
if(isset($_POST['login_btn'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $outputs = $db->select("SELECT * FROM users WHERE email='$email' AND password='$password'");
  foreach($outputs as $output){
    $name = $output['username'];
    $user_email = $output['email'];
    $user_id = $output['id'];
    $user_type = $output['type'];
    $cv = $output['cv'];
    $user_img = $output['img'];
  }
  if($outputs == false){
   $status=true;
  }else{
    $_SESSION['user'] = $name;
    $_SESSION['name'] = $name;
    $_SESSION['type'] = $user_type;
    $_SESSION['id'] = $user_id;
    $_SESSION['cv'] = $cv;
    $_SESSION['img_profile'] = $user_img;
    $_SESSION['email'] = $user_email;
    header("Location: /");
  } 
}
?>

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Login</h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Log In</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2 class="mb-4">Log In To JobBoard</h2>
            <?php if($status):?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email or password invalid!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php endif;?>
            <form action="" method="POST" class="p-4 border rounded">
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Email</label>
                  <input name="email" type="text" id="fname" class="form-control" placeholder="Email address">
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Password</label>
                  <input name="password" type="password" id="fname" class="form-control" placeholder="Password">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input name="login_btn" type="submit" value="Log In" class="btn px-4 btn-primary text-white">
                </div>
              </div>
              <a href="registration" class="text-info mt-3">Create a new account?</a>
            </form>
          </div>
        </div>
      </div>
    </section>
    <?php require "view/partials/footer.php"?>