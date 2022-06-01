
<?php $validation = \Config\services::validation()?>
<div class="container-fluid login-form">
  <div class="row">
    <div class="col-lg-12">
      <h3>Sign In</h3>

        <?php if(session()->getTempdata('error')): ?>
           <div class="alert alert-danger"><?= session()->getTempdata('error'); ?></div>
        <?php endif;?>

        <?php if(session()->getTempdata('success')): ?>
           <div class="alert alert-success"><?= session()->getTempdata('success'); ?></div>
        <?php endif;?>

        <?php if(session()->getTempdata('successChange')): ?>
           <div class="alert alert-success"><?= session()->getTempdata('successChange'); ?></div>
        <?php endif;?>

        <div class="d-flex flex-column">
          <form class="" action="<?=base_url()?>/loginV" method="post">
            <label for="">Username</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                  <i class="fa fa-user"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= set_value('username') ?>" aria-describedby="basic-addon1" required>
            </div>
            <?php if($validation->getError('username')) {?>
                <div class='text-danger'>
                  <?= $error = $validation->getError('username'); ?>
                </div>
            <?php }?>
            <label for="">Password</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
              <input type="password" name="password" class="input form-control" id="password" data-type="password" placeholder="***********" aria-describedby="basic-addon1" required>
            </div>
            <?php if($validation->getError('password')) {?>
                <div class='text-danger'>
                  <?= $error = $validation->getError('password'); ?>
                </div>
            <?php }?>
            <button type="submit" class="btn btn-info btn-block btn-round mb-5">Submit</button>
          </form>
      </div>
      </div>
    </div>
  </div>
