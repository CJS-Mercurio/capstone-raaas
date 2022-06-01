<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin/permission">Permission</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid form">
    <div class="row">
      <div class="col-lg-12 form-col">
          <h3>Edit Permission</h3>

          <?php if(session()->getTempdata('successPermission')): ?>
            <div class="alert alert-success">
              <?= session()->getTempdata('successPermission'); ?>
            </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('noCheck')): ?>
            <div class="alert alert-danger">
              <?= session()->getTempdata('noCheck'); ?>
            </div>
          <?php endif; ?>

           <?php if(session()->getTempdata('successDeact')): ?>
            <div class="alert alert-success">
              <?= session()->getTempdata('successDeact'); ?>
            </div>
           <?php endif; ?>

           <?php if(session()->getTempdata('errorDeact')): ?>
            <div class="alert alert-danger">
              <?= session()->getTempdata('errorDeact'); ?>
            </div>
           <?php endif; ?>

           <?php if(session()->getTempdata('successAct')): ?>
            <div class="alert alert-success">
              <?= session()->getTempdata('successAct'); ?>
            </div>
           <?php endif; ?>

           <?php if(session()->getTempdata('errorAct')): ?>
            <div class="alert alert-danger">
              <?= session()->getTempdata('errorAct'); ?>
            </div>
           <?php endif; ?>

           <div class="container-table">
             <table class="table table-bordered table-striped" id="research-list">
               <thead>
                 <tr>
                   <th>Id</th>
                   <th>Module Name</th>
                   <th>Permission</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>

                <?php if($task): ?>
                  <?php foreach ($task as $t): ?>

                    <?php if($t['tda'] == NULL && $t['mda'] == NULL && $t['id'] != 0): ?>

                    <tr>
                      <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/editPermission" method="post">

                         <td><?php echo $t['id']; ?></td>
                         <td><?php echo $t['task_name']; ?></td>
                         <td>
                            <input type="hidden" name="task_id" value="<?php echo $t['id']; ?>">
                            <?php foreach($role as $r): ?>
                              <?php if($r['deleted_at'] == NULL): ?>
                                   <?php $roleCheck = 0; ?>
                                   <?php if($permission): ?>
                                      <?php foreach ($permission as $p): ?>
                                                    <?php if($p['tid'] == $t['id']): ?>
                                                            <?php if($p['rid'] == $r['id']): ?>
                                                              <?php $roleCheck = 1; //checker if role is printed?>
                                                                    <input type="checkbox" id="myCheck[]" name="myCheck[]" value="<?php echo $r['id']; ?>" checked> <?php echo $r['role_name'];?>
                                                              <?php endif; ?>
                                                    <?php endif; ?>


                                      <?php endforeach; ?>

                                      <?php if($roleCheck == 0):?>
                                        <input type="checkbox" id="myCheck[]" name="myCheck[]" value="<?php echo $r['id']; ?>"> <?php echo $r['role_name'];?>
                                      <?php endif; ?>
                              <?php else: ?>
                                    <input type="checkbox" id="myCheck[]" name="myCheck[]" value="<?php echo $r['id'];?>"> <?php echo $r['role_name'];?>
                              <?php endif; ?>
                          <?php endif; ?>
                              <!-- role foreach -->
                       <?php endforeach; ?>
                          </td>

                          <td>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>

                          </td>
                         </form>
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

<script>

  function activate_data()
  {

      if(confirm("Are you sure you want to update this permission?"))
      {
          window.location.href="<?php echo base_url(); ?>/superadmin/editPermission/";
      }
      return false;
  }


</script>
