<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <link rel="icon" type="image/x-icon" href="img/favicon.png" />
    <script
      src="https://kit.fontawesome.com/225a355f8f.js"
      crossorigin="anonymous"
    ></script>
    <style>
      .card {
        /* width: 350px;
        height: 120px;
        margin-left: 50px; */
      }
      .container {
        margin-top: 50px;
        margin-right: 190px;
        float: right; 
        margin: 0 auto;
        padding-top: 30px
      }
      .number {
        font-weight: bold;
      }
      .container-nav {
        background-color: #071e3d;
        height: 80px;
      }
      .navi {
        width: 85rem;
        display: flex;
        justify-content: space-between;
        padding-top: 19px;
        margin: 0 auto;
      }
      .font {
        font-weight: bold;
        color: white;
        font-size: 25px;
      }
      .font_admin {
        font-size: 20px;
        color: white;
      }
      ul {
        list-style: none;
        margin-top: 20px;
      }
      a {
        color: whitesmoke;
        font-size: 20px;
      }
      li {
        padding-bottom: 30px;
      }
      section {
        background-color: #1f4287;
        width: 230px;
        display: inline-block;
        height: 730px;
      }
      .flex {
        width: 200px;
        display: flex;
        justify-content: space-between;
      }
      .alert{
        width: 400px;
        margin-left: 180px;
      }
    </style>
  </head>
  <?php 
  require "config/QueryBuilder.php";
  $admins = $db->select("SELECT * FROM admins");
  ?>
  <body>
    <div class="container-nav">
      <nav class="navi">
      <span class="font">BURMESE AGRICULTURE</span>
        <div class="flex">
          <span class="font_admin"><?= $_SESSION['user_name']?></span>
          <?php if(isset($_SESSION['user_name'])):?>
          <a onclick="return confirm('Are you sure to logout?')" href="logout"
            >Logout</a
          >
          <?php endif;?>
        </div>
      </nav>
    </div>
    <section>
      <ul>
        <li>
          <a href="dashboard">Home</a>
        </li>
        <li>
          <a href="admins_in">Admins</a>
        </li>
        <li>
          <a href="show">Shows</a>
        </li>
      </ul>
    </section>
    <div class="container">
    <?php if(isset($_SESSION['post'])):?>
    <div class="alert text-center alert-success alert-dismissible fade show" role="alert">
    <?php echo $_SESSION['post']; unset($_SESSION['post']);?>
    </div>
    <?php endif;?>
      <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="card-title d-flex justify-content-between">
                    <h3>Admins</h3>
                    <a href="create_admin" class="btn btn-primary float-right">Create Admins</a>
                    </div> 
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>username</th>
                                <th>email</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($admins as $admin):?>
                            <tr>
                                <td><?= $admin['id']?></td>
                                <td><?= $admin['name']?></td>
                                <td><?= $admin['email']?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>

    <script
      src="https://kit.fontawesome.com/225a355f8f.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
