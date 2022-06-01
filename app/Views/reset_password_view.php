<!-- Page Content -->
<!-- Heading Starts Here -->
<?php $validation = \Config\services::validation()?>

<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12 metrics-head">
        <p><a href="<?=base_url()?>/login">Home</a> / <span>Reset Password</span></p>
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

                <h3>Reset Password</h3>
                  <center>
                <?php if($validation->getError('cpwd')) {?>
                    <div class='alert alert-danger'  style ="width: 70%;">
                      <?= $error1 = $validation->getError('cpwd'); ?>
                    </div>
                <?php }?>

                <?php if($validation->getError('npwd')) {?>
                    <div class="alert alert-danger"  style ="width: 70%;">
                      <?= $error1 = $validation->getError('npwd'); ?>
                    </div>
                <?php }?>

                <?php if(session()->getTempdata('error')): ?>
                   <div class="alert alert-danger"  style ="width: 70%;"><?= session()->getTempdata('error'); ?></div>
                <?php endif;?>

                <?php if(isset($error)): ?>
                  <div class="alert alert-danger">
                  <?= $error ?>
                </div>
                    <?php else: ?>

                <?= form_open(); ?>
                       <div class="form-group" style ="width: 70%;">
                          <p>Enter new password</p>
                          <input type="password" class="form-control" name="npwd" id="npwd" value="" required>
                        </div>
                        <div class="form-group" style="width: 70%;">
                        <p>Confirm new password</p>
                        <input type="password" class="form-control" name="cpwd" id="cpwd" value="" required>
                      </div>
                        <button type="submit" class="btn btn-primary mb-3">Update</button>

                     <?= form_close(); ?>
                      <center>
                <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
