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

    <?php
      $state = htmlspecialchars($_GET['state']);

      if (isset($state) && $state == 'signup') { ?>

        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="m-4 bg-yellow rounded-lg">
                <form class="p-5" action="account/signup" method="post">
                  <h4 class="text-center my-4">Signup</h4>
                  <div class="form-group">
                    <label for="user_email">Email</label>
                    <input class="form-control" id="user_email" type="email" name="user_email" value="" placeholder="@mail.com" required>
                  </div> <br>
                  <div class="form-group">
                    <label for="user_password">Password</label>
                    <input class="form-control" id="user_password" type="password" name="user_password" value="" placeholder="$4!@!a$*" required>
                  </div>
                  <div class="form-group my-5">
                    <button class="form-control btn btn-secondary" type="submit" name="btn_submit">Signup</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>

          <div class="row">
            <div class="col-12 text-center">
              <p class="text-secondary py-2"><a href="account?state=signin"><u>Signin</u></a></p>
            </div>
          </div>
        </div>

    <?php

      } else {

    ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <div class="m-4 bg-yellow rounded-lg">
              <form class="p-5" action="account/signin" method="post">
                <h4 class="text-center my-4">Signin</h4>
                <div class="form-group">
                  <label for="user_email">Email</label>
                  <input class="form-control" id="user_email" type="email" name="user_email" value="" placeholder="@mail.com" required>
                </div> <br>
                <div class="form-group">
                  <label for="user_password">Password</label>
                  <input class="form-control" id="user_password" type="password" name="user_password" value="" placeholder="$4!@!a$*" required>
                </div>
                <div class="form-group my-5">
                  <button class="form-control btn btn-outline-secondary" type="submit" name="btn_submit">Signin</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-sm-2"></div>
        </div>

        <div class="row">
          <div class="col-12 text-center">
            <p class="text-secondary py-2"><a href="account?state=signup"><u>Signup</u></a></p>
          </div>
        </div>
      </div>

    <?php } ?>

  </body>
</html>
