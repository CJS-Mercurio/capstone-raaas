<?php $page_session = \Config\Services::session()?>
<?php $validation = \Config\services::validation()?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Accounts</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <h3>Add Account</h3>
      <?php if($page_session->getTempdata('success')):?>
        <div class="alert alert-success"><?= $page_session->getTempdata('success');?></div>
      <?php endif; ?>

      <?php if($page_session->getTempdata('error')):?>
        <div class="alert alert-danger"><?= $page_session->getTempdata('error');?></div>
      <?php endif; ?>

      <div class="alert alert-warning" role="alert">
        <b>Warning: </b>Fields with asterisk (*) are required.
      </div>

      <form class="register-form" action="<?= base_url() ?>/superadmin/addFacultyUser/<?=$role['role_id'];?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="form-group">
             <label for="first_name">First Name <span style="color: red; ">*</span></label>
             <input type="text" class="form-control" name="first_name" id="first_name" value="<?= set_value('first_name') ?>">
             <?php if($validation->getError('first_name')) {?>
                       <div class='text-danger'>
                         <?= $error = $validation->getError('first_name'); ?>
                       </div>
                   <?php }?>
            </div>
          </div>

          <div class="col-12 col-sm-6">
            <div class="form-group">
             <label for="middle_name">Middle Name (optional)</label>
             <input type="text" class="form-control" name="middle_name" id="middle_name" value="<?= set_value('middle_name') ?>">
           
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
             <label for="last_name">Last Name <span style="color: red; ">*</span></label>
             <input type="text" class="form-control" name="last_name" id="last_name" value="<?= set_value('last_name') ?>">
             <?php if($validation->getError('last_name')) {?>
                 <div class='text-danger'>
                   <?= $error = $validation->getError('last_name'); ?>
                 </div>
             <?php }?>
            </div>
          </div>

          <div class="col-12 col-sm-6">
           <div class="form-group">
            <label for="birthdate">Birthday <span style="color: red; ">*</span></label>
            <!-- <button type="button" class="form-control" id="button" data-date-format="yyyy-mm-dd" data-date="2012-02-20" value="<?= set_value('birthdate') ?>">Your Date Picker</button> -->
            <input type="date" class="form-control" max="<?php echo date('Y-m-d'); ?>" name="birthdate" id="birthdate" value="<?= set_value('birthdate') ?>">
            <?php if($validation->getError('birthdate')) {?>
                  <div class='text-danger'>
                    <?= $error = $validation->getError('birthdate'); ?>
                  </div>
              <?php }?>
           </div>
         </div>

         <div class="col-12 col-sm-6">
            <label for="gender">Gender <span style="color: red; ">*</span></label>
            <div class="input-group">
              <?php if($gender): ?>
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
            <?php if($validation->getError('gender')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('gender'); ?>
                    </div>
                <?php }?>
          </div>

          <hr class="separate">

          <div class="col-12">
            <div class="form-group">
             <label for="email">Faculty Code: <span style="color: red; ">*</span></label>
             <div class="input-group">
               <input type="text" class="form-control" name="faculty_code" id="faculty_code" placeholder="eg. FA00015TG2009">
             </div>
             <?php if($validation->getError('faculty_code')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('faculty_code'); ?>
                     </div>
                 <?php }?>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
             <label for="email">Email address <span style="color: red; ">*</span></label>
             <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
             <?php if($validation->getError('email')) {?>
                  <div class='text-danger'>
                    <?= $error = $validation->getError('email'); ?>
                  </div>
              <?php }?>
            </div>
          </div>

          <div class="col-12 col-sm-6">
            <div class="form-group">
             <label for="password">Password <span style="color: red; ">*</span></label>
             <input type="password" class="form-control" name="password" id="password" value="">
             <?php if($validation->getError('password')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('password'); ?>
                   </div>
               <?php }?>
           </div>
         </div>

         <div class="col-12 col-sm-6">
           <div class="form-group">
            <label for="password_confirm">Confirm Password <span style="color: red; ">*</span></label>
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
            <?php if($validation->getError('password_confirm')) {?>
                   <div class='text-danger'>
                     <?= $error = $validation->getError('password_confirm'); ?>
                   </div>
               <?php }?>
          </div>
        </div>
          </div>

          <div class="row">
            <div class="col-12 col-sm-4" style="float: right; ">
              <button type="submit" class="btn btn-success">Add Account</button>
            </div>
        </div>
    </form>

    </div>
	</div>
</div>
