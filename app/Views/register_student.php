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

        <form class="register-form" action="/OrtacFinal/reg_student/<?=$role['role_id'];?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="first_name">*First Name</label>
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
               <label for="last_name">*Last Name</label>
               <input type="text" class="form-control" name="last_name" id="last_name" value="<?= set_value('last_name') ?>">
                  <span class="text-danger"> <?= display_error($validation, 'last_name'); ?></span>
              </div>
            </div>

            <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="birthdate">*Birthday</label>
              <!-- <button type="button" class="form-control" id="button" data-date-format="yyyy-mm-dd" data-date="2012-02-20" value="<?= set_value('birthdate') ?>">Your Date Picker</button> -->
              <input type="date" class="form-control" name="birthdate" id="birthdate" value="<?= set_value('birthdate') ?>">
                <span class="text-danger"> <?= display_error($validation, 'birthdate'); ?></span>
             </div>
           </div>

           <div class="col-12 col-sm-6">
              <label for="gender">*Gender</label>
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
             <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="student_number">*Student Number</label>
               <input type="text" class="form-control" name="student_number" id="student_number" value="<?= set_value('student_number') ?>">
                <span class="text-danger"> <?= display_error($validation, 'student_number'); ?></span>
              </div>
            </div>

             <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="batch_year">*Batch Year</label>
               <input type="text" class="form-control" name="batch_year" id="batch_year" value="<?= set_value('batch_year') ?>" placeholder="yyyy-yyyy">
                  <span class="text-danger"> <?= display_error($validation, 'batch_year'); ?></span>
              </div>
            </div>

            <div class="col-12">
              <label for="year">*Year</label>
              <div class="input-group">
                <?php if(count($year) > 0): ?>
                  <select class="custom-select" id="year" name="year">
                    <option selected value="">Choose...</option>
                    <?php foreach ($year as $y): ?>
                      <?php if($y['deleted_at'] == NULL): ?>
                           <option name="year" value="<?=$y['academic_year']; ?>" <?= set_select('year', $y['academic_year']) ?>><?=$y['academic_year']; ?></option>
                      <?php endif; ?>
                    <?php endforeach ?>
                  </select>
                <?php endif; ?>
              </div>
              <span class="text-danger"> <?= display_error($validation, 'year'); ?></span>
            </div>

            <div class="col-12">
              <label for="course" class="label mt-3">*Course</label>
              <div class="form-group mb-3">
                <?php if(count($course) > 0): ?>
                <select class="custom-select" id="course" name="course">
                  <option selected value="">Choose...</option>
                  <?php foreach ($course as $c): ?>
                         <option name="course" value="<?=$c['id']; ?>" <?= set_select('course', $c['course_name']) ?>><?=$c['course_name']; ?></option>
                  <?php endforeach ?>
                </select>
              <?php endif; ?>
                  <span class="text-danger"> <?= display_error($validation, 'course'); ?></span>

              </div>
            </div>

            <div class="col-12">
              <label for="academic_status">*Academic Status</label>
              <div class="form-group mb-3">
                <?php if(count($acad_status) > 0): ?>
                  <select class="custom-select" id="academic_status" name="academic_status">
                    <option selected value="">Choose...</option>
                    <?php foreach ($acad_status as $as): ?>
                      <?php if($as['deleted_at'] == NULL): ?>
                           <option name="academic_status" value="<?=$as['academic_status']; ?>" <?= set_select('academic_status', $as['academic_status']) ?>><?=$as['academic_status']; ?></option>
                      <?php endif; ?>
                    <?php endforeach ?>
                  </select>
                <?php endif; ?>

                  <span class="text-danger"> <?= display_error($validation, 'academic_status'); ?></span>

              </div>
            </div>

            <hr class="separate">

             <div class="col-12">
              <label for="custom-file">*School ID</label>
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
               <label for="email">*Email address</label>
               <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                 <span class="text-danger"> <?= display_error($validation, 'email'); ?></span>
              </div>
            </div>

            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="password">*Password</label>
               <input type="password" class="form-control" name="password" id="password" value="">
                  <span class="text-danger"> <?= display_error($validation, 'password'); ?></span>
             </div>
           </div>

           <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="password_confirm">*Confirm Password</label>
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
