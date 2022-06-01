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

              <form class="register-form" action="/OrtacFinal/reg_professor/<?=$role['role_id'];?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                     <label for="f_firstname">First Name</label>
                     <input type="text" class="form-control" name="f_firstname" id="f_firstname" value="<?= set_value('f_firstname') ?>">
                     <span class="text-danger"> <?= display_error($validation, 'f_firstname'); ?> </span>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                     <label for="f_middlename">Middle Name</label>
                     <input type="text" class="form-control" name="f_middlename" id="f_middlename" value="<?= set_value('f_middlename') ?>">
                     <!-- <span class="text-danger"> <?= display_error($validation, 'f_middlename'); ?> </span> -->
                    </div>
                  </div>


                  <div class="col-12">
                    <div class="form-group">
                     <label for="f_lastname">Last Name</label>
                     <input type="text" class="form-control" name="f_lastname" id="f_lastname" value="<?= set_value('f_lastname') ?>">
                     <span class="text-danger"> <?= display_error($validation, 'f_lastname'); ?></span>
                    </div>
                  </div>

                   <div class="col-12 col-sm-6">
                    <div class="form-group">
                     <label for="f_birthdate">Birthday</label>
                     <input type="date" class="form-control" name="f_birthdate" id="f_birthdate" value="<?= set_value('birthdate') ?>">
                     <span class="text-danger"> <?= display_error($validation, 'f_birthdate'); ?></span>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6">
                    <label for="f_gender">Gender</label>
                    <div class="input-group">
                      <?php if(count($gender) > 0): ?>
                        <select class="custom-select" id="f_gender" name="f_gender">
                          <option selected value="">Choose...</option>
                          <?php foreach ($gender as $g): ?>
                            <?php if($g['deleted_at'] == NULL): ?>
                                 <option name="f_gender" value="<?=$g['gender']; ?>" <?= set_select('f_gender', $g['gender']) ?>><?=$g['gender']; ?></option>
                            <?php endif; ?>
                          <?php endforeach ?>
                        </select>
                      <?php endif; ?>
                    </div>
                     <span class="text-danger"> <?= display_error($validation, 'f_gender'); ?></span>

                  </div>

                  <hr class="separate">

                   <div class="col-12 col-sm-6">
                    <div class="form-group">
                     <label for="f_code">Faculty Code</label>
                     <input type="text" class="form-control" name="f_code" id="f_code" placeholder="FA0001TG2009" value="<?= set_value('f_code') ?>">
                     <span class="text-danger"> <?= display_error($validation, 'f_code'); ?></span>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                     <label for="position">Position</label>
                     <input type="text" class="form-control" name="position" id="position" value="<?= set_value('position') ?>">
                     <span class="text-danger"> <?= display_error($validation, 'position'); ?></span>
                    </div>
                  </div>


                  <div class="col-12">
                    <label for="f_status">Status</label>
                    <div class="form-group mb-3">
                      <?php if(count($status) > 0): ?>
                        <select class="custom-select" id="f_status" name="f_status">
                          <option selected value="">Choose...</option>
                          <?php foreach ($status as $s): ?>
                            <?php if($s['deleted_at'] == NULL): ?>
                                 <option name="f_status" value="<?=$s['faculty_status']; ?>" <?= set_select('f_status', $s['faculty_status']) ?>><?=$s['faculty_status']; ?></option>
                            <?php endif; ?>
                          <?php endforeach ?>
                        </select>
                      <?php endif; ?>

                        <span class="text-danger"> <?= display_error($validation, 'f_status'); ?></span>

                    </div>
                  </div>

                  <hr class="separate">

                   <div class="col-12">
                    <label for="custom-file">School ID</label>
                    <div class="form-group">
                      <div class="custom-file">
                       <input id="inputGroupFile02" type="file" name="school_id">
                    </div>
                    <span class="text-danger"> <?= display_error($validation, 'school_id'); ?></span>
                    </div>
                  </div>


                  <hr class="separate">

                  <div class="col-12">
                    <div class="form-group">
                     <label for="email">Email address</label>
                     <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                       <span class="text-danger"> <?= display_error($validation, 'email'); ?></span>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" name="password" id="password" value="">
                     <span class="text-danger"> <?= display_error($validation, 'password'); ?></span>
                   </div>
                 </div>

                 <div class="col-12 col-sm-6">
                   <div class="form-group">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                     <span class="text-danger"> <?= display_error($validation, 'password_confirm'); ?></span>
                  </div>
                </div>
              </div>

                <div class="row">
                  <div class="col-12 col-sm-4">
                    <button type="submit" class="btn btn-success reg_btn">Register</button>
                  </div>
                  <div class="col-12 col-sm-8 text-right p-2">
                    <a href="/OrtacFinal/loginV">Already have an account?</a>
                  </div>
                </div>
              </form>
            </div>
  </div>
</div>
