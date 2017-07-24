<html>
  <head>
    <title>Notes Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://localhost/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="http://localhost/js/jquery-3.2.1.js"></script>
    <script src="http://localhost/js/login.js"></script>
  </head>
  <body>
    <div class="container">
      <br>
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="well">
                <div class="alert alert-danger" id="login-warn" role="alert" style="display:none">
                  <span class="glyphicon glyphicon-exclamation-sign"></span>
                  The email or password you have entered is invalid.
                </div>
                <h2>User Login</h2>
                <form id="login-form">
                    <!-- <meta name="csrf-token" content="<?php //echo csrf_token(); ?>"> -->
                    <div class="form-group">
                      <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                          <input type="email" class="form-control input-lg" id="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                          <input type="password" class="form-control input-lg" id="password" placeholder="Password">
                      </div>
                    </div>
                    <br>
                    <button class="btn btn-primary btn-lg" id="login-button"><span class="glyphicon glyphicon-log-in"></span> Login</button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>
