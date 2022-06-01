<?php $page_session = \Config\Services::session()?>
<?php $validation = \Config\services::validation()?>

<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Accounts</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <?php if($page_session->getTempdata('successAct')):?>
       <div class="alert alert-success"><?= $page_session->getTempdata('successAct');?></div>
      <?php endif; ?>
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="col-12">
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?=esc($_SESSION['success_message'])?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
            <?php endif; ?>
            <a href="professors/add" class="btn btn-success float-right btn-sm">
              <i class="fa fa-plus"></i>
              Add
            </a>
                <h3>Professors</h3>
                <div class="row">
                  <p>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                      <span class="fa fa-edit"></span> Insert spreadsheet
                    </button>
                  </p>
                    <div class="card collapse mt-3" id="collapseExample">
                      <div class="card-body">
                        <p><b>Please upload excel file here</b></p>
                        <form class="form1" action="<?=base_url()?>/profile/professors/insert-spreadsheet" method="post" enctype="multipart/form-data">
                          <div class="col-12">
                            <input type="file" name="professors" class="form-control1" required>
                            <button type="submit" class="btn btn-primary float-right">
                              <i class="fa fa-upload"></i>
                               Upload
                            </button>
                          </div>
                          <!-- <div class="col-sm-3">
                          </div> -->
                        </form>
                      </div>
                  </div>
                </div>
                  <table class="table table-bordered mt-3 dataTable" id="professor-list">
                    <thead>
                      <tr>
                        <th class="hidden">#</th>
                        <th class="hidden">Faculty Code</th>
                        <th>Name</th>
                        <th class="hidden">Birthdate</th>
                        <th>Position</th>
                        <th>Status</th>
                        <!-- <th>Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($professors)): ?>
                        <?php foreach ($professors as $professor): ?>
                          <tr data-toggle="collapse" data-target="#collapse" class="accordion-toggle">
                            <td class="hidden"><?=esc($professor['id'])?></td>
                            <td class="hidden"><?=ucwords(esc($professor['facultycode']))?></td>
                            <td><?=ucwords(esc($professor['firstname']) . ' '. $professor['middlename'] . ' '. $professor['lastname'])?></td>
                            <td class="hidden"><?=esc($professor['birthdate'])?></td>
                            <td><?=esc($professor['position'])?></td>
                            <td><?=esc($professor['status'])?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                  </table>
      </div>
    <div class="col-lg-12 form-col">
      <?php if($page_session->getTempdata('successActStudent')):?>
       <div class="alert alert-success"><?= $page_session->getTempdata('successActStudent');?></div>
      <?php endif; ?>
      <a href="students/add" class="btn btn-success float-right btn-sm">
        <i class="fa fa-plus"></i>
        Add
      </a>
      <h3>Students</h3>
      <div class="row">
          <p>
            <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <span class="fa fa-edit"></span> Insert spreadsheet
            </button>
          </p>
          <div class="accordion mt-3" id="accordionExample">
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card">
              <div class="card-body">
                <form action="<?=base_url()?>/profile/students/insert-spreadsheet" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="course_id" class="form-label">Academic Status*</label>
                          <select class="form-control" name="academic_status">
                            <?php if (isset($academic_status)): ?>
                              <?php foreach ($academic_status as $academicstatus): ?>
                                <?php if($academicstatus['deleted_at'] ==  NULL): ?>
                                 <option value="<?=esc($academicstatus['id'])?>"><?=esc($academicstatus['academic_status'])?></option>
                               <?php endif; ?>
                              <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled selected>-- No Available Course --</option>
                            <?php endif; ?>
                          </select>
                          <?php if($validation->getError('academicstatus')) {?>
                               <div class='text-danger'>
                                 <?= $error = $validation->getError('academicstatus'); ?>
                               </div>
                           <?php }?>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="course_id" class="form-label">Course*</label>
                          <select class="form-control" name="course_id">
                            <?php if (isset($courses)): ?>
                              <?php foreach ($courses as $course): ?>
                                <?php if($course['deleted_at'] == NULL): ?>
                                  <option value="<?=esc($course['id'])?>"><?=esc($course['course_name'])?></option>
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
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <input type="file" name="students" class="form-control1" required>
                      <button type="submit" class="btn btn-primary float-right">
                        <i class="fa fa-upload"></i>
                        Upload
                      </button>
                    </div>
                  </div>
                </form>
            </div>
            </div>
          </div>
        </div>


      </div>
        <table class="table table-bordered mt-3 dataTable" id="student-list">
          <thead>
            <tr>
              <th class="hidden">#</th>
              <th>Student Number</th>
              <th>Name</th>
              <th>Course</th>
              <th class="hidden">Birthdate</th>
              <th class="hidden">Contact</th>
              <!-- <th>Action</th> -->
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($students)): ?>
              <?php foreach ($students as $student): ?>
                <tr>
                  <td class="hidden"><?=esc($student['id'])?></td>
                  <td><?=ucwords(esc($student['student_number']))?></td>
                  <td><?=ucwords(esc($student['firstname']) . ' '. $student['middlename'] . ' '. $student['lastname'])?></td>
                  <td><?=esc($student['course_name'])?></td>
                  <td class="hidden"><?=esc($student['birthdate'])?></td>
                  <td class="hidden"><?=esc($student['contact'])?></td>
                  <!-- <td class="text-center">
                    #
                  </td> -->
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
    </div>
  </div>
</div>
