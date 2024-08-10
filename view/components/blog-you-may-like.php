<?php 
$randomOrders = $db->select("SELECT * FROM shows ORDER BY RAND() LIMIT 3");
?>


<section class="blogs_you_may_like">
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="row text-center">
            <?php foreach($randomOrders as $randomOrder):?>
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
              <img src="img/<?= $randomOrder['cover']?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <h4 class="card-title"><?= $randomOrder['title']?></h4>
                <p class="fs-6 text-secondary">
                <?= $randomOrder['author']?>
                  <span> - <?php 
                $original=$randomOrder['created_at'];
                $new=new DateTime($original);
                $current=$new->format('F j, Y');
                echo $current;
                ?></span>
                </p>
                <div class="tags my-3">
                  <span class="badge bg-warning text-dark"><?php 
              if($randomOrder['category_id'] == 1)
              {
                echo "စိုက်ပျိုးနည်း";
              }else{
                echo "ခေတ်သစ်စိုက်ပျိုးနည်း";
              }
              ?></span>
                </div>
                <p class="card-text line mb-3">
                  <?= $randomOrder['intro']?>
                </p>
                <a href="single?id_blog=<?= $randomOrder['id']?>" class="btn get text-white">Read More</a>
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
  </div>
</section>