<?php require "view/partials/header.php";
?>
    
    <!-- NAVBAR -->
<?php 
require "view/components/nav.php";
require "config/QueryBuilder.php";
if(!isset($_SESSION['name'])){
  header("Location: /");
}

  $img = '';
  $userName = '';
  $userTitle = '';
  $userEmail = '';
  $userBio = '';
  $facebook = '';
  $instagram = '';
  $img = '';
  $cv = '';
  $linkIn = '';
  $type = '';
  //edit profile
  
  if(isset($_GET['id'])){
      $user_id = $_GET['id'];
      if($_SESSION['id'] != $_GET['id']){
        header("Location: /");
      }
      $userInfos = $db->select("SELECT * FROM users WHERE id= '$user_id'");
      foreach($userInfos as $userInfo){
          $img = $userInfo['img'];
          $userName = $userInfo['username'];
          $userEmail = $userInfo['email'];
          $img = $userInfo['img'];
          $cv = $userInfo['cv'];
          $userTitle = $userInfo['title'];
          $facebook = $userInfo['facebook'];
          $instagram = $userInfo['instagram'];
          $linkIn = $userInfo['linkin'];
          $userBio = $userInfo['bio'];
          $type = $userInfo['type'];
      }
      //update profile
  if(isset($_POST['btn_update'])){
    $cvF = "";
    $image = $_FILES['img']['name'];
    $type == "Worker" ? $cvF = $_FILES['cv']['name'] : $cvF = 'NULL';
    $dir_img = 'images/'.basename($image);
    $dir_cv = 'images/'.basename($cvF);
    
    if($image !== '' && $cvF !== ''){
      unlink("images/".$img."");
      unlink("images/".$cv."");
        $db->updateProfile([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'title' => $_POST['title'],
            'bio' => $_POST['bio'],
            'facebook' => $_POST['facebook'],
            'instagram' => $_POST['instagram'],
            'linkin' => $_POST['linkin'],
            'img' => $image,
            'cv' => $cvF
        ],$_GET['id']);
        $_SESSION['img_profile'] = $image;
        $_SESSION['cv'] = $cvF;
        header("Location: /");
    }else{
        $db->updateProfile([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'title' => $_POST['title'],
            'bio' => $_POST['bio'],
            'facebook' => $_POST['facebook'],
            'instagram' => $_POST['instagram'],
            'linkin' => $_POST['linkin'],
            'img' => $img,
            'cv' => $cv
        ],$_GET['id']);
        $_SESSION['img_profile'] = $img;
        $_SESSION['cv'] = $cv;
        header("Location: /");
    }
        
    if(move_uploaded_file($_FILES['img']['tmp_name'], $dir_img) && move_uploaded_file($_FILES['cv']['tmp_name'], $dir_cv)){
        header("Location: /");
    }
  }
  }else{
    abort(404);
  }  
?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Update Profile</h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong><?= $userEmail?></strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 apply mb-5 mb-lg-0">
            <form action="update_profile?id=<?= $_GET['id']?>" method="POST" enctype="multipart/form-data" class="">

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">User Name</label>
                  <input name="username" type="text" id="fname" value="<?= $userName?>" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Email</label>
                  <input name="email" value="<?= $userEmail?>" type="email" id="lname" class="form-control">
                </div>
              </div>
        <?php if(isset($_SESSION['type']) && $_SESSION['type'] == 'Employee'):?>
            <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="email">Title</label> 
                  <input name="title" value = "<?= $userTitle?>" type="text" id="email" class="form-control">
                </div>
            </div>
        <?php else:?>
          <div class="row form-group">
                <div class="col-md-12">
                  <input name="title" value = "NULL" type="hidden" id="email" class="form-control">
                </div>
            </div>
        <?php endif;?>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Bio</label> 
                  <textarea name="bio" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."><?= $userBio;?></textarea>
                </div>
              </div>
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Facebook</label> 
                  <input name="facebook" value="<?= $facebook;?>" type="subject" id="subject" class="form-control">
                </div>
              </div>
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Instagram</label> 
                  <input name="instagram" value="<?= $instagram;?>" type="subject" id="subject" class="form-control">
                </div>
              </div>
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">LinkIn</label> 
                  <input name="linkin" value="<?= $linkIn;?>" type="subject" id="subject" class="form-control">
                </div>
              </div>
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Image</label> 
                  <input name="img" type="file" id="subject" class="form-control">
                </div>
              </div>
            <?php if(isset($_SESSION['type']) && $_SESSION['type'] == 'Employee'):?>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">CV</label> 
                  <input name="cv" type="file" id="subject" class="form-control">
                </div>
              </div>
            <?php else: ?>
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="hidden" value="NULL" id="subject" class="form-control">
                </div>
              </div>
              <?php endif;?>
              <div class="row form-group">
                <div class="col-md-12">
                  <input name="btn_update" type="submit" value="Update Profile" class="btn btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-lg-5 ml-auto">
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">youremail@domain.com</a></p>

            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center" data-aos="fade">
            <h2 class="section-title mb-3">Happy Candidates Says</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="block__87154 bg-white rounded">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                <div>
                  <h3>Elisabeth Smith</h3>
                  <span class="position">Creative Director</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="block__87154 bg-white rounded">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam, cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_2.jpg" alt="Image" class="img-fluid"></figure>
                <div>
                  <h3>Chris Peter</h3>
                  <span class="position">Web Designer</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- footer section -->
     
<?php require "view/partials/footer.php"?>