<?php 
require "view/partials/header.php";
?>  
<!-- NAVBAR -->
<?php 
require "view/components/nav.php";
require "config/QueryBuilder.php";
$trendingKeys = $db->select("SELECT COUNT(keyword) AS count, keyword FROM keyword GROUP BY keyword ORDER BY count DESC LIMIT 4");

// if(!isset($_SESSION['name'])){
//   header("Location: /");
// }
//profile added
$img = '';
$userName = '';
$userTitle = '';
$userEmail = '';
$userBio = '';
$facebook = '';
$instagram = '';
$linkIn = '';

if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    // if($_SESSION['id'] != $_GET['id']){
    //   header("Location: /");
    // }
    $userInfos = $db->select("SELECT * FROM users WHERE id= '$user_id'");
    foreach($userInfos as $userInfo){
        $img = $userInfo['img'];
        $userName = $userInfo['username'];
        $userEmail = $userInfo['email'];
        $userTitle = $userInfo['title'];
        $facebook = $userInfo['facebook'];
        $instagram = $userInfo['instagram'];
        $linkIn = $userInfo['linkin'];
        $userBio = $userInfo['bio'];
        $cv = $userInfo['cv'];
    }
    $c_infos = $db->select("SELECT * FROM jobs WHERE c_id='$user_id' AND status='1'");
}else{
  abort(404);
};
?>
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"><?= $userName?></h1>
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
          
    <div class="container">
        <div class="row">
          <div class="col-md-12">
          <div class="container mt-5 mb-5">
    
    <div class="row d-flex justify-content-center">
        
        <div class="col-md-7">
            
            <div class="card profile p-3 py-4">
                
                <div class="text-center">
                    <img src="images/<?= $img?>" width="100" class="rounded-circle box-shadow">
                </div>
                
                <div class="text-center mt-3">
                    <?php if(isset($_SESSION['type']) && $_SESSION['type'] == 'Employee'):?>
                    <a class="btn text-white btn-success" role="button" download href="images/<?= $cv?>">Download CV</a>
                    <?php endif;?>
                    <h4 class="mt-2 mb-0"><?= $userName?></h4>
                    <?php if(isset($_SESSION['type']) && $_SESSION['type'] == 'Employee'):?>
                    <span class="text-info"><?= $userTitle?></span>
                    <?php endif;?>
                    <div class="px-4 mt-1">
                        <p class="fonts bio"><?= $userBio;?> </p>
                    </div>
                    
                     <ul class="social-list">
                        <li><a href="<?= $facebook;?>"><span class="icon-facebook"></span></a></li>
                        <li><a href="<?= $instagram;?>"><span class="icon-instagram"></span></a></li>
                        <li><a href="<?= $linkIn;?>"><span class="icon-linkedin"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
          </div>
        </div>
      </div>
    </section>
          </div>
          <section class="site-section-profile">
      <div class="container">
      <?php if(isset($_SESSION['type']) && $_SESSION['type'] == 'Company'):?>
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Job Listed By This Company</h2>
          </div>
        </div>
        <?php endif;?>
        <ul class="job-listings mb-5">
          <?php foreach($c_infos as $info): ?>
          <li class="apply job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job_single?job_id=<?= $info['id']?>"></a>
            <div class="job-listing-logo">
              <img src="images/<?= $img;?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?= $info['job_title'];?></h2>
                <strong><?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}else{echo $userEmail;}?></strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span><?= $info['job_region'];?>
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-<?php if($info['job_type'] == 'Full Time'){echo "success";}else{echo "danger";}?>"><?= $info['job_type'];?></span>
              </div>
            </div>
          </li>
          <br>
          <?php endforeach;?>
        </ul>
      </div>

<?php require "view/partials/footer.php";?>