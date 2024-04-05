<?php

include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php' ?>
<?php
if (isset($_SESSION['admin'])) {
  $email = $_SESSION['admin']['email'];
  $name =  $_SESSION['admin']['name'];
  $image = $_SESSION['admin']['image'];
  $id = $_SESSION['admin']['id'];
};
$count = "SELECT COUNT(*) AS num FROM `cars` WHERE `is_active`='none' ";
$Selct_count = mysqli_query($con, $count);
$rowCount = mysqli_fetch_assoc($Selct_count);
$select = "SELECT * FROM `cars` WHERE `is_active`='none' ";
$alldata = mysqli_query($con, $select);
$row3 = mysqli_fetch_assoc($alldata);
// car owner
if ($row3) {
  $OWnerId = $row3['car_owner_id'];
  $Ownersselected = "SELECT * FROM `car-owners` WHERE id = $OWnerId ";
  $Owner = mysqli_query($con, $Ownersselected);
  $row4 = mysqli_fetch_assoc($Owner);
} else {
}
?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="<?= url('admin/index.php') ?>" class="logo d-flex align-items-center">

      <span class="d-none d-lg-block">C-RENT </span>

    </a>
  </div><!-- End Logo -->

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <?php if ($rowCount['num'] > 0) : ?>

            <span class="badge bg-primary badge-number"><?= $rowCount['num'] ?></span>
          <?php endif; ?>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have <?= $rowCount['num'] ?> new Registration
            <a href="<?= url('admin/requested.php') ?>"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <?php if ($row3) : ?>
            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>new car </h4>
                <p><?= $row3['car_model'] ?></p>
                <p><?= $row4['name'] ?></p>
              </div>
            </li>
          <?php endif; ?>
          <li class="dropdown-footer">
            <a href="<?= url('admin/requested.php') ?>">Show all Registrations</a>
          </li>

        </ul><!-- End Notification Dropdown Items -->

      </li><!-- End Notification Nav -->

      <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-left-text"></i>
          <span class="badge bg-success badge-number">3</span>
        </a><!-- End Messages Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
          <li class="dropdown-header">
            You have 3 new messages
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Maria Hudson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>4 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Anna Nelson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>6 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
              <div>
                <h4>David Muldon</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>8 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="dropdown-footer">
            <a href="#">Show all messages</a>
          </li>

        </ul><!-- End Messages Dropdown Items -->

      </li><!-- End Messages Nav -->

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?= url("admin/public/upload/") . $image ?>" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"> <?= $name ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?= $name ?></h6>
            <span>Administration</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= url('admin/admin-profile.php') ?>">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>


          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= url('admin/app/admins/add.php') ?>">
              <i class="bi bi-person-plus-fill"></i>
              <span>Add New Admin</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= url('admin/requested.php') ?>">
              <i class="bi bi-slash-circle"></i>
              <span>Block list</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>



          <li>
            <a class="dropdown-item d-flex align-items-center" onclick="clearSessionDone()" href="<?= url('admin/pages-login.php') ?>?logout=">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->


<main id="main">