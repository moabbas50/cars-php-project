<?php
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once './shared/head.php';
include_once './shared/header.php';
// list
$id = $_SESSION['admin']['id'];
$select = "SELECT * FROM `admins` WHERE id ='$id' ";
$data = mysqli_query($con, $select);
$rowd = mysqli_fetch_assoc($data);


// upload////
$name = $rowd['name'];
$email = $rowd['email'];
$phone = $rowd['phone'];
$password = $rowd['passowrds'];
$masseage = "";
$oldpassword = "";
$newpassword = "";
$renewpassword = "";
// change password
if (isset($_POST['change'])) {
  if (sha1($_POST['password']) == $password) {
    if ($_POST['newpassword'] == $_POST['renewpassword']) {
      $newpassword = sha1($_POST['newpassword']);
      $update = "UPDATE `admins` SET passowrds = '$newpassword'  where id=$id";
      $updatequery = mysqli_query($con, $update);
      redirect("admin-profile.php");
    } else {
      $masseage = "incorect renewpassword";
      $oldpassword = $_POST['password'];
      $newpassword = $_POST['newpassword'];
    }
  } else {
    $masseage = "incorect old password";
    $renewpassword = $_POST['renewpassword'];
    $newpassword = $_POST['newpassword'];
  }
};

if (isset($_POST['updateimage'])) {
  $image_name =  time() . rand(0, 255) . $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  $location = ("./public/upload/")  . $image_name;
  move_uploaded_file($image_tmp, $location);
  // update
  $update = "UPDATE `admins` SET image = '$image_name'  where id=$id";
  $updatequery = mysqli_query($con, $update);
  $_SESSION['admin']['image'] = $image_name;
  redirect("admin/admin-profile.php");
};
if (isset($_POST['updatedata'])) {
  $name = $_POST['fullName'];
  $email = $_POST['email'];
  $phone = $_POST['Phone'];
  $update = "UPDATE `admins` SET name = '$name', email ='$email', phone='$phone'  where id=$id";
  $updatequery = mysqli_query($con, $update);
  $_SESSION['admin']['name'] = $name;
  $_SESSION['admin']['email'] = $email;
  redirect("admin/admin-profile.php");
};


?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= url('admin/index.php') ?>">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?= url("admin/public/upload/") . $rowd['image'] ?>" alt="Profile" class="rounded-circle">
            <h2><?= $rowd['name'] ?></h2>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <div class="nav-link Editprofile  ">Edit Profile</div>
              </li>
            </ul>
            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="<?= url("admin/public/upload/") . $rowd['image'] ?>" alt="Profile">
                    <input name="image" type="file" class="form-control " id="fullName" value="Kevin Anderson">
                    <button href="#" class="btn btn-primary  mt-2 px-4 py-2" name="updateimage" title="Upload new profile image">update</button>
                  </div>
                </div>
              </form>

              <form method="POST">
                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> Full Name </label>
                  <div class="col-md-8 col-lg-9">
                    <input value="<?= $name  ?>" name="fullName" type="text" class="form-control" id="fullName" placeholder="">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email" class="col-md-4 col-lg-3 col-form-label"> Email </label>
                  <div class="col-md-8 col-lg-9">
                    <input value="<?= $email  ?>" name="email" type="text" class="form-control" id="email" placeholder="">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label"> Phone </label>
                  <div class="col-md-8 col-lg-9">
                    <input value="<?= $phone ?>" name="Phone" type="text" class="form-control" id="Phone" placeholder="">
                  </div>
                </div>
                <div class=" mb-3 text-center">
                  <button href="#" class="btn btn-primary  mt-2 px-4 py-2" name="updatedata" title="">update</button>
                </div>
              </form>
            </div>
            <!-- End Profile Edit Form -->

            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <div class="nav-link Editprofile ">Change Password</div>
              </li>
            </ul>
            <div class="tab-pane fade show active profile-edit pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form method="POST">

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input value="<?= $oldpassword ?>" name="password" type="password" class="form-control" id="currentPassword">
                  </div>
                  <?php if (isset($_POST['password'])) : ?>
                    <?php if (sha1($_POST['password']) != $password) : ?>
                      <div class="alert alert-danger">
                        <?= $masseage ?>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input value="<?= $newpassword ?>" name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input value="<?= $renewpassword ?>" name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                  <?php if (isset($_POST['password'])) : ?>
                    <?php if ($_POST['newpassword'] != $_POST['renewpassword']) : ?>
                      <div class="alert alert-danger">
                        <?= $masseage ?>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>

                <div class="text-center">
                  <button name="change" type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php
include_once './shared/script.php';
?>