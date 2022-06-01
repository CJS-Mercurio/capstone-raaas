
<?php $validation = \Config\services::validation()?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">List of Roles</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <h3>List of Roles</h3>

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



         <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addRole" method="post">
               <div class="form-row col-12">
                   <div class="col-10 mb-3" style="max-width: 100%;">
                       <input type="text" class="form-control" id="validationCustom03" name="role_name" placeholder="Role Name">
                       <?php if($validation->getError('role_name')) {?>
                          <div class='text-danger'>
                            <?= $error = $validation->getError('role_name'); ?>
                          </div>
                      <?php }?>
                   </div>
                  <div class="col-2 mb-3 btn-add">
                      <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i>  Add Role</button>
                  </div>
             </div>
         </form>


           <div class="container-table">
             <table class="table table-bordered table-striped" id="research-list">
               <thead>
                 <tr>
                   <th>Id</th>
                   <th>Role Name</th>
                   <th>Status</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>

                <?php if($role): ?>
                  <?php foreach ($role as $r): ?>
                    <tr>
                         <td><?php echo $r['id']; ?></td>
                         <td><?php echo $r['role_name']; ?></td>
                         <td>
                           <?php if($r['deleted_at'] == null): ?>
                            Activated
                           <?php else: ?>
                            Deactivated
                           <?php endif; ?>
                         </td>
                         <td>
                              <?php if($r['deleted_at'] == null): ?>
                              <?php $id = $r['id']?>
                               <button type="button" onclick="deactivate_data('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

                             <?php else: ?>
                               <?php $id = $r['id']?>
                               <button type="button" onclick="activate_data('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>

                             <?php endif; ?>
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
