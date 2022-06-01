<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin/userRequest">User Request</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin/unactivated">Unactivated Request</a></li>
          <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
      <div class="col-lg-12 form-col">
      		<div class="row">
      			<div class="col-8">
      				<?php if($student): ?>
                     <?php if(session()->getTempdata('activation_expired') == 'no'): ?>

      					<h4>Student number:</h4><br>
      					   <p><?= $student['student_number']; ?></p><br>
      					<h4>Name:</h4><br>
      					   <p><?= ucwords($student['last_name']. ", ". $student['first_name']. " " . $student['middle_name']); ?></p><br>

                <?php if($course): ?>

                  <h4>Course and Section:</h4><br>
                     <p><?= $course['course_name']. " - ".$student['year']; ?></p><br><br>
      					<?php endif; ?>

      					<h4>ID:</h4>
                    <img src="<?=base_url()?>/public/pictures/<?= $student['school_id'];?>" height="400" width="400">

            				<div class="col">
      							   <form method="post" action="<?=base_url()?>/userManagement/studActivate/<?= $student['id'] ?>">
      		                        <button type="submit" class="btn btn-success mb-3 mt-3">Activate Account</button>
      		                        <button type="button" class="btn btn-danger mb-3 mt-3" data-toggle="modal" data-target="#exampleModalCenter">
      		                          Disapprove Account
      		                        </button>
                       </form>
          					</div>

                 <?php endif; ?>
              <?php endif; ?>

              <?php if($student): ?>
                     <?php if(session()->getTempdata('activation_expired') == 'yes'): ?>
                     <?php if(session()->getTempdata('expired_message')): ?>
                        <div class="alert alert-danger">
                          <?= session()->getTempdata('expired_message'); ?>
                        </div>
                     <?php endif; ?>


                <h4>Student number:</h4><br>
                <p><?= $student['student_number']; ?></p><br>
                <h4>Name:</h4><br>
                <p><?= ucwords($student['last_name']. ", ". $student['first_name']. " " . $student['middle_name']); ?></p><br>

                <?php if($course): ?>

                  <h4>Course and Section:</h4><br>
                     <p><?= $course['course_name']. " - ".$student['year']; ?></p><br><br>
                <?php endif; ?>

                <h4>ID:</h4>
                    <img src="<?=base_url()?>/public/pictures/<?= $student['school_id'];?>" height="400" width="400">
                    <div class="col-4">

                      <div class="card text-center">
                       <form method="post" action="<?=base_url()?>/userManagement/delStudentExpAcc/<?= $student['id'] ?>">
                                  <button type="submit" class="btn btn-danger">Delete Account</button>
                                  </form><br>

                      </div>
                    </div>

                 <?php endif; ?>
              <?php endif; ?>



          	</div>
          </div>

         <!-- modal for disapproval -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Reason:</h5>
                </div>
                <div class="modal-body">
                  <form method="post" action="<?=base_url()?>/userManagement/studDeactivate/<?= $student['id'] ?>">

                       <select class="custom-select" id="reason" name="reason">
                                  <option selected value="">Choose...</option>
                                   <option name="reason" value="Student number does not match">Student number does not match</option>
                                   <option name="reason" value="Mispelled name input">Mispelled name input</option>
                                   <option name="reason" value="Image ID is not readable">Image ID is not readable</option>
                       </select>


                      <!-- <div class="form-check mt-5">
                          <label class="form-check-label " for="defaultCheck1">Other: Please specify</label>
                          <input class="form-control form-control-sm ml-3 w-50" name="reason" type="text" placeholder="" style="display: inline">
                      </div> -->


                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Confirm disapproval</button>
                  </div>
                </div>
               </form>
            </div>
          </div>
          <!-- end modal -->

    </div>
  </div>
</div>
