<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Configure</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 mb-3 superadmin-form">
          <div class="header">
            <h3 class="admin-header mb-3">Faculty</h3>
          </div>
                <?php if(session()->getTempdata('successFaculty')): ?>
                  <div class="alert alert-success">
                    <?= session()->getTempdata('successFaculty'); ?>
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

                <form class="input" action="<?=base_url()?>/admin/addFaculty" method="post">
	                 <div class="form-row">
	                    <div class="col-3">
	                       <input type="text" class="form-control" name="f_firstname" placeholder="Firstname">
       		                <span class="text-danger"> <?= display_error($validation, 'f_firstname'); ?></span>
	                       </div>
	                    <div class="col-3">
	                       <input type="text" class="form-control" name="f_lastname" placeholder="Lastname">
       	                 <span class="text-danger"> <?= display_error($validation, 'f_lastname'); ?></span>
	                    </div>
	                    <div class="col-3">
	                       <input type="text" class="form-control" name="f_code" placeholder="Faculty Code">
       	                 <span class="text-danger"> <?= display_error($validation, 'f_code'); ?></span>
	                    </div>
	                    <div class="col-3 btn-add">
	                       <button class="btn btn-success"><i class="fas fa-plus"></i>  Add Faculty</button>
	                    </div>
	                </form>

              <div class="col-12 mt-3">
                <table class="table table-bordered table-striped" id="faculty-list">
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($faculty): ?>
                      <?php foreach($faculty as $f): ?>
                        <tr>
                          <td><?php echo $f['f_code']; ?></td>
                          <td><?php echo ucwords($f['f_firstname']. " ". $f['f_lastname']); ?></td>
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
                                <button type="button" onclick="deactivate_data('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

                              <?php else: ?>
                                <?php $id = $f['id']?>
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


       <!-- Modal for delete faculty -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" action="<?=base_url()?>/admin/deleteFaculty/<?=$faculty['id']?>">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Are you sure you want to delete this faculty?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
               </div>
              </div>
            </div>
           </form>
          </div>
        </div>



    </div>
  </div>
</div>
<script type="text/javascript">
function deactivate_data(id)
{
    if(confirm("Are you sure you want to deactivate this faculty?"))
    {
        window.location.href="<?php echo base_url(); ?>/admin/deactFaculty/"+id, module_id;
    }
    return false;
}


function activate_data(id)
{

    if(confirm("Are you sure you want to activate this faculty?"))
    {
        window.location.href="<?php echo base_url(); ?>/admin/actFaculty/"+id, module_id;
    }
    return false;
}

</script>
