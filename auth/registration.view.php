<?php 
require "view/partials/header.php";
require "config/QueryBuilder.php";
if(isset($_SESSION['name'])){
  header("Location: /");
}

//Create Acc
$nameErr = "";
$emailErr = "";
$passErr = "";
$confirmErr = "";
$typeErr = "";
$pattern = '/^[a-zA-Z0-9._%+-]+@gmail+\.com$/';
if(isset($_POST['regist_btn'])){
  
  if(empty($_POST['name'])){
    $nameErr = "The name field is required!";
  }
  if(empty($_POST['email'])){
    $emailErr = "The email field is required!";
  }
  if(empty($_POST['password'])){
    $passErr = "The password field is required!";
  }
  if(empty($_POST['confirm-pass'])){
    $confirmErr = "The confirm-password field is required!";
  }
  if(empty($_POST['type'])){
    $typeErr = "Please select type!";
  }
  
  if($_POST['password'] !== $_POST['confirm-pass']){
    $confirmErr = "The password does not match!";
  }
  
  if(!empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['email']) && !empty($_POST['password']) && $_POST['password'] == $_POST['confirm-pass']){
    $emailCount = $db->count("SELECT * FROM users WHERE email='$_POST[email]'");
    if($emailCount > 0){
      $emailErr = "Email is already taken!";
    }else if(preg_match($pattern,$_POST['email']) == 0){
      $emailErr = "Please text the corret email!";
    }
    else{
      $db->insert([
        'username' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'type' => $_POST['type']
      ]);
      $outputs = $db->select("SELECT * FROM users WHERE email='$_POST[email]' AND password='$_POST[password]'");
      $user_id="";
      $user_type = "";
      $user_email = "";
      $user_img = "";
      foreach($outputs as $output){
        $user_id = $output['id'];
        $user_type = $output['type']; 
        $user_email = $output['email'];
        $user_img = $output['img'];
      }
      $_SESSION['user'] = $_POST['name'];
      $_SESSION['name'] = $_POST['name'];
      $_SESSION['img_profile'] = $user_img;
      $_SESSION['id'] = $user_id;
      $_SESSION['email'] = $user_email;
      $_SESSION['type'] = $user_type;
      header("Location: /");
    }
  }  
}
?>
<!-- NAVBAR -->
<?php require "view/components/nav.php";?>
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Register</h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Sign up</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Sign Up To JobBoard</h2>
            <form action="" method = "POST" class="p-4 border rounded">
            <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Username</label>
                  <input name = "name" type="text" id="fname" value="<?php if(isset($_POST['regist_btn'])){echo $_POST['name'];}?>" class="form-control" placeholder="Enter Username">
                  <span class = "text-danger"><?= $nameErr;?></span>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Email</label>
                  <input name = "email" type="email" id="fname" value="<?php if(isset($_POST['regist_btn'])){echo $_POST['email'];}?>" class="form-control" placeholder="Email address">
                  <span class = "text-danger"><?= $emailErr;?></span>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Type</label>
                  <select title="Select User Type" class="form-control selectpicker" name="type" id="">
                    <option>Employee</option>
                    <option>Company</option>
                  </select>
                  <span class = "text-danger"><?= $typeErr;?></span>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Password</label>
                  <input name = "password" type="password" id="fname" value="<?php if(isset($_POST['regist_btn'])){echo $_POST['password'];}?>" class="form-control" placeholder="Password">
                  <span class = "text-danger"><?= $passErr;?></span>
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Re-Type Password</label>
                  <input name = "confirm-pass" type="password" id="fname" value="<?php if(isset($_POST['regist_btn'])){echo $_POST['confirm-pass'];}?>" class="form-control" placeholder="Re-type Password">
                  <span class = "text-danger"><?= $confirmErr;?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <button name="regist_btn" type="submit" class="btn btn-primary text-white">Sign Up</button>
                </div>
              </div>
              <a href="login" class="text-info mt-3">I have already an account</a>
            </form>
          </div>
</div>
</div>
</section>
<?php require "view/partials/footer.php"?>