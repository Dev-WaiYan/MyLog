<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


use App\Controller\Authentication;
use App\Controller\UserAccountController;
use App\Controller\Security;


require_once 'controller/account_controller/Authentication.php';
require_once 'controller/UserAccountController.php';
require_once 'controller/utility/Security.php';


$error = null; // Error report require.
$data = null; // Required
$state = 'signin'; // Default state can change ('signin' or 'signup')


// Signin Process
if (isset($_POST['btn_signin'])) {
  $state = 'signin';

  // Signin Data
  $data = array(
    'user_email'=>$_POST['user_email'],
    'user_password'=>$_POST['user_password']
  );

  try {

    $instance = Authentication::getInstance();
    $result = $instance->checkAuthentication($data);

    if (count($result) > 0) {
      $error = $result['error'];
    }

  } catch (\Exception $e) {
    $error = $e->getMessage();
  }

}



// Signup Process
if (isset($_POST['btn_signup'])) {
  $state = 'signup';

  // Signup Data
  $data = array(
    'user_email'=>$_POST['user_email'],
    'user_password'=>$_POST['user_password']
  );

  try {

    $controller = UserAccountController::getInstance();
    $controller->createAccount($data);
    header('Location: welcome'); // Redirect after signup
    exit();

  } catch (\Exception $e) {
    $error = $e->getMessage();
  }

}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="js/style.js" charset="utf-8"></script>

    <title> Developed App - Signin/Signup </title>
  </head>
  <body>

    <div class="container-fluid">
      <div class="row">

        <?php
          if (!empty($error)) {
        ?>
        <div class="col-sm-12">
          <div class="alert alert-danger alert-dismissible my-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <small><?php echo $error; ?></small>
          </div>
        </div>
        <?php
          }
        ?>

        <div class="col-sm-3"></div>

        <!-- Signup -->
        <div class="col-sm-6" id="signup" style="<?php if ($state == 'signin') {echo 'display: none;';} ?>">
          <div class="bg-yellow rounded-lg">
            <form class="p-5" action="" method="post">
              <h4 class="text-center my-4">Signup</h4>
              <div class="form-group">
                <label for="user_email">Email</label>
                <input class="form-control" id="user_email" type="email" name="user_email" value="<?php if($data != null) {echo $data['user_email'];} ?>" placeholder="@mail.com" required>
              </div> <br>
              <div class="form-group">
                <label for="user_password">Password</label>
                <input class="form-control" id="user_password" type="password" name="user_password" value="" placeholder="$4!@!a$*" required>
              </div>
              <div class="form-group my-5">
                <button class="form-control btn btn-secondary" type="submit" name="btn_signup">Signup</button>
              </div>
            </form>
          </div>

          <div class="text-center m-3">
            <button class="btn btn-outline-primary" type="button" name="button" onclick="viewSignin()">Signin</button>
          </div>

        </div>



        <!-- Signin -->
        <div id="signin" class="col-sm-6" style="<?php if ($state == 'signup') {echo 'display: none;';} ?>">
          <div class="bg-yellow rounded-lg">
            <form class="p-5" action="" method="post">
              <h4 class="text-center my-4">Signin</h4>
              <div class="form-group">
                <label for="user_email">Email</label>
                <input class="form-control" id="user_email" type="email" name="user_email" value="<?php if($data != null) {echo $data['user_email'];} ?>" placeholder="@mail.com" required>
              </div> <br>
              <div class="form-group">
                <label for="user_password">Password</label>
                <input class="form-control" id="user_password" type="password" name="user_password" value="" placeholder="$4!@!a$*" required>
              </div>
              <div class="form-group my-5">
                <button class="form-control btn btn-outline-secondary" type="submit" name="btn_signin">Signin</button>
              </div>
            </form>
          </div>

          <div class="text-center m-3">
            <button class="btn btn-outline-primary" type="button" name="button" onclick="viewSignup()">Signup</button>
          </div>

        </div>

        <div class="col-sm-3"></div>
      </div>

    </div>



<script type="text/javascript">

  let signin = document.getElementById('signin');
  let signup = document.getElementById('signup');

  function viewSignin()
  {
    signin.style.display = 'initial';
    signup.style.display = 'none';
  }


  function viewSignup()
  {
    signin.style.display = 'none';
    signup.style.display = 'initial';
  }

</script>



  </body>
</html>
