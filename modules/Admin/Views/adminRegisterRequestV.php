<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Registration</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid form">
    <div class="row">
      <!-- <button type="button" class="btn btn-warning approve-btn mb-4" onclick="document.location = '<?=base_url()?>/admin/unactivated'">Unactivated Accounts</button> -->
      <div class="col-lg-12 form-col">
          <h3>User Registration Request</h3>

           <?php if(session()->getTempdata('success')): ?>
              <div class="alert alert-success">
                <?= session()->getTempdata('success'); ?>
              </div>
           <?php endif; ?>

            <?php if(session()->getTempdata('error')): ?>
              <div class="alert alert-danger">
                <?= session()->getTempdata('error'); ?>
              </div>
           <?php endif; ?>


           <?php if(session()->getTempdata('success_prof_delete')): ?>
              <div class="alert alert-success">
                <?= session()->getTempdata('success_prof_delete'); ?>
              </div>
           <?php endif; ?>

            <?php if(session()->getTempdata('error_prof_delete')): ?>
              <div class="alert alert-danger">
                <?= session()->getTempdata('error_prof_delete'); ?>
              </div>
           <?php endif; ?>

           <?php if(session()->getTempdata('success_user_delete')): ?>
              <div class="alert alert-success">
                <?= session()->getTempdata('success_user_delete'); ?>
              </div>
           <?php endif; ?>

            <?php if(session()->getTempdata('error_user_delete')): ?>
              <div class="alert alert-danger">
                <?= session()->getTempdata('error_user_delete'); ?>
              </div>
           <?php endif; ?>

           <div class="mt-3">
             <table class="table table-bordered table-striped" id="student-list">
              <h1>Students</h1>
               <thead>
                 <tr>
                   <th>Student Number</th>
                   <th>First Name</th>
                   <th>Middle Name</th>
                   <th>Last Name</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>


              <?php if($student): ?>
		              <?php foreach($student as $s): ?>
              			<?php if($s['status'] != 1  && $s['status'] != 2): ?>
			              <tr>
			                 <td><?php echo $s['student_number']; ?></td>
			                 <td><?php echo $s['first_name']; ?></td>
			                 <td><?php echo $s['middle_name']; ?></td>
			                 <td><?php echo $s['last_name']; ?></td>
			                 <td>
                         <form method="post" action="<?=base_url()?>/admin/studRegistration/<?= $s['id'] ?>">
                          <button type="submit" class="btn btn-info">View</button>
                        </form>
                       </td>
			               </tr>
                     <?php endif; ?>
                    <?php endforeach; ?>
               		<?php endif; ?>
           </tbody>
         </table>
      </div>

       <div class="mt-3">
             <table class="table table-bordered table-striped" id="professor-list">
              <h1>Professors</h1>
               <thead>
                 <tr>
                   <th>Faculty Code</th>
                   <th>First Name</th>
                   <th>Middle Name</th>
                   <th>Last Name</th>

                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>


              <?php if($professor): ?>
                  <?php foreach($professor as $p): ?>
                    <?php if($p['status'] != 1 && $p['status'] != 2): ?>
                    <tr>
                       <td><?php echo $p['f_code']; ?></td>
                       <td><?php echo $p['f_firstname']; ?></td>
                       <td><?php echo $p['f_middlename']; ?></td>
                       <td><?php echo $p['f_lastname']; ?></td>

                       <td>
                         <form method="post" action="<?=base_url()?>/admin/profRegistration/<?= $p['id'] ?>">
                          <button type="submit" class="btn btn-info">View</button>
                        </form>
                       </td>
                     </tr>
                     <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
           </tbody>
         </table>
      </div>

          <div class="mt-3">
                <table class="table table-bordered table-striped" id="other-list">
                 <h1>Other Roles</h1>
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>First Name</th>
                      <th>Middle Name</th>
                      <th>Last Name</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>


                 <?php if($other_role): ?>
                     <?php foreach($other_role as $or): ?>
                       <?php if($or['status'] != 1 && $or['status'] != 2 && $or['rid'] != 1): ?>
                       <tr>
                          <td><?php echo $or['id']; ?></td>
                          <td><?php echo $or['first_name']; ?></td>
                          <td><?php echo $or['middle_name']; ?></td>
                          <td><?php echo $or['last_name']; ?></td>
                          <td><?php echo ucwords($or['role_name']); ?></td>

                          <td>
                            <form method="post" action="<?=base_url()?>/admin/userRegistration/<?= $or['id'] ?>">
                             <button type="submit" class="btn btn-info">View</button>
                           </form>
                          </td>
                        </tr>
                        <?php endif; ?>
                       <?php endforeach; ?>
                     <?php endif; ?>
              </tbody>
            </table>
         </div>

    </div>
	</div>
</div>
