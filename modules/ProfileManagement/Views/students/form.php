<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/profile/professors">User Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Student</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <h3>Add Student</h3>

      <form class="" action="add" method="post">
      <div class="row1">
        <div class="col-md-12">
          <div class="alert alert-warning" role="alert">
            <b>Warning: </b>Fields with asterisk (*) are required.
          </div>

            <div class="form-group mb-3">
              <label for="username" class="form-label">Student Number <span style="color: red; ">*</span> </label>
              <input type="text" name="student_number" id="username" class="form-control" placeholder="Student Number" value="<?= set_value('student_number') ?>" />
              <?php if($validation->getError('student_number')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('student_number'); ?>
                   </div>
               <?php }?>
            </div>
            <div class="form-group mb-3">
              <label for="email" class="form-label">Email <span style="color: red; ">*</span></label>
              <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>" />
              <?php if($validation->getError('email')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('email'); ?>
                   </div>
               <?php }?>
            </div>


        </div>
        <div class="col-md-12">
            <div class="maxl">
              <label for="firstname" class="form-label">First Name <span style="color: red; ">*</span></label>
              <input type="text" name="firstname" class="form-control" value="<?= set_value('firstname') ?>">
              <?php if($validation->getError('firstname')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('firstname'); ?>
                   </div>
               <?php }?>

            </div>
            <div class="form-group mb-3">
              <label for="lastname" class="form-label">Last Name <span style="color: red; ">*</span></label>
              <input type="text" class="form-control" name="lastname" value="<?= set_value('lastname') ?>">
              <?php if($validation->getError('lastname')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('lastname'); ?>
                   </div>
               <?php }?>
            </div>

            <div class="form-group mb-3">
              <label for="middlename" class="form-label">Middle Name</label>
              <input type="text" class="form-control" name="middlename" value="<?= set_value('middlename') ?>">
              <?php if($validation->getError('middlename')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('middlename'); ?>
                   </div>
               <?php }?>
            </div>
            <div class="form-group mb-3">
              <label for="contact" class="form-label">Contact <span style="color: red; ">*</span></label>
              <input type="text" class="form-control" name="contact" value="<?= set_value('contact') ?>">
              <?php if($validation->getError('contact')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('contact'); ?>
                   </div>
               <?php }?>
            </div>

            <div class="form-group mb-3">
              <label for="course_id" class="form-label">Course <span style="color: red; ">*</span></label>
                <select class="form-control" name="course_id">
                  <?php if (isset($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                      <?php if($course['deleted_at'] == NULL): ?>
                        <option value="<?=esc($course['id'])?>" <?= set_select('course_id', $course['course_name']); ?> ><?=esc($course['course_name'])?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php else: ?>
                      <option value="" disabled selected>-- No Available Course --</option>
                  <?php endif; ?>
                </select>
                <?php if($validation->getError('course')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('course'); ?>
                     </div>
                 <?php }?>
            </div>
            <div class="form-group mb-3">
              <label for="Academic Status" class="form-label">Academic Status <span style="color: red; ">*</span></label>
                <select class="form-control" name="academic_status">
                  <?php if (isset($academic_status)): ?>
                    <?php foreach ($academic_status as $academicstatus): ?>
                      <?php if($academicstatus['deleted_at'] ==  NULL): ?>
                        <option value="<?=esc($academicstatus['id'])?>" <?= set_select('academic_status', $academicstatus['academic_status']); ?> ><?=esc($academicstatus['academic_status'])?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php else: ?>
                      <option value="" disabled selected>-- No Available Academic Status --</option>
                  <?php endif; ?>
                </select>
                <?php if($validation->getError('academicstatus')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('academicstatus'); ?>
                     </div>
                 <?php }?>
            </div>
            <div class="form-group mb-3">
              <label for="birthdate" class="form-label">Birthdate <span style="color: red; ">*</span></label>
              <input type="date" name="birthdate" class="form-control" max="<?php echo date('Y-m-d'); ?>" value="<?= set_value('birthdate') ?>">
              <?php if($validation->getError('birthdate')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('birthdate'); ?>
                   </div>
               <?php }?>
            </div>
            <button type="submit" name="button" class="btn btn-success float-right">Register</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
