<?php
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php' ;
include_once '../shared/head.php';




if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $image_name =  time() . rand(0, 255) . $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $location = url("user/assets/img/carOwner/")  . $image_name;

    $hash_password = sha1($password);
    $create = "INSERT INTO `car-owners` VALUES (null,'$name' ,'$email','$phone',DEFAULT , '$hash_password' ,DEFAULT, 'unblock' , '$image_name' ) ";
    $INSER = mysqli_query($con,$create);
    redirect("user/owner/login.php");
}
?>
<div class="layoutsign">
    <div class="signup">
        <div class="signup-connect">
            <h1>Create your account as Car Owner</h1>
            <a href="#" class="btnn btnn-social btn-facebook"><i class="fa-brands fa-facebook-f"></i> Sign in with Facebook</a>
            <a href="#" class="btnn btnn-social btn-google"><i class="fa-brands fa-google"></i> Sign in with Google</a>
            <a href="#" class="btnn btnn-social btn-linkedin"><i class="fa-brands fa-linkedin-in"></i> Sign in with Linkedin</a>
        </div>
        <div class="signup-classic">
            <h2>Classical way</h2>
            <form class="form" method="POST" enctype="multipart/form-data">
                <fieldset class="username">
                    <input name="name" class="form-control" type="text" placeholder="username" />
                </fieldset>
                <fieldset class="email">
                    <input name="email" class="form-control" type="email" placeholder="email" />
                </fieldset>
                <fieldset class="password">
                    <input name="password" class="form-control" type="password" placeholder="password" />
                </fieldset>
                
                <fieldset class="phone">
                    <input name="phone" class="form-control" type="phone" placeholder="phone" />
                </fieldset>
                <fieldset class="image">
                    <input name="image" class="form-control" type="file" placeholder="image" />
                </fieldset>
                <button type="submit" name="submit" class="form-control btn btn-inf ">sign up</button>
             </form>
        </div>
    </div>

</div>











<?php
include_once '../shared/script.php';
?>