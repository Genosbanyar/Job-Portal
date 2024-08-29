<?php 
require "view/partials/header.php";
?>  
<!-- NAVBAR -->
<?php 
require "view/components/nav.php";
require "config/QueryBuilder.php";
$trendingKeys = $db->select("SELECT COUNT(keyword) AS count, keyword FROM keyword GROUP BY keyword ORDER BY count DESC LIMIT 4");

//search job
$status=false;
if(isset($_POST['search_job'])){
    if(empty($_POST['job_title']) && empty($_POST['job_region']) && empty($_POST['job_type'])){
        $notFoundMessage = "Not found jobs";
    }
    if(!empty($_POST['job_title']) && !empty($_POST['job_region']) && !empty($_POST['job_type'])){
        $job_title = $_POST['job_title'];
        $job_region = $_POST['job_region'];
        $job_type = $_POST['job_type'];
        //doing trending key
        $db->insertKeyword([$job_title]);
        $searchJobs = $db->select("SELECT * FROM jobs WHERE job_title LIKE '%$job_title%' AND job_region LIKE '%$job_region%' AND job_type LIKE '%$job_type%' AND status='1'");
        $countSearchJob = $db->count("SELECT * FROM jobs WHERE job_title LIKE '%$job_title%' AND job_region LIKE '%$job_region%' AND job_type LIKE '%$job_type%' AND status='1'");
        if($countSearchJob > 0){
            $status = true;
        }
    }
}else{
    header("Location: /");
};
?>
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Search result for</h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>search job</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Search job</h2>
          </div>
        </div>
        <?php if($status):?>
        <ul class="job-listings mb-5">
          <?php foreach($searchJobs as $info): ?>
            <li class="job-listing apply d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job_single?job_id=<?= $info['id']?>"></a>
            <div class="job-listing-logo">
              <img style="background-position: center;
  background-size: cover;width: 100%;object-fit: cover;" src="images/<?= $info['c_image'];?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?= $info['job_title'];?></h2>
                <strong><?= $info['company_email'];?></strong>
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
            <h4 class="alert alert-danger bg-danger text-white text-center">There are no searches with this job just yet!</h4>
        <?php endif;?>
      </div>
    </section>
<?php require "view/partials/footer.php";?>