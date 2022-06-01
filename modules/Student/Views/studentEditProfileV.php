<?php $page_session = \Config\Services::session()?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 pt-3 pb-3 bg-white from-wrapper">
        <h3>Register</h3>
        <hr>
        <?php if($page_session->getTempdata('success')):?>
          <div class="alert alert-success"><?= $page_session->getTempdata('success');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('error')):?>
          <div class="alert alert-danger"><?= $page_session->getTempdata('error');?></div>
        <?php endif; ?>

        <form class="" action="<?= base_url() ?>/student/edit" method="post">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
               <label for="first_name">First Name</label>
               <input type="text" class="form-control" name="first_name" id="first_name" value='<?= $userdata->first_name?>'>

                 <span class="text-danger"> <?= display_error($validation, 'first_name'); ?></span>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
               <label for="middle_name">Middle Name</label>
               <input type="text" class="form-control" name="middle_name" id="middle_name" value="<?= $userdata->middle_name?>">

              <span class="text-danger"> <?= display_error($validation, 'middle_name'); ?></span>
              </div>
            </div>


            <div class="col-12">
              <div class="form-group">
               <label for="last_name">Last Name</label>
               <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $userdata->last_name ?>">

               <span class="text-danger"> <?= display_error($validation, 'last_name'); ?></span>

              </div>
            </div>

            <div class="col-12 col-sm-6">
              <label for="gender">Gender</label>
              <div class="input-group mb-3">
                <select class="custom-select" id="gender" name="gender">
                  <option value="<?= $userdata->gender?>"><?= $userdata->gender?></option>
                  <option name="gender">Male</option>
                  <option name="gender">Female</option>
                  <option name="gender">Other</option>
                </select>

                <span class="text-danger"> <?= display_error($validation, 'gender'); ?></span>
              </div>
            </div>
             <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="birthdate">Birthday</label>
               <input type="text" class="form-control" name="birthdate" id="birthdate" value="<?= $userdata->birthdate ?>">
                <span class="text-danger"> <?= display_error($validation, 'birthdate'); ?></span>

              </div>
            </div>
             <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="student_number">Student Number</label>
               <input type="text" class="form-control" name="student_number" id="student_number" value="<?= $userdata->student_number ?>">

                 <span class="text-danger"> <?= display_error($validation, 'student_number'); ?></span>

              </div>
            </div>
             <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="batch_year">Batch Year</label>
               <input type="text" class="form-control" name="batch_year" id="batch_year" value="<?= $userdata->batch_year ?>">

                <span class="text-danger"> <?= display_error($validation, 'batch_year'); ?></span>


              </div>
            </div>

            <div class="col-12">
              <label for="pup_branch">PUP Branch/Campus</label>
              <div class="input-group mb-3">
                <select class="custom-select" id="pup_branch" name="pup_branch">
                  <option selected></option>
                  <option name="pup_branch" selected="">One</option>
                  <option name="pup_branch" >Two</option>
                  <option name="pup_branch" >Three</option>
                </select>


                 <span class="text-danger"> <?= display_error($validation, 'pup_branch'); ?></span>

              </div>
            </div>

            <div class="col-12">
              <label for="course">Course</label>
              <div class="input-group mb-3">
                <select class="custom-select" id="course" name="course">
                  <option selected>Choose...</option>
                  <option name="course">One</option>
                  <option name="course">Two</option>
                  <option name="course">Three</option>

                </select>

                 <span class="text-danger"> <?= display_error($validation, 'course'); ?></span>
              </div>
            </div>

             <div class="col-12">
              <label for="academic_status">Academic Status</label>
              <div class="input-group mb-3">
                <select class="custom-select" id="academic_stat" name="academic_status">
                  <option name="academic_status" selected><?= $userdata->academic_status?></option>
                  <option name="academic_status" >Irregular</option>

                 <span class="text-danger"> <?= display_error($validation, 'academic_status'); ?></span>

                </select>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
               <label for="email">Email address</label>
               <input type="email" class="form-control" name="email" id="email" value="<?= $userdata->email ?>">
                <span class="text-danger"> <?= display_error($validation, 'email'); ?></span>

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-success">Update</button>
            </div>

          </div>
        </form>
    </div>
  </div>
</div>
