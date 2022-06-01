<?php $page_session = \Config\Services::session()?>

<div class="container-fluid choose-form">
  <div class="row">
    <div class="col-lg-12">
        <h3>Sign up</h3>

        <?php if($page_session->getTempdata('success')):?>
          <div class="alert alert-success"><?= $page_session->getTempdata('success');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('error')):?>
          <div class="alert alert-danger"><?= $page_session->getTempdata('error');?></div>
        <?php endif; ?>

        <form class="forgot-form" action="<?=base_url()?>/choose_role" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <label>Register As: </label>
              <div class="form-group mb-3">
                <select class="custom-select" id="role" name="role">
                  <option selected value="">Choose...</option>
                  <?php foreach ($role as $r): ?>
                    <?php if($r['deleted_at'] == NULL && $r['id'] != 2 && $r['id'] != 3): ?>
                      <option name="role" value="<?=$r['role_name']; ?>" <?= set_select('role', $r['role_name']) ?>><?= ucwords($r['role_name']); ?></option>
                    <?php endif; ?>
                  <?php endforeach ?>
                </select>
                  <span class="text-danger"> <?= display_error($validation, 'role'); ?></span>

              </div>
            </div>
         </div>

        <!-- FORM FOOTER -->
          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
            <div class="col-12 col-sm-8 text-right p-2">
              <a href="<?=base_url()?>/loginV">Already have an account?</a>
            </div>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>
