<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin/userRequest">User Request</a></li>
          <li class="breadcrumb-item active" aria-current="page">Unactivated Request</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 superadmin-form mb-3">
        <div class="header">
          <h3 class="admin-header">Unactivated Account Request</h3>

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

        </div>

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
              			<?php if($s['status'] == 2): ?>
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
                    <?php if($p['status'] == 2): ?>
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

    </div>
	</div>
</div>
