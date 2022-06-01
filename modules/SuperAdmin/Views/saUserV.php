<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Accounts</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
        <button type="button" class="btn btn-success float-right btn-sm mb-3" data-toggle="modal" data-target="#exampleModalCenter">
          <i class="fa fa-plus"></i>
          Add User
        </button>
        <h3>Accounts</h3>



        <h2>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Choose user role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?= base_url() ?>/superadmin/addUser" method="post" enctype="">
              <div class="modal-body">
                <div class="form-group mb-3">
                  <select class="custom-select" id="role" name="role">
                    <option selected value="">Choose...</option>
                    <?php foreach ($role as $r): ?>
                      <?php if($r['deleted_at'] == NULL): ?>
                        <option name="role" value="<?=$r['id']; ?>" <?= set_select('role', $r['role_name']) ?>><?= ucwords($r['role_name']); ?></option>
                      <?php endif; ?>
                    <?php endforeach ?>
                  </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- <a href="<?= base_url() ?>/superadmin/addUser" class="btn btn-success float-right">
          <i class="fa fa-plus"></i>
          Add
        </a> -->
      </h2>

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
                   <th>Name</th>
                   <th>Role</th>
                   <th>Status</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>

                <?php if($admins): ?>
                  <?php foreach ($admins as $a): ?>
                    <tr>
                         <td><a href="<?= base_url() ?>/superadmin/viewUser/<?=$a['uid']?>"><?php echo ucwords($a['last_name']. ", " .$a['first_name']. " ". $a['middle_name']); ?></a></td>
                         <td><?php echo ucwords($a['role_name']); ?></td>
                         <td>
                           <?php if($a['status'] == 0): ?>
                            Waiting for activation
                          <?php elseif($a['status'] == 1): ?>
                            Activated
                           <?php else: ?>
                            Deactivated
                           <?php endif; ?>
                         </td>
                         <td>
                              <?php if($a['status'] == 1): ?>
                              <?php $id = $a['uid']?>
                               <button type="button" onclick="deactivate_data('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>
                             <?php else: ?>
                               <?php $id = $a['uid']?>
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
    if(confirm("Are you sure you want to deactivate this user?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactUser/"+id;
    }
    return false;
}


function activate_data(id)
{

    if(confirm("Are you sure you want to activate this user?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actUser/"+id;
    }
    return false;
}

</script>
