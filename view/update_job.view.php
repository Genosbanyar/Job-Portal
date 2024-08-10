<?php 
require "view/partials/header.php";
?>  
<!-- NAVBAR -->
<?php 
require "view/components/nav.php";
$trendingKeys = $db->select("SELECT COUNT(keyword) AS count, keyword FROM keyword GROUP BY keyword ORDER BY count DESC LIMIT 4");

if(!isset($_SESSION['name'])){
  header("Location: /");
}
if(isset($_SESSION['type']) && $_SESSION['type'] != 'Company'){
  header("Location: /");
}
//added job post
$jobTitleErr="";
$job_regionErr="";
$job_typeErr="";
$job_locationErr="";
$job_expErr="";
$salaryErr="";
$genderErr="";
$deadlineErr="";
$descriptionErr="";
$responErr="";
$educationErr="";
$benefitErr="";
$c_emailErr="";
$c_nameErr="";
$c_idErr="";
$c_imageErr="";
$job_categoryErr = "";
require "config/QueryBuilder.php";
$categories = $db->select("SELECT * FROM categories");
if(isset($_GET['id'])){
    $job_id = $_GET['id'];
    $oldJobs = $db->select("SELECT * FROM jobs WHERE id='$job_id'");
    foreach($oldJobs as $oldJob){
        $title = $oldJob['job_title'];
        $region = $oldJob['job_region'];
        $vancy = $oldJob['job_location'];
        $deadline = $oldJob['deadline'];
        $des = $oldJob['descrip'];
        $respon = $oldJob['respon'];
        $edu = $oldJob['education'];
        $benefit = $oldJob['benefit'];
        $update_email = $oldJob['company_email'];
        $update_name = $oldJob['c_name'];
        $update_id = $oldJob['c_id'];
        $update_image = $oldJob['c_image'];
    }
}else{
    abort(404);
}

