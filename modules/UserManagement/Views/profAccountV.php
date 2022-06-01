<div class="container-fluid form">
  <div class="row">
      <div class="col-lg-12 form-col">

      		<div class="row">
      			<div class="col-8">


      				<?php if($professor): ?>
                  <?php if(session()->getTempdata('activation_expired') == 'no'): ?>


      					<h4>Faculty Code</h4><br>
      					   <p><?= $professor['f_code']; ?></p><br>
      					<h4>Name:</h4><br>
      					   <p><?= ucwords($professor['f_firstname']. ", ". $professor['f_middlename']. " " . $professor['f_lastname']); ?></p><br>
      					<h4>Status</h4><br>
                    <p><?= $professor['f_status']; ?></p><br>
      					<h4>ID:</h4>
                    <img src="<?=base_url()?>/public/pictures/<?= $professor['school_id'];?>" height="400" width="400">



            				<div class="col-4">
      	      				<div class="card text-center">
      							   <form method="post" action="<?=base_url()?>/userManagement/profActivate/<?= $professor['id'] ?>">
      		                      <button type="submit" class="btn btn-success">Activate Account</button>
      		                        </form><br>

      		                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
      		                          Disapprove Account
      		                      </button>
          						</div>
          					</div>

                   <?php endif; ?>
                <?php endif; ?>



              <?php if($professor): ?>
                  <?php if(session()->getTempdata('activation_expired') == 'yes'): ?>
                  <?php if(session()->getTempdata('expired_message')): ?>
                        <div class="alert alert-danger">
                          <?= session()->getTempdata('expired_message'); ?>
                        </div>
                  <?php endif; ?>


                  <h4>Faculty Code</h4><br>
                     <p><?= $professor['f_code']; ?></p><br>
                  <h4>Name:</h4><br>
                     <p><?= ucwords($professor['f_firstname']. ", ". $professor['f_middlename']. " " . $professor['f_lastname']); ?></p><br>
                  <h4>Position</h4><br>
                      <p><?= $professor['position']; ?></p><br>
                  <h4>ID:</h4>
                  <img src="<?=base_url()?>/public/pictures/<?= $professor['school_id'];?>" height="400" width="400">
                    <div class="col-4">

                      <div class="card text-center">
                       <form method="post" action="<?=base_url()?>/userManagement/delProfExpAcc/<?= $professor['id'] ?>">
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
                  <form method="post" action="<?=base_url()?>/userManagement/profDeactivate/<?= $professor['id'] ?>">

                       <select class="custom-select" id="reason" name="reason">
                                  <option selected value="">Choose...</option>
                                   <option name="reason" value="Student number does not match">Faculty ID does not match</option>
                                   <option name="reason" value="Mispelled name input">Mispelled name input</option>
                                   <option name="reason" value="Image ID is not readable">Image ID is not readable</option>

                      </select>

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
