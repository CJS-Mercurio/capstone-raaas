<?php $page_session = \Config\Services::session()?>
<?php $validation = \Config\services::validation()?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin/module">List of Modules</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Module</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
        <h3><?php echo $module->module_name; ?></h3>
        <?php if($page_session->getTempdata('successFunction')):?>
           <div class="alert alert-success"><?= $page_session->getTempdata('successFunction');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('errorFunction')):?>
           <div class="alert alert-danger"><?= $page_session->getTempdata('errorFunction');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('deleted')):?>
           <div class="alert alert-success"><?= $page_session->getTempdata('deleted');?></div>
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

        <form action="<?=base_url()?>/superadmin/addFunc/<?=$module->id?>" method="post" class="form-row align-items-center" >

               <div class="form-row col-12 ml-2">
                   <div class="col-10 mb-3" style="max-width: 100%;">
                       <input type="text" class="form-control" id="validationCustom03" name="func_name" placeholder="Function name">
                       <?php if($validation->getError('func_name')) {?>
                          <div class='text-danger'>
                            <?= $error = $validation->getError('func_name'); ?>
                          </div>
                      <?php }?>
                   </div>

                  <div class="col-2 mb-3 btn-add">
                      <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i> Add</button>
                  </div>
          </div>
      </form>

        <div class="col-12 mt-2">
                <table class="table table-bordered table-striped" id="seminar-list">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Function Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($function): ?>
                       <?php foreach ($function as $f): ?>
                          <tr>
                            <td><?php echo $f['id']; ?></td>
                            <td><?php echo $f['task_name']; ?></td>
                            <td>

                               <?php if($f['deleted_at'] == null): ?>
                                Activated
                               <?php else: ?>
                                Deactivated
                               <?php endif; ?>
                            </td>
                            <td>

                              <?php if($f['deleted_at'] == null): ?>
                                <?php $id = $f['id']?>
                                <button type="button" onclick="deactivate_data('<?= $id?>'+ '/' + '<?= $module->id?>')" class="btn btn-danger btn-sm">Deactivate</button>

                             <?php else: ?>
                               <?php $id = $f['id']?>
                               <button type="button" onclick="activate_data('<?= $id?>'+ '/' +'<?= $module->id?>')" class="btn btn-success btn-sm">Activate</button>

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
function deactivate_data(id, module_id)
{
    if(confirm("Are you sure you want to deactivate this function?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactFunction/"+id, module_id;
    }
    return false;
}


function activate_data(id, module_id)
{

    if(confirm("Are you sure you want to activate this function?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actFunction/"+id, module_id;
    }
    return false;
}


</script>