if(isset($_POST['click_post'])){

  if(empty($_POST['job_title'])){
    $jobTitleErr = "The job title field is required!";
  }
  if(empty($_POST['job_region'])){
    $job_regionErr = "The job region field is required!";
  }
  if(empty($_POST['job_type'])){
    $job_typeErr = "The job type field is required!";
  }
  if(empty($_POST['job_location'])){
    $job_locationErr = "The job location field is required!";
  }
  if(empty($_POST['job_experience'])){
    $job_expErr = "The job experience field is required!";
  }
  if(empty($_POST['salary'])){
    $salaryErr = "The salary field is required!";
  }
  if(empty($_POST['gender'])){
    $genderErr = "The gender field is required!";
  }
  if(empty($_POST['deadline'])){
    $deadlineErr = "The deadline field is required!";
  }
  if(empty($_POST['description'])){
    $descriptionErr = "The description field is required!";
  }
  if(empty($_POST['respon'])){
    $responErr = "The responsibilities field is required!";
  }
  if(empty($_POST['education'])){
    $educationErr = "The Education & Experience field is required!";
  }
  if(empty($_POST['benefit'])){
    $benefitErr = "The benefit field is required!";
  }
  if(empty($_POST['company_email'])){
    $c_emailErr = "The company field is required!";
  }
  if(empty($_POST['c_name'])){
    $c_nameErr = "The company name field is required!";
  }
  if(empty($_POST['c_id'])){
    $c_idErr = "Company field is required!";
  }
  if(empty($_POST['c_image'])){
    $c_imageErr = "Please choose company's image!";
  }
  if(empty($_POST['job_cate'])){
    $job_categoryErr = "Please choose job category";
  }

  if(!empty($_POST['job_title']) && !empty($_POST['job_region']) && !empty($_POST['job_type']) && !empty($_POST['job_cate']) && !empty($_POST['job_location']) && !empty($_POST['job_experience']) && !empty($_POST['salary']) && !empty($_POST['gender']) && !empty($_POST['deadline']) && !empty($_POST['description']) && !empty($_POST['respon']) && !empty($_POST['education']) && !empty($_POST['benefit']) && !empty($_POST['company_email']) && !empty($_POST['c_name']) && !empty($_POST['c_id']) && !empty($_POST['c_image'])){
       $title_update = $_POST['job_title'];
       $region_update = $_POST['job_region'];
       $type_update = $_POST['job_type'];
       $location_update = $_POST['job_location'];
       $category_update = $_POST['job_cate'];
       $exp_update = $_POST['job_experience'];
       $salary_post = $_POST['salary'];
       $gender_post = $_POST['gender'];
       $deadline_post = $_POST['deadline'];
       $des_update = $_POST['description'];
       $respon_post = $_POST['respon'];
       $edu_update = $_POST['education'];
       $ben_update = $_POST['benefit'];
       $email_post = $_POST['company_email'];
       $post_name = $_POST['c_name'];
       $post_id = $_POST['c_id'];
       $post_img = $_POST['c_image'];

    $db->updateJob([
      $title_update,$region_update,$type_update,$location_update,$category_update,$exp_update,$salary_post,$gender_post,$deadline_post,$des_update,$respon_post,$edu_update,$ben_update,$email_post,$post_name,$post_id,$post_img
    ],$_GET['id']);
    header("Location: job_single?job_id=$job_id");
  }
}
?>
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Post A Job Edit</h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Edit a Job</strong></span>
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
              <div>
                <h2>Update A Job</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
            <form class="apply p-4 p-md-5 border rounded" action="" method="POST">
              <h3 class="text-black mb-5 border-bottom pb-2">Job Details</h3>
              <div class="form-group">
                <label for="job-title">Job Title</label>
                <input name="job_title" type="text" value="<?= $title;?>" class="form-control" id="job-title" placeholder="Product Designer">
                <span class="text-danger"><?= $jobTitleErr;?></span>
              </div>

              <div class="form-group">
                <label for="job-region">Job Region</label>
                <select name="job_region" value="<?= $region;?>" class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Region">
                      <option>Anywhere</option>
                      <option>San Francisco</option>
                      <option>Palo Alto</option>
                      <option>New York</option>
                      <option>Manhattan</option>
                      <option>Ontario</option>
                      <option>Toronto</option>
                      <option>Kansas</option>
                      <option>Mountain View</option>
                    </select>
                    <span class="text-danger"><?= $job_regionErr;?></span>
              </div>

              <div class="form-group">
                <label for="job-type">Job Type</label>
                <select name="job_type" value="<?php if(isset($_POST['click_post'])){echo $_POST['job_type'];}?>" class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Type">
                  <option>Part Time</option>
                  <option>Full Time</option>
                </select>
                <span class="text-danger"><?= $job_typeErr;?></span>
              </div>
              
              <div class="form-group">
                <label for="job-location">Vancy</label>
                <input name="job_location" value="<?= $vancy;?>" type="text" class="form-control" id="job-location" placeholder="e.g.10">
                <span class="text-danger"><?= $job_locationErr;?></span>
              </div>

              <div class="form-group">
                <label for="job-category">Job Category</label>
                <select name="job_cate" value="<?php if(isset($_POST['click_post'])){echo $_POST['job_experience'];}?>" class="selectpicker border rounded" id="job-category" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Category">
                  <?php foreach($categories as $category):?>
                  <option><?= $category['name']?></option>
                  <?php endforeach;?>
                </select>
                <span class="text-danger"><?= $job_categoryErr;?></span>
              </div>

              <div class="form-group">
                <label for="job-experience">Experience</label>
                <select name="job_experience" value="<?php if(isset($_POST['click_post'])){echo $_POST['job_experience'];}?>" class="selectpicker border rounded" id="job-experience" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Years of Experience">
                  <option>1-3 years</option>
                  <option>3-6 years</option>
                  <option>6-9 years</option>
                </select>
                <span class="text-danger"><?= $job_expErr;?></span>
              </div>

              <div class="form-group">
                <label for="job-salary">Salary</label>
                <select name="salary" value="<?php if(isset($_POST['click_post'])){echo $_POST['salary'];}?>" class="selectpicker border rounded" id="job-salary" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Salary">
                  <option>$50k-$70k</option>
                  <option>$70k-$100k</option>
                  <option>$100k-$150k</option>
                </select>
                <span class="text-danger"><?= $salaryErr;?></span>
              </div>

              <div class="form-group">
                <label for="job-gender">Gender</label>
                <select name="gender" class="selectpicker border rounded" id="job-gender" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Gender">
                  <option>Male</option>
                  <option>Female</option>
                  <option>Any</option>
                </select>
                <span class="text-danger"><?= $genderErr;?></span>
              </div>

              <div class="form-group">
                <label for="job-location">Application Deadline</label>
                <input name="deadline" value="<?= $deadline;?>" type="date" class="form-control" id="job-location" placeholder="eg-20-2-2024">
                <span class="text-danger"><?= $deadlineErr;?></span>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Job Description</label> 
                  <textarea name="description" id="message" cols="30" rows="7" class="form-control" placeholder="Write Job Description..."><?= $des;?></textarea>
                  <span class="text-danger"><?= $descriptionErr;?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Responsibilities</label> 
                  <textarea name="respon" id="message" cols="30" rows="7" class="form-control" placeholder="Write Responsibilities..."><?= $respon?></textarea>
                  <span class="text-danger"><?= $responErr;?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Education & Experience</label> 
                  <textarea name="education" id="message" cols="30" rows="7" class="form-control" placeholder="Write Education & Experience..."><?= $edu?></textarea>
                  <span class="text-danger"><?= $educationErr;?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Other Benifits</label> 
                  <textarea name="benefit" id="message" cols="30" rows="7" class="form-control" placeholder="Write Other Benifits..."><?= $benefit?></textarea>
                  <span class="text-danger"><?= $benefitErr;?></span>
                </div>
              </div>

              <div class="form-group">
                <input name = "company_email" value="<?= $_SESSION['email']?>" type="hidden" class="form-control" id="company-name" placeholder="Company Email">
                <span class="text-danger"><?= $c_emailErr;?></span>
              </div>

              <div class="form-group">
                <input name="c_name" value="<?= $_SESSION['name']?>" type="hidden" class="form-control" id="company-name" placeholder="Company Name">
                <span class="text-danger"><?= $c_nameErr;?></span>
              </div>

              <div class="form-group">
                <input name="c_id" value="<?= $_SESSION['id']?>" type="hidden" class="form-control" id="company-name" placeholder="Company ID">
                <span class="text-danger"><?= $c_idErr;?></span>
              </div>

              <div class="form-group">
                <input name="c_image" value="<?= $_SESSION['img_profile'];?>" type="hidden" class="form-control" id="company-name" placeholder="Company Image">
                <span class="text-danger"><?= $c_imageErr;?></span>
              </div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
          
          <div class="col-lg-4 ml-auto">
            <div class="row">
              
              <div class="col-6">
                <input class="btn text-white btn-success" type="submit" value="Update post" name="click_post">
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- footer section -->
     
<?php require "view/partials/footer.php"?>