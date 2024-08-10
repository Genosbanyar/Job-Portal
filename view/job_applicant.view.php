<?php 
require "view/partials/header.php";
?>  
<!-- NAVBAR -->
<?php 
require "view/components/nav.php";
require "config/QueryBuilder.php";
$trendingKeys = $db->select("SELECT COUNT(keyword) AS count, keyword FROM keyword GROUP BY keyword ORDER BY count DESC LIMIT 4");

if(!isset($_SESSION['name'])){
    header("Location: /");
  }
  if(!isset($_SESSION['type']) AND $_SESSION['type'] != "Company"){
    header("Location: /");
  }
if(isset($_GET['id'])){
    if($_SESSION['id'] != $_GET['id']){
        header("Location: /");
    }
    $saved_id = $_GET['id'];
    $employees = $db->select("SELECT * FROM users WHERE id='$_SESSION[id]'");
    foreach($employees as $employee){
    $img = $employee['img'];
    }
    $jobs = $db->select("SELECT * FROM job_applications WHERE company_id='$saved_id'");
    //checking saving job
    $countApplyJob = $db->count("SELECT * FROM job_applications WHERE company_id='$saved_id'");
}else{
    abort(404);
}

?>

<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"><?= $_SESSION['name']?></h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong><?= $_SESSION['email']?></strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Job Applicants</h2>
          </div>
        </div>
        <?php if($countApplyJob > 0):?>
        <ul class="job-listings mb-5">
          <?php foreach($jobs as $info): ?>
          <li class="mb-3 job-listing apply d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <div class="job-listing-logo">
            <a style ="position: static;" target="_blank" href="job_single?job_id=<?= $info['job_id']?>">
              <img class="job_profile" src="images/<?= $_SESSION['img_profile'];?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
              </a>
            </div>
            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-meta">
                <h4><?= $info['username']?></h4>
              </div>
        
              <div class="job-listing-meta">
                <span class="text-success"><?= $info['email']?></span>
              </div>

            <div class="job-listing-meta">
            <a style ="position: static;" type="button" download class="btn btn-success text-white" href="images/<?= $info['cv']?>">Download Cv</a>
            </div>
          </div>
          </li>
          <?php endforeach;?>
        </ul>
        <?php else:?>
            <h3 class="text-danger text-center">Not job applicants</h3>
        <?php endif;?>
      </div>
    </section>
<?php require "view/partials/footer.php"?>