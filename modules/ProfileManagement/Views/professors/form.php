<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/profile/professors">User Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Professor</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <h3>Add Professor</h3>
      <form class="" action="add" method="post">
        <div class="col-md-12">
          <div class="alert alert-warning" role="alert">
            <b>Warning: </b>Fields with asterisk (*) are required.
          </div>

            <div class="form-group mb-3">
              <label for="username" class="form-label">Faculty Code <span style="color: red; ">*</span></label>
              <input type="text" name="facultycode" id="username" class="form-control" placeholder="Faculty Code" value="<?= set_value('facultycode') ?>" />
              <?php if($validation->getError('facultycode')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('facultycode'); ?>
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
              <label for="position" class="form-label">Position <span style="color: red; ">*</span></label>
              <input type="text" class="form-control" name="position" value="<?= set_value('position') ?>">
              <?php if($validation->getError('position')) {?>
                      <div class='text-danger'>
                        <?= $error = $validation->getError('position'); ?>
                      </div>
                  <?php }?>
            </div>
            <div class="form-group mb-3">
              <label for="Status" class="form-label">Faculty Status <span style="color: red; ">*</span></label>
                <select class="form-control" name="status">
                  <?php if (isset($status)): ?>
                    <?php foreach ($status as $s): ?>
                      <?php if($s['deleted_at'] == NULL): ?>
                      <option value="<?=esc($s['faculty_status'])?>" <?= set_select('status', $s['faculty_status']); ?> ><?=esc($s['faculty_status'])?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
                <?php if($validation->getError('status')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('status'); ?>
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
    </form>
    </div>
  </div>
</div>

<!-- <div class="container" id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          <h3>Add Professor</h3>


        </div>
    </div>
  </div>
</div> -->
