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

    <title> Developed App - Welcome Page </title>
  </head>
  <body>

    <?php
    // Error report for cookie-block browser.
    $error = null;
    if (!isset($_COOKIE['app_token'])) {
      $error = 'Account has been exist! But your browser has blocked cookies. So you cannot use our app! Please unblock cookies in your browser setting.';
    }

    ?>

    <div class="container-fluid">
      <div class="row my-5">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center m-4 p-5 bg-light shadow">

          <?php
            if (!empty($error)) {
          ?>

              <div class="alert alert-danger alert-dismissible my-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <small><?php echo $error; ?></small>
              </div>

          <?php  }
          ?>

          <h3>Welcome Our App.</h3>
          <p class="my-5">Let's get started.</p>
          <a class="btn btn-outline-info" href="home">Start</a>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </div>

  </body>
</html>
