
<?php $validation = \Config\services::validation()?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Department</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

     <!-- MODAL FOR COURSE -->
     <div class="container-fluid form">
      <div class="row">
        <div class="col-lg-12 form-col">
            <h3>List of Course</h3>
          <?php if(session()->getTempdata('successCourse')): ?>
            <div class="alert alert-success">
              <?= session()->getTempdata('successCourse'); ?>
            </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('errorDel')): ?>
            <div class="alert alert-danger">
              <?= session()->getTempdata('errorDel'); ?>
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


           <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addDepartment" method="post">
               <div class="form-row col-12">
                   <div class="col-7 course-form-col">
                       <input type="text" class="form-control" id="validationCustom03" name="course_name" placeholder="Course Title">
                       <?php if($validation->getError('course_name')) {?>
                          <div class='text-danger'>
                            <?= $error = $validation->getError('course_name'); ?>
                          </div>
                      <?php }?>
                   </div>
                   <div class="col-2 course-form-col">
                       <input type="text" class="form-control" id="validationCustom04" name="abbreviate" placeholder="Abbreviate">
                       <?php if($validation->getError('abbreviate')) {?>
                          <div class='text-danger'>
                            <?= $error = $validation->getError('abbreviate'); ?>
                          </div>
                      <?php }?>
                   </div>

                  <div class="col-2 btn-add">
                      <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i>  Add Course</button>
                  </div>
             </div>
         </form>

    <div class="containter-table">
       <table class="table table-bordered table-striped" id="course-list">
         <thead>
            <tr>
               <th class="hidden">Id</th>
               <th>Course Name</th>
               <th class="hidden">Abbreviate</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>


            <?php if($course): ?>
            <?php foreach($course as $c): ?>
            <tr>
               <td class="hidden"><?php echo $c['id']; ?></td>
               <td><?php echo $c['course_name']; ?></td>
               <td class="hidden"><?php echo $c['abbreviate']; ?></td>
               <td>
                 <?php if($c['deleted_at'] == null): ?>
                  Activated
                 <?php else: ?>
                  Deactivated
                 <?php endif; ?>

               </td>
               <td>
                 <?php if($c['deleted_at'] == null): ?>
                   <?php $id = $c['id']?>
                   <button type="button" onclick="deactivate_data('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

                 <?php else: ?>
                   <?php $id = $c['id']?>
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
    if(confirm("Are you sure you want to deactivate this department?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactDepartment/"+id;
    }
    return false;
}


function activate_data(id)
{

    if(confirm("Are you sure you want to activate this department?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actDepartment/"+id;
    }
    return false;
}

</script>
