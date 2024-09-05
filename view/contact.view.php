<?php 
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/src/Exception.php';
require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/SMTP.php';

require "view/partials/header.php";?>    
    <!-- NAVBAR -->
    <?php require "view/components/nav.php";
    require "config/QueryBuilder.php";
    $trendingKeys = $db->select("SELECT COUNT(keyword) AS count, keyword FROM keyword GROUP BY keyword ORDER BY count DESC LIMIT 4");
    $errFirstName = "";
    $errLastName="";
    $errEmail="";
    $errMessage="";
    if(isset($_POST['btn_send_email'])){
      if(empty($_POST['first_name'])){
        $errFirstName="The first name field is required!";
      }
      if(empty($_POST['last_name'])){
        $errLastName="The last name field is required!";
      }
      if(empty($_POST['email'])){
        $errEmail="The email field is required!";
      }
      if(empty($_POST['message'])){
        $errMessage="The message field is required!";
      }
      if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['message'])){
        $subject = $_POST['subject'];
        $header = $_POST['email'];
        $message = $_POST['message'];
        $fullName = $_POST['first_name']. " " .$_POST['last_name'];
        try{
          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->Host = "smtp.gmail.com";
          $mail->SMTPAuth = true;
          $mail->Username="bnyar012@gmail.com";
          $mail->Password = 'lpinidvnwerdwdlx';  
          $mail->SMPTSecure = 'ssl';                             
          $mail->Port = 587;
          $mail->setFrom("bnyar012@gmail.com");
          $mail->addAddress($header);
          $mail->isHTML(true);
          $mail->subject=$subject;
          $mail->Body=$message;
          //$mail->AltBody = strip_tags($message);
          $mail->send();
        }catch(Exception $e){
        echo "Err: ".$mail->ErrInfo;
        }
      }
    }
    ?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Contact Us</h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Contact Us</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <form action="" method="POST" class="">

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input name = "first_name" type="text" id="fname" class="form-control">
                  <span class="text-danger"><?= $errFirstName?></span>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input name="last_name" type="text" id="lname" class="form-control">
                  <span class="text-danger"><?= $errLastName?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input name="email" type="email" id="email" class="form-control">
                  <span class="text-danger"><?= $errEmail?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input name="subject" type="subject" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                  <span class="text-danger"><?= $errMessage?></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input name="btn_send_email" type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
                </div>
              </div>
            </form>
</div>     
        </div>
      </div>
    </section>
    <!-- footer section -->
     
<?php require "view/partials/footer.php"?>