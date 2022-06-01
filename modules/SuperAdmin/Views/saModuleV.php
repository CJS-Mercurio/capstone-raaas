
<?php $validation = \Config\services::validation()?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">List of Modules</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
        <h3>List of Modules</h3>

          <?php if(session()->getTempdata('successModule')): ?>
            <div class="alert alert-success">
              <?= session()->getTempdata('successModule'); ?>
            </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('errorModule')): ?>
            <div class="alert alert-danger">
              <?= session()->getTempdata('errorModule'); ?>
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

           <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addModule" method="post">
               <div class="form-row col-12">
                   <div class="col-10 mb-3" style="max-width: 100%;">
                       <input type="text" class="form-control" id="validationCustom03" name="module_name" placeholder="Module name">
                       <?php if($validation->getError('module_name')) {?>
                          <div class='text-danger'>
                            <?= $error = $validation->getError('module_name'); ?>
                          </div>
                      <?php }?>

                   </div>
                  <div class="col-2 btn-add">
                      <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i>  Add Module</button>
                  </div>
             </div>
         </form>

           <div class="container-table">
             <table class="table table-bordered table-striped" id="research-list">
               <thead>
                 <tr>
                   <th>Id</th>
                   <th>Module Name</th>
                   <th>Status</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>

                <?php if($module): ?>
                  <?php foreach ($module as $m): ?>
                    <tr>
                         <td><?php echo $m['id']; ?></td>
                         <td><?php echo $m['module_name']; ?></td>
                         <td>
                           <?php if($m['deleted_at'] == null): ?>
                            Activated
                           <?php else: ?>
                            Deactivated
                           <?php endif; ?>

                         </td>

                         <td>
                              <?php if($m['deleted_at'] == null): ?>
                              <?php $id = $m['id']?>

                                <button type="button" onclick="edit_data('<?= $id ?>')" class="btn btn-info btn-sm">Edit</button>
                                <button type="button" onclick="deactivate_data('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

                             <?php else: ?>
                               <?php $id = $m['id']?>
                               <button type="button" onclick="edit_data('<?= $id ?>')" class="btn btn-info btn-sm disabled">Edit</button>
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
    if(confirm("Are you sure you want to deactivate this module?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactModule/"+id;
    }
    return false;
}


function activate_data(id)
{

    if(confirm("Are you sure you want to activate this module?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actModule/"+id;
    }
    return false;
}


function edit_data(id)
{

   window.location.href="<?php echo base_url(); ?>/superadmin/editModule/"+id;

}


</script>
