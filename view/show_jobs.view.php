<?php 
require "view/partials/header.php";
?>  
<!-- NAVBAR -->
<?php 
require "view/components/nav.php";
require "config/QueryBuilder.php";
$trendingKeys = $db->select("SELECT COUNT(keyword) AS count, keyword FROM keyword GROUP BY keyword ORDER BY count DESC LIMIT 4");

//show categories
if(isset($_GET['name'])){
    $category_name = $_GET['name'];
    $related_jobs = $db->select("SELECT * FROM jobs WHERE job_category='$category_name' AND status='1'");
    foreach($related_jobs as $related_job){
        $job_cate = $related_job['job_category'];
    }
    $count = $db->count("SELECT * FROM jobs WHERE job_category='$category_name' AND status='1'");
}else{
    abort(404);
}
?>
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Jobs in this <?php if($count == 0){echo "Category";}else{echo $job_cate;}?></h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Category</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong><?php if($count == 0){echo "Category";}else{echo $job_cate;}?></strong></span>
            </div>
          </div>
        </div>
      </div>
</section>

<section class="site-section" id="next">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2"><?= $count;?> <?php if($count == 0){echo "Category";}else{echo $job_cate;}?> Related Jobs</h2>
          </div>
        </div>
        <?php if($count > 0):?>
        <ul class="job-listings mb-5">
          <?php foreach($related_jobs as $related_job):?>
          <li class="apply job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job_single?job_id=<?= $related_job['id']?>"></a>
            <div class="job-listing-logo">
              <img src="images/<?= $related_job['c_image']?>" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?= $related_job['job_title']?></h2>
                <strong><?= $related_job['c_name'];?></strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> <?= $related_job['job_region']?>
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-<?php if($related_job['job_type'] == 'Full Time'){echo "success";}else{echo "danger";}?>"><?= $related_job['job_type']?></span>
              </div>
            </div> 
          </li>
          <br>
       <?php endforeach;?>  
        </ul>
      <?php else:?>
        <h4 class="alert alert-danger bg-danger text-white text-center">Not Found Jobs!</h4>
        <?php endif;?>
        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Showing 1-7 Of 22,392 Jobs</span>
          </div>
          <div class="col-md-6 text-center text-md-right">
            <div class="custom-pagination ml-auto">
              <a href="#" class="prev">Prev</a>
              <div class="d-inline-block">
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              </div>
              <a href="#" class="next">Next</a>
            </div>
          </div>
        </div>

      </div>
    </section>
<?php require "view/partials/footer.php";?>