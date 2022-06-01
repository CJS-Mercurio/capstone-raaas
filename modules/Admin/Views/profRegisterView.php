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
<div class="container-fluid">
  <div class="row">
      <div class="col-lg-12 superadmin-form">
      		<div class="row">
      			<div class="col-md-4 mt-4">


      				<?php if($professor): ?>
                  <?php if(session()->getTempdata('activation_expired') == 'no'): ?>


      					<h4>Faculty Code:</h4><br>
      					<h4>Name:</h4><br>
                <h4>Status:</h4><br>
              </div>
              <div class="col-md-3 mt-4">
                <b><p><?= $professor['f_code']; ?></p></b><br>
                <b><p><?= ucwords($professor['f_firstname']. ", ". $professor['f_middlename']. " " . $professor['f_lastname']); ?></p></b>
                <p><?= $professor['f_status']; ?></p>
              </div>
              <div class="col-md-5">
                <h4>ID:</h4>
                <img src="<?=base_url()?>/public/pictures/<?= $professor['school_id'];?>" height="400" width="400">
                <form method="post" action="<?=base_url()?>/admin/profActivate/<?= $professor['id'] ?>">
                    <button type="submit" class="btn btn-success mb-3 ml-5 mt-2">Activate Account</button>

                         <button type="button" class="btn btn-danger mb-3 mt-2" data-toggle="modal" data-target="#exampleModalCenter">
                             Disapprove Account
                         </button>
                 </form><br>
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
                       <form method="post" action="<?=base_url()?>/admin/delProfExpAcc/<?= $professor['id'] ?>">
                                  <button type="submit" class="btn btn-danger">Delete Account</button>
                                  </form><br>

                      </div>
                    </div>

                   <?php endif; ?>
                <?php endif; ?>


      </div>

         <!-- modal for disapproval -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Reason:</h5>
                </div>
                <div class="modal-body">
                  <form method="post" action="<?=base_url()?>/admin/profDeactivate/<?= $professor['id'] ?>">

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
