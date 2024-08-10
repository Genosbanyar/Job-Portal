<header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.html">JobBoard</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="/" class="nav-link active">Home</a></li>
              <li><a href="about">About</a></li>
              <li><a href="company">Companies</a></li>
              <li><a href="contact">Contact</a></li>
              <?php if(isset($_SESSION['name'])):?>
                <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['name']?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="my_profile?id=<?= $_SESSION['id']?>">My profile</a></li>
            <li><a class="dropdown-item" href="update_profile?id=<?= $_SESSION['id']?>">Update Profile</a></li>
            <?php if(isset($_SESSION['type']) && $_SESSION['type'] == "Employee"):?>
            <li><a class="dropdown-item" href="saved_job?id=<?= $_SESSION['id']?>">Saved jobs</a></li>
            <?php endif;?>
            <?php if(isset($_SESSION['type']) && $_SESSION['type'] == "Company"):?>
            <li><a class="dropdown-item" href="job_applicant?id=<?= $_SESSION['id']?>">Job Applicants</a></li>
            <?php endif;?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout">Log out</a></li>
          </ul>
        </li>
                <?php endif;?>
              <li class="d-lg-none"><a href="login">Log In</a></li>
            </ul>
          </nav>
          
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
            <?php if(isset($_SESSION['name'])):?>
              <?php if(isset($_SESSION['type']) && $_SESSION['type'] == "Company"):?>
              <a href="post_job" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Post a Job</a>
              <?php endif;?>
              <?php endif;?>
              <?php if(!isset($_SESSION['name'])):?>
                <a href="login" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a>
              <a href="registration" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Register</a>
              <?php endif;?>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>