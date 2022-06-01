<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Permission</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
        <button type="button" class="btn btn-primary float-right btn-sm" onclick="document.location = '<?=base_url()?>/superadmin/editPermission'" name="button">
          <i class="fa fa-edit"></i>
          Edit Permission
        </button>
        <h3>Permission</h3>

          <?php if(session()->getTempdata('successRole')): ?>
            <div class="alert alert-success">
              <?= session()->getTempdata('successRole'); ?>
            </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('errorRole')): ?>
            <div class="alert alert-danger">
              <?= session()->getTempdata('errorRole'); ?>
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
                   <th>Function Name</th>
                   <th>Permission</th>
                 </tr>
               </thead>
               <tbody>

                <?php if($task): ?>
                  <?php foreach ($task as $t): ?>
                    <?php if($t['mda'] == NULL && $t['tda'] == NULL && $t['id'] != 0): ?>

                    <tr>
                         <td><?php echo $t['id']; ?></td>
                         <td><?php echo $t['task_name']; ?></td>
                          <td>
                          <?php if($permission): ?>
                            <?php foreach($permission as $p): ?>
                              <?php if($p['tid'] == $t['id']): ?>
                                <?php if($p['deleted_at'] == NULL ): ?>
                                 <i class="fa fa-check-square"></i><?php echo $p['role_name']; ?>
                               <?php endif; ?>
                              <?php endif; ?>
                             <?php endforeach; ?>
                            <?php endif; ?>
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

<script>
function deactivate_data(id)
{
    if(confirm("Are you sure you want to deactivate this role?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactRole/"+id;
    }
    return false;
}


function activate_data(id)
{

    if(confirm("Are you sure you want to activate this role?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actRole/"+id;
    }
    return false;
}

</script>
