<?php 
require "view/partials/header.php";
?>  
<!-- NAVBAR -->
<?php 
require "view/components/nav.php";
require "config/QueryBuilder.php";
$trendingKeys = $db->select("SELECT COUNT(keyword) AS count, keyword FROM keyword GROUP BY keyword ORDER BY count DESC LIMIT 4");

//show single job
//if(isset($_SESSION['type']) && $_SESSION['type'] != 'Company'){
  //header("Location: /");
//}
$category="";
if(isset($_GET['job_id'])){
  $jobId = $_GET['job_id'];
  $jobs = $db->select("SELECT * FROM jobs WHERE id = $jobId");
  foreach($jobs as $job){
    $c_image = $job['c_image'];
    $job_name = $job['job_title'];
    $c_name = $job['c_name'];
    $original = $job['created_at'];
    $benefit = $job['benefit'];
    $education = $job['education'];
    $respon = $job['respon'];
    $deadline = $job['deadline'];
    $vanc = $job['job_location'];
    $category = $job['job_category'];
    $c_region = $job['job_region'];
    $job_type = $job['job_type'];
    $job_salary = $job['salary'];
    $gender = $job['gender'];
    $c_id = $job['c_id'];
    $job_des = $job['descrip'];
    $job_exp = $job['job_experience'];
  }
  //getting related jobs
  $related_jobs = $db->select("SELECT * FROM jobs WHERE job_category='$category' AND status='1' AND id != $jobId");
  //getting count of jobs
  $count = $db->count("SELECT * FROM jobs WHERE job_category='$category' AND status='1' AND id != $jobId");
}else{
  abort(404);
}
//apply jobs
if(isset($_POST['click_apply'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $cv = $_POST['cv'];
  $employee_id = $_POST['employee_id'];
  $job_id = $_POST['job_id'];
  $job_title = $_POST['job_title'];
  $company_id = $_POST['company_id'];
  $db->insertJobApplications([$username,$email,$cv,$employee_id,$job_id,$job_title,$company_id]);
  $_SESSION['alert'] = "Apply job successfully";
}

//saving job
if(isset($_POST['click_save'])){
  $job_id_save = $_POST['job_id'];
  $employee_id_save = $_POST['employee_id'];
  $db->insertSave([$job_id_save,$employee_id_save]);
  $_SESSION['alert'] = "Saving job successfully";
}

if(isset($_SESSION['id'])){
  //checking applying jobs
$countApplyingJob = $db->count("SELECT * FROM job_applications WHERE employee_id='$_SESSION[id]' AND job_id='$jobId'");

//checking saving jobs
$countSavingJob = $db->count("SELECT * FROM saved_jobs WHERE job_id='$jobId' AND employee_id='$_SESSION[id]'");
}
//categories
$categories = $db->select("SELECT * FROM categories");
?>
    <!-- HOME -->
    <?php if(isset($_SESSION['alert'])):?>
    <div class="alert flash-message text-center alert-info alert-dismissible fade show" role="alert">
    <?php echo $_SESSION['alert']; unset($_SESSION['alert']);?>
    </div>
  <?php endif;?>
  
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"><?= $job_name?></h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash"></span> 
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div class="border p-2 d-inline-block mr-3 rounded">
                <img style="width: 80px" src="images/<?= $c_image;?>" alt="Image">
              </div>
              <div>
                <h2><?= $job_name?></h2>
                <div>
                  <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span><?= $c_name;?></span>
                  <span class="m-2"><span class="icon-room mr-2"></span><?= $c_region;?></span>
                  <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary"><?= $job_type;?></span></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <div class="mb-5">
              <figure class="mb-5"><img src="images/sq_img_2.jpg" alt="Image" class="img-fluid rounded"></figure>
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
              <p><?= $job_des;?>.</p>
            </div>
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?= $respon;?></span></li>
              </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-book mr-3"></span>Education + Experience</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?= $education;?></span></li>
              </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Other Benifits</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?= $benefit;?></span></li>
              </ul>
            </div>
          <?php if(isset($_SESSION['name'])):?>
            <?php if(isset($_SESSION['type']) && $_SESSION['type'] == "Employee"):?>
              <div class="mb-5 d-flex justify-content-between">
          <form class="rounded" action="" method="POST">
          <!-- <div class="row mb-5"> -->
            <div class="form-group">
                <input name="job_id" value="<?= $jobId;?>" type="hidden" class="form-control" id="job-location" placeholder="username">
            </div>
            <div class="form-group">
                <input name="employee_id" value="<?= $_SESSION['id']?>" type="hidden" class="form-control" id="job-location" placeholder="username">
            </div>
            <?php if($countSavingJob == 0):?>
              <div class="form-group">
                <a href="job_save?job_id=<?= $jobId;?>&employee_id=<?= $_SESSION['id'];?>&status=save" type="submit" class="btn btn-block btn-light btn-md" name="click_save">Save Job</a>
              </div>
              <?php else:?>
                <div class="form-group">
                <a href="job_save?job_id=<?= $jobId;?>&employee_id=<?= $_SESSION['id'];?>&status=delete" type="submit" class="btn btn-block text-danger btn-light btn-md" name="click_save">Saved Job</a>
              </div>
              <?php endif;?>
            <!-- </div> -->
          </form>
          <form class="rounded" action="" method="POST">
          <!-- <div class="row mb-5"> -->
            <div class="form-group">
                <input name="username" value="<?= $_SESSION['name']?>" type="hidden" class="form-control" id="job-location" placeholder="username">
            </div>
            <div class="form-group">
                <input name="email" value="<?= $_SESSION['email']?>" type="hidden" class="form-control" id="job-location" placeholder="email">
            </div>
            <div class="form-group">
                <input name="cv" value="<?= $_SESSION['cv'];?>" type="hidden" class="form-control" id="job-location" placeholder="cv">
            </div>
            <div class="form-group">
                <input name="employee_id" value="<?= $_SESSION['id'];?>" type="hidden" class="form-control" id="job-location" placeholder="employee_id">
            </div>
            <div class="form-group">
                <input name="job_id" value="<?= $jobId;?>" type="hidden" class="form-control" id="job-location" placeholder="job_id">
            </div>
            <div class="form-group">
                <input name="job_title" value="<?= $job_name;?>" type="hidden" class="form-control" id="job-location" placeholder="job_title">
            </div>
            <div class="form-group">
                <input name="company_id" value="<?= $c_id;?>" type="hidden" class="form-control" id="job-location" placeholder="company_id">
            </div>
            <?php if($countApplyingJob == 0):?>
              <div class="form-group">
                <button type="submit" onclick="return confirm('Are you sure to click')" name="click_apply" class="btn btn-block btn-primary btn-md">Apply Job</button>
              </div>
              <?php else:?>
                <div class="form-group">
                <button disabled class="btn btn-block btn-primary btn-md">You applied this job</button>
              </div>
            <?php endif;?>
            </div>
              </form>
              <!-- </div> -->
            <?php endif;?>
            <?php else:?>
            <a style="text-decoration: none; font-size: 19px;" href="login" class="text-info d-block text-center">Login so you can apply for this job</a>
          <?php endif;?>
          <?php if(isset($_SESSION['name'])):?>
            <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Company"):?>
              <?php if(isset($_SESSION['id']) AND $_SESSION['id'] == $c_id):?>
            <div class="row mb-5">
              <div class="col-6">
                <a href="update_job?id=<?= $jobId?>" class="btn btn-block btn-success text-white btn-md">Update</a>
              </div>
              <div class="col-6">
                <a href="delete?id=<?= $jobId?>" class="btn btn-block btn-danger btn-md">Delete</a>
              </div>
            </div>
              <?php endif;?>
            <?php endif;?>
          <?php endif;?>
        </div>
          <div class="col-lg-4">
            <div class="bg-light p-3 border rounded mb-4">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
              <ul class="list-unstyled pl-3 mb-0">
                <li class="mb-2"><strong class="text-black">Published on:</strong> <?php 
                $new=new DateTime($original);
                $current=$new->format('F j, Y');
                echo $current;
                ?></li>
                <li class="mb-2"><strong class="text-black">Vacancy:</strong> <?= $vanc;?></li>
                <li class="mb-2"><strong class="text-black">Employment Status:</strong> <?= $job_type;?></li>
                <li class="mb-2"><strong class="text-black">Experience:</strong> <?= $job_exp;?></li>
                <li class="mb-2"><strong class="text-black">Job Location:</strong> <?= $c_region?></li>
                <li class="mb-2"><strong class="text-black">Salary:</strong> <?= $job_salary;?></li>
                <li class="mb-2"><strong class="text-black">Gender:</strong> <?= $gender;?></li>
                <li class="mb-2"><strong class="text-black">Application Deadline:</strong> <?php 
                $new=new DateTime($deadline);
                $current=$new->format('F j, Y');
                echo $current;
                ?></li>
                <li class="mb-2"><strong class="text-black">Category:</strong> <?= $category;?></li>
              </ul>
            </div>

            <div class="bg-light p-3 border rounded">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
              <div class="px-3">
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-pinterest"></span></a>
              </div>
            </div>

            <div class="bg-light p-3 border rounded mt-4">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Categories</h3>
              <div class="px-3">
                <?php foreach($categories as $category):?>
                <a style="text-decoration: none;" class="text-secondary" href="show_jobs?name=<?= $category['name']?>">
                <li style="list-style: none;"><?= $category['name']?></li>
                </a>
                <?php endforeach;?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2"><?= $count;?> Related Jobs</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          <?php foreach($related_jobs as $related_job):?>
          <li class="apply job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job_single?job_id=<?= $related_job['id']?>"></a>
            <div class="job-listing-logo">
              <img style="background-position: center;
  background-size: cover;width: 100%;object-fit: cover;" src="images/<?= $related_job['c_image']?>" alt="Image" class="img-fluid">
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
    

    <section class="bg-light pt-5 testimony-full">
        
        <div class="owl-carousel single-carousel">

        
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                  <p><cite> &mdash; Corey Woods, @Dribbble</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="images/person_transparent_2.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                  <p><cite> &mdash; Chris Peters, @Google</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="images/person_transparent.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

      </div>

    </section>

    <section class="pt-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
            <h2 class="text-white">Get The Mobile Apps</h2>
            <p class="mb-5 lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci impedit.</p>
            <p class="mb-0">
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-apple mr-3"></span>App Store</a>
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-android mr-3"></span>Play Store</a>
            </p>
          </div>
          <div class="col-md-6 ml-auto align-self-end">
            <img src="images/apps.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
    
    <?php require "view/partials/footer.php";?>