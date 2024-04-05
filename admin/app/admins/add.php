<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
auth();
include_once '../../shared/head.php';
include_once '../../shared/header.php';


if (isset($_POST['send'])) {


    $name = ($_POST['name']);
    $name = ($_POST['name']);
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $phone = ($_POST['phone']);

    // if (stringvalidation($name)) {
    //     $validationeror[] = "You Must Enter name";
    // }
    // if (stringvalidation($email)) {
    //     $validationeror[] = "You Must Enter email ";
    // }
    // if (stringvalidation($password)) {
    //     $validationeror[] = "You Must Enter password ";
    // }
    // if (stringvalidation($phone)) {
    //     $validationeror[] = "You Must Enter phone";
    // }


    // image
    $image_name =  time() . rand(0, 255) . $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $location =  "../../public/upload/"  . $image_name;
    move_uploaded_file($image_tmp, $location);
    $hash_password = sha1($password);
    $insert = "INSERT INTO admins VALUES (null , '$name','$email','$hash_password','$image_name','$phone')";
    $mysqli_run = mysqli_query($con, $insert);
    // header("http://localhost/car_rent/admin/app/admins/add.php");
    redirect('admin/app/admins/add.php');
    getMessage($mysqli_run, "Add Admin succes");
}

clearSessionDone();


?>

<div class="container col-8">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Create New Admin</h5>
            <?php if (!empty($validationeror)) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($validationeror as $eror) : ?>
                            <li><?= $eror ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['done'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['done']; ?>
                    <form action="" method="POST">
                        <button type="submit" name="clearSession" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </form>
                </div>
            <?php endif; ?>

            <!-- No LaclearSessionbels Form -->
            <form method="POST" class="row g-3" enctype="multipart/form-data">
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control" placeholder="Your Name">
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="col-md-6">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <div class="col-md-6">
                    <input name="image" type="file" class="form-control" placeholder="Password">
                </div>
                <div class="col-md-6">
                    <input type="text" name="phone" class="form-control" placeholder="phone">
                </div>
                <div class="text-center">
                    <button type="submit" name="send" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End No Labels Form -->

        </div>
    </div>
</div>

<?php
include_once '../../shared/script.php';
?>