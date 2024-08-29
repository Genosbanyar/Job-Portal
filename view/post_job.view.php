<?php 
require "view/partials/header.php";
?>  
<!-- NAVBAR -->
<?php 
require "config/QueryBuilder.php";
require "view/components/nav.php";
$trendingKeys = $db->select("SELECT COUNT(keyword) AS count, keyword FROM keyword GROUP BY keyword ORDER BY count DESC LIMIT 4");

if(!isset($_SESSION['name'])){
  header("Location: /");
}
if(isset($_SESSION['type']) && $_SESSION['type'] != 'Company'){
  header("Location: /");
}
//added job post
$jobTitle="";
$job_region="";
$job_type="";
$job_location="";
$job_exp="";
$salary="";
$gender="";
$deadline="";
$description="";
$respon="";
$education="";
$benefit="";
$c_email="";
$c_name="";
$c_id="";
$c_image="";
$job_category = "";

$categories = $db->select("SELECT * FROM categories");
if(isset($_POST['click_post'])){

  if(empty($_POST['job_title'])){
    $jobTitle = "The job title field is required!";
  }
  if(empty($_POST['job_region'])){
    $job_region = "The job region field is required!";
  }
  if(empty($_POST['job_type'])){
    $job_type = "The job type field is required!";
  }
  if(empty($_POST['job_location'])){
    $job_location = "The job location field is required!";
  }
  if(empty($_POST['job_experience'])){
    $job_exp = "The job experience field is required!";
  }
  if(empty($_POST['salary'])){
    $salary = "The salary field is required!";
  }
  if(empty($_POST['gender'])){
    $gender = "The gender field is required!";
  }
  if(empty($_POST['deadline'])){
    $deadline = "The deadline field is required!";
  }
  if(empty($_POST['description'])){
    $description = "The description field is required!";
  }
  if(empty($_POST['respon'])){
    $respon = "The responsibilities field is required!";
  }
  if(empty($_POST['education'])){
    $education = "The Education & Experience field is required!";
  }
  if(empty($_POST['benefit'])){
    $benefit = "The benefit field is required!";
  }
  if(empty($_POST['company_email'])){
    $c_email = "The company field is required!";
  }
  if(empty($_POST['c_name'])){
    $c_name = "The company name field is required!";
  }
  if(empty($_POST['c_id'])){
    $c_id = "Company field is required!";
  }
  if(empty($_POST['c_image'])){
    $c_image = "Please choose company's image!";
  }
  if(empty($_POST['job_cate'])){
    $job_category = "Please choose job category";
  }

  if(!empty($_POST['job_title']) && !empty($_POST['job_region']) && !empty($_POST['job_type']) && !empty($_POST['job_cate']) && !empty($_POST['job_location']) && !empty($_POST['job_experience']) && !empty($_POST['salary']) && !empty($_POST['gender']) && !empty($_POST['deadline']) && !empty($_POST['description']) && !empty($_POST['respon']) && !empty($_POST['education']) && !empty($_POST['benefit']) && !empty($_POST['company_email']) && !empty($_POST['c_name']) && !empty($_POST['c_id']) && !empty($_POST['c_image'])){
       $title = $_POST['job_title'];
       $region = $_POST['job_region'];
       $type = $_POST['job_type'];
       $location = $_POST['job_location'];
       $category_job = $_POST['job_cate'];
       $exp = $_POST['job_experience'];
       $salary_post = $_POST['salary'];
       $gender_post = $_POST['gender'];
       $deadline_post = $_POST['deadline'];
       $des = $_POST['description'];
       $respon_post = $_POST['respon'];
       $edu = $_POST['education'];
       $ben = $_POST['benefit'];
       $email_post = $_POST['company_email'];
       $post_name = $_POST['c_name'];
       $post_id = $_POST['c_id'];
       $post_img = $_POST['c_image'];

    $db->insertJob([
      $title,$region,$type,$location,$category_job,$exp,$salary_post,$gender_post,$deadline_post,$des,$respon_post,$edu,$ben,$email_post,$post_name,$post_id,$post_img
    ]);
    //header("Location: /");
  }
}
?>
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Post A Job</h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Post a Job</strong></span>
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
                <h2>Post A Job</h2>
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
            <form class="p-4 apply p-md-5 border rounded" action="" method="POST">
              <h3 class="text-black mb-5 border-bottom pb-2">Job Details</h3>
              <div class="form-group">
                <label for="job-title">Job Title</label>
                <input name="job_title" type="text" value="<?php if(isset($_POST['click_post'])){echo $_POST['job_title'];}?>" class="form-control" id="job-title" placeholder="Product Designer">
                <span class="text-danger"><?= $jobTitle;?></span>
              </div>

              <div class="form-group">
                <label for="job-region">Job Region</label>
                <select name="job_region" value="<?php if(isset($_POST['click_post'])){echo $_POST['job_region'];}?>" class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Region">
                <option>Anywhere</option>
                      <option>Yangon, Myanmar</option>
                      <option>Mandalay, Myanmar</option>
                      <option>Taunggyi, Shan State, Myanmar</option>
                      <option>Naypyidaw, Myanmar</option>
                      <option>Monywa, Myanmar</option>
                      <option>Mawlamyine, Myanmar</option>
                      <option>Magway, Myanmar</option>
                      <option>Pyin Oo Lwin, Myanmar</option>
                    </select>
                    <span class="text-danger"><?= $job_region;?></span>
              </div>
            <div style="justify-content: space-between;width: 200px" class="d-flex">
              <div class="form-check">
              <input class="form-check-input" value="Part Time" name="job_type" type="radio" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                Part Time
              </label>
              </div>
              <div class="form-check">
              <input class="form-check-input" value="Full Time" type="radio" name="job_type" id="flexRadioDefault2" checked>
              <label class="form-check-label" for="flexRadioDefault2">
              Full Time
              </label>
              </div>
              </div>
              
              <div class="form-group">
                <label for="job-location">Vacancy</label>
                <input name="job_location" value="<?php if(isset($_POST['click_post'])){echo $_POST['job_location'];}?>" type="text" class="form-control" id="job-location" placeholder="e.g.10">
                <span class="text-danger"><?= $job_location;?></span>
              </div>

              <div class="form-group">
                <label for="job-category">Job Category</label>
                <select name="job_cate" value="<?php if(isset($_POST['click_post'])){echo $_POST['job_experience'];}?>" class="selectpicker border rounded" id="job-category" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Category">
                  <?php foreach($categories as $category):?>
                  <option><?= $category['name']?></option>
                  <?php endforeach;?>
                </select>
                <span class="text-danger"><?= $job_category;?></span>
              </div>

              <div class="form-group">
                <label for="job-experience">Experience</label>
                <select name="job_experience" value="<?php if(isset($_POST['click_post'])){echo $_POST['job_experience'];}?>" class="selectpicker border rounded" id="job-experience" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Years of Experience">
                  <option>1-3 years</option>
                  <option>3-6 years</option>
                  <option>6-9 years</option>
                </select>
                <span class="text-danger"><?= $job_exp;?></span>
              </div>

              <div class="form-group">
                <label for="job-salary">Salary</label>
                <select name="salary" value="<?php if(isset($_POST['click_post'])){echo $_POST['salary'];}?>" class="selectpicker border rounded" id="job-salary" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Salary">
                  <option>$50k-$70k</option>
                  <option>$70k-$100k</option>
                  <option>$100k-$150k</option>
                </select>
                <span class="text-danger"><?= $salary;?></span>
              </div>

              <div class="form-group">
                <label for="job-gender">Gender</label>
                <select name="gender" class="selectpicker border rounded" id="job-gender" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Gender">
                  <option>Male</option>
                  <option>Female</option>
                  <option>Any</option>
                </select>
                <span class="text-danger"><?= $gender;?></span>
              </div>

              <div class="form-group">
                <label for="job-location">Application Deadline</label>
                <input name="deadline" value="<?php if(isset($_POST['click_post'])){echo $_POST['deadline'];}?>" type="date" class="form-control" id="job-location" placeholder="eg-20-2-2024">
                <span class="text-danger"><?= $deadline;?></span>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Job Description</label> 
                  <textarea name="description" id="message" cols="30" rows="7" class="form-control" placeholder="Write Job Description..."><?php if(isset($_POST['click_post'])){echo $_POST['description'];}?></textarea>
                  <span class="text-danger"><?= $description;?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Responsibilities</label> 
                  <textarea name="respon" id="message" cols="30" rows="7" class="form-control" placeholder="Write Responsibilities..."><?php if(isset($_POST['click_post'])){echo $_POST['respon'];}?></textarea>
                  <span class="text-danger"><?= $respon;?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Education & Experience</label> 
                  <textarea name="education" id="message" cols="30" rows="7" class="form-control" placeholder="Write Education & Experience..."><?php if(isset($_POST['click_post'])){echo $_POST['education'];}?></textarea>
                  <span class="text-danger"><?= $education;?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Other Benifits</label> 
                  <textarea name="benefit" id="message" cols="30" rows="7" class="form-control" placeholder="Write Other Benifits..."><?php if(isset($_POST['click_post'])){echo $_POST['benefit'];}?></textarea>
                  <span class="text-danger"><?= $benefit;?></span>
                </div>
              </div>

              <div class="form-group">
                <input name = "company_email" value="<?= $_SESSION['email']?>" type="hidden" class="form-control" id="company-name" placeholder="Company Email">
                <span class="text-danger"><?= $c_email;?></span>
              </div>

              <div class="form-group">
                <input name="c_name" value="<?= $_SESSION['name']?>" type="hidden" class="form-control" id="company-name" placeholder="Company Name">
                <span class="text-danger"><?= $c_name;?></span>
              </div>

              <div class="form-group">
                <input name="c_id" value="<?= $_SESSION['id']?>" type="hidden" class="form-control" id="company-name" placeholder="Company ID">
                <span class="text-danger"><?= $c_id;?></span>
              </div>

              <div class="form-group">
                <input name="c_image" value="<?= $_SESSION['img_profile'];?>" type="hidden" class="form-control" id="company-name" placeholder="Company Image">
                <span class="text-danger"><?= $c_image;?></span>
              </div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
          
          <div class="col-lg-4 ml-auto">
            <div class="row">
              
              <div class="col-6">
                <input class="btn text-white btn-success" type="submit" value="Save post" name="click_post">
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- footer section -->
     
<?php require "view/partials/footer.php"?>