<?php $page_session = \Config\Services::session()?>

<div class="container-fluid reg-form">
  <div class="row">
    <div class="col-lg-12">
        <h3>REGISTRATION</h3>

        <?php if($page_session->getTempdata('success')):?>
          <div class="alert alert-success"><?= $page_session->getTempdata('success');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('error')):?>
          <div class="alert alert-danger"><?= $page_session->getTempdata('error');?></div>
        <?php endif; ?>

        <div class="alert alert-warning" role="alert">
          <b>Warning: </b>Fields with asterisk (*) are required.
        </div>

        <form class="register-form" action="/OrtacFinal/reg_member/<?=$role['role_id'];?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="first_name">First Name <span style="color: red; ">*</span></label>
               <input type="text" class="form-control" name="first_name" id="first_name" value="<?= set_value('first_name') ?>">
              <span class="text-danger"> <?= display_error($validation, 'first_name'); ?></span>
              </div>
            </div>

            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="middle_name">Middle Name (optional)</label>
               <input type="text" class="form-control" name="middle_name" id="middle_name" value="<?= set_value('middle_name') ?>">
              <!-- <span class="text-danger"> <?= display_error($validation, 'middle_name'); ?></span> -->
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
               <label for="last_name">Last Name <span style="color: red; ">*</span></label>
               <input type="text" class="form-control" name="last_name" id="last_name" value="<?= set_value('last_name') ?>">
                  <span class="text-danger"> <?= display_error($validation, 'last_name'); ?></span>
              </div>
            </div>

            <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="birthdate">Birthday <span style="color: red; ">*</span></label>
              <!-- <button type="button" class="form-control" id="button" data-date-format="yyyy-mm-dd" data-date="2012-02-20" value="<?= set_value('birthdate') ?>">Your Date Picker</button> -->
              <input type="date" class="form-control" max="<?php echo date('Y-m-d'); ?>" name="birthdate" id="birthdate" value="<?= set_value('birthdate') ?>">
                <span class="text-danger"> <?= display_error($validation, 'birthdate'); ?></span>
             </div>
           </div>

           <div class="col-12 col-sm-6">
              <label for="gender">Gender <span style="color: red; ">*</span></label>
              <div class="input-group">
                <?php if(count($gender) > 0): ?>
                  <select class="custom-select" id="gender" name="gender">
                    <option selected value="">Choose...</option>
                    <?php foreach ($gender as $g): ?>
                      <?php if($g['deleted_at'] == NULL): ?>
                           <option name="gender" value="<?=$g['gender']; ?>" <?= set_select('gender', $g['gender']) ?>><?=$g['gender']; ?></option>
                      <?php endif; ?>
                    <?php endforeach ?>
                  </select>
                <?php endif; ?>
              </div>
               <span class="text-danger"> <?= display_error($validation, 'gender'); ?></span>

            </div>

            <hr class="separate">

             <div class="col-12">
              <label for="custom-file">Valid ID <span style="color: red; ">*</span></label>
              <div class="form-group">
                <div class="custom-file">
                 <input class="reg-input-id" id="inputGroupFile02" type="file" name="valid_id" value="<?= set_value('file') ?>">
              </div>
              <span class="text-danger"> <?= display_error($validation, 'valid_id'); ?></span>
              </div>
            </div>

            <hr class="separate">

            <div class="col-12">
              <div class="form-group">
               <label for="email">Email address <span style="color: red; ">*</span></label>
               <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                 <span class="text-danger"> <?= display_error($validation, 'email'); ?></span>
              </div>
            </div>

            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="password">Password <span style="color: red; ">*</span></label>
               <input type="password" class="form-control" name="password" id="password" value="">
                  <span class="text-danger"> <?= display_error($validation, 'password'); ?></span>
             </div>
           </div>

           <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="password_confirm">Confirm Password <span style="color: red; ">*</span></label>
              <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
               <span class="text-danger"> <?= display_error($validation, 'password_confirm'); ?></span>
            </div>
          </div>

    </div>

        <!-- FORM FOOTER -->
          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-success">Register</button>
            </div>
            <div class="col-12 col-sm-8 text-right p-2">
              <a href="/OrtacFinal/loginV">Already have an account?</a>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
