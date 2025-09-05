<!DOCTYPE html>
<html>
<head>
  <?php 
    include "lib/conn.php";
    include 'script.php';
  ?>
<style>
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    background: url('background.jpg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .login-box {
    width: 360px;
  }

.login-box-body {
  background: rgba(255, 255, 255, 0.1); /* transparan putih */
  border-radius: 20px;
  padding: 20px 30px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
}
.login-mark{
  color: #fff;
  font-weight: 600;
  text-align: center;
  margin-bottom: 20px;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
}
.login-title {
  color: #fff;
  font-weight: 600;
  text-align: center;
  margin-bottom: 20px;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
}
.login-logo-img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 50%;
  margin-bottom: 15px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

</style>
</head>
<body>
<div class="login-box">
  <div class="login-logo">
  <img src="background.jpg" alt="Logo" class="login-logo-img">
</div>

  <!-- /.login-logo -->
  <div class="login-box-body">
      <h2><div class="login-mark"><h2>
    <b>Yayasan EAS</b>
  </div>
    <h3 class="login-title">Welcome to Yayasan Energi System Information</h3>
    <form action="login_check.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="Login">
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- Lupa password dan Register 

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

    -->
  </div>
  <!-- /.login-box-body -->
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
