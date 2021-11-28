
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SIP SINDANG &mdash; Login Panel</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <!-- <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>css/style.css"> -->
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>css/stylev2.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
            <div class="offset-md-2 col-md-8 offset-md-2">
                <div class="login-brand">
                <!-- <img src="<?=base_url('/assets/theme/stisla/');?>img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                <h4>SISTEM INFORMASI POSYANDU SINDANG <?= print_r($this->session->userdata('remember_me')) ?></h4>
            </div>
        </div>
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <?=(($this->session->flashdata('pesan1')) ? $this->session->flashdata('pesan1') : '') ?>
                <form method="POST" action="<?= base_url('login/do_login'); ?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="uname">Username</label>
                    <input id="uname" type="uname" class="form-control" name="uname" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="pass" class="control-label">Password</label>
                    </div>
                    <input id="pass" type="password" class="form-control" name="pass" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Ingat saya</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="simple-footer">
                Copyright &copy; 2021 <div class="bullet"></div> APP SISTEM INFORMASI POSYANDU <a href="#">SINDANG</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/jquery.min.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/popper.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/tooltip.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/moment.min.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="<?=base_url('/assets/theme/stisla/');?>js/scripts.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>js/custom.js"></script>
</body>
</html>