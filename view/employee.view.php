<?php 
require "view/partials/header.php";
?>  
<!-- NAVBAR -->
<?php 
require "view/components/nav.php";
require "config/QueryBuilder.php";
//showing employees
$employees = $db->select("SELECT * FROM users WHERE type='Employee'");

?>
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Employees</h1>
            <div class="custom-breadcrumbs">
              <a href="/">Home</a> <span class="mx-2 slash">/</span>
              <a href="employee">type</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Employees</strong></span>
            </div>
          </div>
        </div>
      </div>
</section>

<section class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 d-employee">
        <?php foreach($employees as $employee):?>
        <div class="card profile mt-5 mr-5" style="width: 18rem;">
            <img style="height: 250px;" class="card-img-top" src="images/<?= $employee['img']?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $employee['username']?></h5>
                <p class="card-text"><?php echo substr($employee['bio'],0, 50)?></p>
                <a target="_blank" href="my_profile?id=<?= $employee['id']?>" class="btn btn-primary">Go to profile</a>
            </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</section>

<?php require "view/partials/footer.php"?>