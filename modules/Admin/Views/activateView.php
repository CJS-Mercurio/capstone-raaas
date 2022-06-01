
<?php $page_session = \Config\Services::session()?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 registration-form">
        <div class="guest-header">
          <h3 class="registration-header">Activation Process</h3>
            <?php if(session()->getTempdata('activate_error')): ?>
              <div class="alert alert-danger">
                <?= session()->getTempdata('activate_error'); ?>
              </div>

               <a href="<?=base_url()?>/login">Register Here</a>
           <?php endif; ?>

            <?php if(session()->getTempdata('activate_success')): ?>
              <div class="alert alert-success">
                <?= session()->getTempdata('activate_success'); ?>
              </div>

               <a class="register-form" href="<?=base_url()?>/login">Login Here</a>
           <?php endif; ?>


         </div>
    </div>
	</div>
</div>
