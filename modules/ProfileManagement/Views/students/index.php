<?php $validation = \Config\services::validation()?>

<div class="card mt-5 me-3">
  <div class="card-body">
    <div class="container-fluid p-1">
      <?php if (isset($_SESSION['success_message'])): ?>
        <div class="row mb-3">
          <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?=esc($_SESSION['success_message'])?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row mb-3">
        <div class="col-2">
          <span class="h2">Students</span>
        </div>
        <div class="col-2">
          <a href="students/add" class="float-end btn btn-success"> Add </a>
        </div>
      </div>
      <div class="card mb-5 mt-5">
      <div class="card-body">
        <h5 class="card-title">Upload via Excel</h5>
        <form action="students/insert-spreadsheet" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-4">
              <div class="form-group mb-3">
                <label for="course_id" class="form-label">*Academic Status</label>
                  <select class="form-control" name="academic_status">
                    <?php if (isset($academic_status)): ?>
                      <?php foreach ($academic_status as $academicstatus): ?>
                        <option value="<?=esc($academicstatus['id'])?>"><?=esc($academicstatus['academic_status'])?></option>
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
            <div class="col-8">
              <div class="form-group mb-3">
                <label for="course_id" class="form-label">Course*</label>
                  <select class="form-control" name="course_id">
                    <?php if (isset($courses)): ?>
                      <?php foreach ($courses as $course): ?>
                        <option value="<?=esc($course['id'])?>"><?=esc($course['course_name'])?></option>
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
            <div class="col-5">
              <input type="file" name="students" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary float-end">Upload</button>
            </div>
          </div>
        </form>
      </div>
    </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Student Number</th>
                  <th>Name</th>
                  <th>Course</th>
                  <th>Birthdate</th>
                  <th>Contact</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($students)): ?>
                  <?php foreach ($students as $student): ?>
                    <tr>
                      <td><?=esc($student['id'])?></td>
                      <td><?=ucwords(esc($student['student_number']))?></td>
                      <td><?=ucwords(esc($student['firstname']) . ' '. $student['middlename'] . ' '. $student['lastname'])?></td>
                      <td><?=esc($student['course_name'])?></td>
                      <td><?=esc($student['birthdate'])?></td>
                      <td><?=esc($student['contact'])?></td>
                      <td class="text-center">
                        #
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
