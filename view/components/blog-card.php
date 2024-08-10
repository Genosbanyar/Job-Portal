<?php foreach($shows as $show):?>
<div class="col-md-4 mb-4">
          <div class="card">
            <img
              src="img/<?= $show['cover']?>"
              class="card-img-top"
              alt="..."
            />
            <div class="card-body">
              <h4 class="card-title"><?= $show['title']?></h4>
              <p class="fs-6 text-secondary">
              <?= $show['author']?>
                <span> - 
                <?php 
                $original=$show['created_at'];
                $new=new DateTime($original);
                $current=$new->format('F j, Y');
                echo $current;
                ?></span>
              </p>
              <div class="tags my-3">
              <span class="badge bg-warning text-dark"><?php 
              if($show['category_id'] == 1)
              {
                echo "စိုက်ပျိုးနည်း";
              }else{
                echo "ခေတ်သစ်စိုက်ပျိုးနည်း";
              }
              ?></span>
              </div>
              <p class="card-text mb-3">
                <?= $show['intro']?>
              </p>
              <a href="single?id_blog=<?= $show['id']?>" class="btn get text-white">Read More</a>
            </div>
          </div>
        </div>
        <?php endforeach;?>