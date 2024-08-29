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
  if(!isset($_SESSION['type']) AND $_SESSION['type'] != "Employee"){
    header("Location: /");
  }
if(isset($_GET['id'])){
    if($_SESSION['id'] != $_GET['id']){
        header("Location: /");
      }
    $saved_id = $_GET['id'];
    $jobs = $db->select("SELECT jobs.id AS id,jobs.c_image AS company_image,jobs.job_title AS job_title,jobs.job_region AS job_region,jobs.job_type AS job_type,jobs.company_email AS job_email FROM jobs JOIN saved_jobs ON jobs.id=saved_jobs.job_id WHERE employee_id='$saved_id'");
    //checking saving job
    $countSavingJob = $db->count("SELECT jobs.id AS id,jobs.c_image AS company_image,jobs.job_title AS job_title,jobs.job_region AS job_region,jobs.job_type AS job_type,jobs.company_email AS job_email FROM jobs JOIN saved_jobs ON jobs.id=saved_jobs.job_id WHERE employee_id='$saved_id'");
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
            <h2 class="section-title mb-2">Saved jobs</h2>
          </div>
        </div>
        <?php if($countSavingJob > 0):?>
        <ul class="job-listings mb-5">
          <?php foreach($jobs as $info): ?>
          <li class="job-listing apply d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job_single?job_id=<?= $info['id']?>"></a>
            <div class="job-listing-logo">
              <img style="background-position: center;
  background-size: cover;width: 100%;object-fit: cover;" src="images/<?= $info['company_image'];?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?= $info['job_title'];?></h2>
                <strong><?= $info['job_email'];?></strong>
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
        <?php else:?>
            <h3 class="text-danger text-center">Not have saved jobs</h3>
        <?php endif;?>
      </div>
    </section>
<?php require "view/partials/footer.php"?>