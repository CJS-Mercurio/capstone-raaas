<!-- Page Content -->
<!-- Heading Starts Here -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12 metrics-head">
        <p><a href="<?=base_url()?>/login">Home</a> / <span>Forgot Password</span></p>
      </div>
    </div>
  </div>
</div>
<!-- Heading Ends Here -->

<div class="container-fluid">
  <div class="row">
    <div class="col-12">

    </div>
  </div>
</div>


<!-- About Us Starts Here -->
<div class="metrics">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class=" center-content">
          <div class="section-heading center-content">

            <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="service-item">

                <h3>Forgot Password</h3>

                <?php if(isset($validation)): ?>
                  <div class="alert alert-danger">
                  <?= $validation->listErrors() ?>
                 </div>
                <?php endif; ?>

                <?php if(session()->getTempdata('error')): ?>
                   <div class="alert alert-danger"><?= session()->getTempdata('error'); ?></div>
                <?php endif;?>

                  <?php if(session()->getTempdata('success')): ?>
                   <div class="alert alert-success"><?= session()->getTempdata('success'); ?></div>
                <?php endif;?>
                <center>
                <form class="forgot-form mt5" action="<?=base_url()?>/forgot_pass" method="post" style="width: 70%;">
                  <div class="form-group">
                   <p class="mt-3">Enter your email</p>
                   <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>" required>
                  </div>
                  <button type="submit" class="btn btn-primary mb-3">Send Mail</button>

                </form>
                <center>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
