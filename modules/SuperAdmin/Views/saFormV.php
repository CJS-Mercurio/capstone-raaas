
<?php $validation = \Config\services::validation()?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
 <div class="row">
   <div class="col-12 form-col">
       <h3>Gender</h3>
          <?php if(session()->getTempdata('successGender')): ?>
            <div class="alert alert-success">
              <?= session()->getTempdata('successGender'); ?>
            </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('errorDel')): ?>
            <div class="alert alert-danger">
              <?= session()->getTempdata('errorDel'); ?>
            </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('successDeactGender')): ?>
            <div class="alert alert-success">
              <?= session()->getTempdata('successDeactGender'); ?>
            </div>
           <?php endif; ?>

           <?php if(session()->getTempdata('errorDeactGender')): ?>
            <div class="alert alert-danger">
              <?= session()->getTempdata('errorDeactGender'); ?>
            </div>
           <?php endif; ?>

           <?php if(session()->getTempdata('successActGender')): ?>
            <div class="alert alert-success">
              <?= session()->getTempdata('successActGender'); ?>
            </div>
           <?php endif; ?>

           <?php if(session()->getTempdata('errorActGender')): ?>
            <div class="alert alert-danger">
              <?= session()->getTempdata('errorActGender'); ?>
            </div>
           <?php endif; ?>


           <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addGender" method="post">
               <div class="form-row col-12">
                   <div class="col-lg-9 ml-3" style="max-width: 100%;">
                       <input type="text" class="form-control" id="validationCustom03" name="gender" placeholder="Gender">
                       <?php if($validation->getError('gender')) {?>
                          <div class='text-danger'>
                            <?= $error = $validation->getError('gender'); ?>
                          </div>
                      <?php }?>
                   </div>
                  <div class="col-2 mb-3 btn-add">
                      <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Gender</button>
                  </div>
             </div>
         </form>

    <div class="col-md-12 mt-2">
       <table class="table table-bordered table-striped" id="">
         <thead>
            <tr>
               <th>Id</th>
               <th>Gender</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>


            <?php if($gender): ?>
            <?php foreach($gender as $g): ?>
            <tr>
               <td><?php echo $g['id']; ?></td>
               <td><?php echo $g['gender']; ?></td>
               <td>
                 <?php if($g['deleted_at'] == null): ?>
                  Activated
                 <?php else: ?>
                  Deactivated
                 <?php endif; ?>

               </td>
               <td>
                 <?php if($g['deleted_at'] == null): ?>
                   <?php $id = $g['id']?>
                   <button type="button" onclick="deactivate_gender('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

                 <?php else: ?>
                   <?php $id = $g['id']?>
                   <button type="button" onclick="activate_gender('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>

                 <?php endif; ?>

                </td>
              </tr>

               <?php endforeach; ?>
             <?php endif; ?>

         </tbody>
       </table>


     </div>
    </div>
<!-- year level -->

<div class="col-12 form-col">
   <div class="header">
     <h3 class="year-header mb-3">Year Level</h3>
   </div>
     <?php if(session()->getTempdata('successYear')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successYear'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('errorDel')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDel'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('successDeactYear')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successDeactYear'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorDeactYear')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeactYear'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successActYear')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successActYear'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorActYear')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorActYear'); ?>
       </div>
      <?php endif; ?>


      <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addYear" method="post">
          <div class="form-row col-12">
              <div class="col-lg-9 ml-3" style="max-width: 100%;">
                  <input type="text" class="form-control" id="validationCustom03" name="year" placeholder="Year">
                  <?php if($validation->getError('year')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('year'); ?>
                     </div>
                 <?php }?>
              </div>
             <div class="col-2 btn-add">
                 <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Year</button>
             </div>
        </div>
    </form>

<div class="col-md-12 mt-2">
  <table class="table table-bordered table-striped" id="">
    <thead>
       <tr>
          <th>Id</th>
          <th>Year</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>


       <?php if($year): ?>
       <?php foreach($year as $y): ?>
       <tr>
          <td><?php echo $y['id']; ?></td>
          <td><?php echo $y['academic_year']; ?></td>
          <td>
            <?php if($y['deleted_at'] == null): ?>
             Activated
            <?php else: ?>
             Deactivated
            <?php endif; ?>

          </td>
          <td>
            <?php if($y['deleted_at'] == null): ?>
              <?php $id = $y['id']?>
              <button type="button" onclick="deactivate_year('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

            <?php else: ?>
              <?php $id = $y['id']?>
              <button type="button" onclick="activate_year('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>

            <?php endif; ?>

           </td>
         </tr>

          <?php endforeach; ?>
        <?php endif; ?>

    </tbody>
  </table>


      </div>
    </div>

<!-- academic_status -->
   <div class="col-12 form-col">
     <div class="header">
       <h3 class="academic-header mb-3">Academic Status</h3>
     </div>
     <?php if(session()->getTempdata('successAcadStat')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successAcadStat'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('errorAcadStat')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorAcadStat'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('errorDel')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDel'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('successDeactAcadStat')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successDeactAcadStat'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorDeactAcadStat')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeactAcadStat'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successActAcadStat')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successActAcadStat'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorActAcadStat')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorActAcadStat'); ?>
       </div>
      <?php endif; ?>


      <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addAcadStatus" method="post">
          <div class="form-row col-12">
              <div class="col-lg-9 ml-3" style="max-width: 100%;">
                  <input type="text" class="form-control" id="validationCustom03" name="acad_status" placeholder="Academic Status">
                  <?php if($validation->getError('acad_status')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('acad_status'); ?>
                     </div>
                 <?php }?>
              </div>
             <div class="col-2 btn-add">
                 <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Academic Status</button>
             </div>
        </div>
    </form>

<div class="col-md-12 mt-3">
  <table class="table table-bordered table-striped" id="">
    <thead>
       <tr>
          <th>Id</th>
          <th>Academic Status</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>


       <?php if($acad_status): ?>
       <?php foreach($acad_status as $as): ?>
       <tr>
          <td><?php echo $as['id']; ?></td>
          <td><?php echo $as['academic_status']; ?></td>
          <td>
            <?php if($as['deleted_at'] == null): ?>
             Activated
            <?php else: ?>
             Deactivated
            <?php endif; ?>

          </td>
          <td>
            <?php if($as['deleted_at'] == null): ?>
              <?php $id = $as['id']?>
              <button type="button" onclick="deactivate_acad_status('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

            <?php else: ?>
              <?php $id = $as['id']?>
              <button type="button" onclick="activate_acad_status('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>

            <?php endif; ?>

           </td>
         </tr>

          <?php endforeach; ?>
        <?php endif; ?>

    </tbody>
  </table>


      </div>
    </div>

<!-- faculty status -->
<div class="col-12 form-col">
    <h3>Faculty Status</h3>
     <?php if(session()->getTempdata('successStatus')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successStatus'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('errorDel')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDel'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('successDeactStatus')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successDeactStatus'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorDeactStatus')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeactStatus'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successActStatus')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successActStatus'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorActStatus')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorActStatus'); ?>
       </div>
      <?php endif; ?>


      <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addStatus" method="post">
          <div class="form-row col-12">
              <div class="col-lg-9 ml-3" style="max-width: 100%;">
                  <input type="text" class="form-control" id="validationCustom03" name="status" placeholder="Faculty Status">
                  <?php if($validation->getError('status')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('status'); ?>
                     </div>
                 <?php }?>
              </div>
             <div class="col-2 btn-add">
                 <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Faculty Status</button>
             </div>
        </div>
    </form>

<div class="col-md-12 mt-4">
  <table class="table table-bordered table-striped" id="">
    <thead>
       <tr>
          <th>Id</th>
          <th>Status Name</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>


       <?php if($status): ?>
       <?php foreach($status as $s): ?>
       <tr>
          <td><?php echo $s['id']; ?></td>
          <td><?php echo $s['faculty_status']; ?></td>
          <td>
            <?php if($s['deleted_at'] == null): ?>
             Activated
            <?php else: ?>
             Deactivated
            <?php endif; ?>

          </td>
          <td>
            <?php if($s['deleted_at'] == null): ?>
              <?php $id = $s['id']?>
              <button type="button" onclick="deactivate_status('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

            <?php else: ?>
              <?php $id = $s['id']?>
              <button type="button" onclick="activate_status('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>

            <?php endif; ?>

           </td>
         </tr>

          <?php endforeach; ?>
        <?php endif; ?>

    </tbody>
  </table>


      </div>
    </div>
<!-- paper type -->
   <div class="col-lg-12 form-col">
     <div class="header">
       <h3 class="faculty-header mb-3">Document Type</h3>
     </div>
     <?php if(session()->getTempdata('successPaper')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successPaper'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('errorPaper')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorPaper'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('successDeactPaper')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successDeactPaper'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorDeactPaper')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeactPaper'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successActPaper')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successActPaper'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorActPaper')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorActPaper'); ?>
       </div>
      <?php endif; ?>


      <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addPaperType" method="post">
          <div class="form-row col-12">
              <div class="col-lg-9 ml-3 mr-2" style="max-width: 100%;">
                  <input type="text" class="form-control" id="validationCustom03" name="paper_type" placeholder="Paper Type">
                  <?php if($validation->getError('paper_type')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('paper_type'); ?>
                     </div>
                 <?php }?>
              </div>
             <div class="col-2 btn-add">
                 <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Paper Type</button>
             </div>
        </div>
    </form>

<div class="col-md-12 mt-4">
  <table class="table table-bordered table-striped" id="documentType-list">
    <thead>
       <tr>
          <th>Id</th>
          <th>Paper Type</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>


       <?php if($type): ?>
       <?php foreach($type as $pt): ?>
       <tr>
          <td><?php echo $pt['id']; ?></td>
          <td><?php echo $pt['type']; ?></td>
          <td>
            <?php if($pt['deleted_at'] == null): ?>
             Activated
            <?php else: ?>
             Deactivated
            <?php endif; ?>

          </td>
          <td>
            <?php if($pt['deleted_at'] == null): ?>
              <?php $id = $pt['id']?>
              <button type="button" onclick="deactivate_paper_type('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

            <?php else: ?>
              <?php $id = $pt['id']?>
              <button type="button" onclick="activate_paper_type('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>
            <?php endif; ?>

           </td>
         </tr>

          <?php endforeach; ?>
        <?php endif; ?>

    </tbody>
  </table>

<!--  -->

<!--  -->

      </div>
    </div>


<!-- setting -->
   <div class="col-12 form-col">
       <h3>Setting</h3>
     <?php if(session()->getTempdata('successSetting')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successSetting'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('errorSetting')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorSetting'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('successDeactSetting')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successDeactSetting'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorDeactSetting')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeactSetting'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successActSetting')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successActSetting'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorActSetting')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorActSetting'); ?>
       </div>
      <?php endif; ?>



           <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addSetting" method="post">
               <div class="form-row col-12">
                   <div class="col-lg-9 ml-3" style="max-width: 100%;">
                       <input type="text" class="form-control" id="validationCustom03" name="setting" placeholder="Setting">
                       <?php if($validation->getError('setting')) {?>
                          <div class='text-danger'>
                            <?= $error = $validation->getError('setting'); ?>
                          </div>
                      <?php }?>
                   </div>
                  <div class="col-2 mb-3 btn-add">
                      <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Setting</button>
                  </div>
             </div>
         </form>

    <div class="col-md-12 mt-4">
       <table class="table table-bordered table-striped" id="">
         <thead>
            <tr>
               <th>Id</th>
               <th>Setting</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>


            <?php if($setting): ?>
            <?php foreach($setting as $s): ?>
            <tr>
               <td><?php echo $s['id']; ?></td>
               <td><?php echo $s['name']; ?></td>
               <td>
                 <?php if($s['deleted_at'] == null): ?>
                  Activated
                 <?php else: ?>
                  Deactivated
                 <?php endif; ?>

               </td>
               <td>
                 <?php if($s['deleted_at'] == null): ?>
                   <?php $id = $s['id']?>
                   <button type="button" onclick="deactivate_setting('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

                 <?php else: ?>
                   <?php $id = $s['id']?>
                   <button type="button" onclick="activate_setting('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>

                 <?php endif; ?>

                </td>
              </tr>

               <?php endforeach; ?>
             <?php endif; ?>

         </tbody>
       </table>


     </div>
    </div>


<!-- disapprove forum -->

<div class="col-12 form-col">
   <div class="header">
     <h3 class="year-header mb-3">Reason for Disapproval of Forum</h3>
   </div>


        <?php if(session()->getTempdata('successForumRea')): ?>
          <div class="alert alert-success">
            <?= session()->getTempdata('successForumRea'); ?>
          </div>
        <?php endif; ?>

        <?php if(session()->getTempdata('errorForumRea')): ?>
          <div class="alert alert-danger">
            <?= session()->getTempdata('errorForumRea'); ?>
          </div>
        <?php endif; ?>

        <?php if(session()->getTempdata('successDeactForumReason')): ?>
          <div class="alert alert-success">
            <?= session()->getTempdata('successDeactForumReason'); ?>
          </div>
         <?php endif; ?>

         <?php if(session()->getTempdata('errorDeactForumReason')): ?>
          <div class="alert alert-danger">
            <?= session()->getTempdata('errorDeactForumReason'); ?>
          </div>
         <?php endif; ?>

         <?php if(session()->getTempdata('successActForumReason')): ?>
          <div class="alert alert-success">
            <?= session()->getTempdata('successActForumReason'); ?>
          </div>
         <?php endif; ?>

         <?php if(session()->getTempdata('errorActForumReason')): ?>
          <div class="alert alert-danger">
            <?= session()->getTempdata('errorActForumReason'); ?>
          </div>
         <?php endif; ?>



      <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addForumReason" method="post">
          <div class="form-row col-12">
              <div class="col-lg-9 ml-3" style="max-width: 100%;">
                  <input type="text" class="form-control" id="validationCustom03" name="forum_reason" placeholder="Reason">
                  <?php if($validation->getError('forum_reason')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('forum_reason'); ?>
                     </div>
                 <?php }?>
              </div>
             <div class="col-2 btn-add">
                 <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Reason</button>
             </div>
        </div>
    </form>

<div class="col-md-12 mt-4">
  <table class="table table-bordered table-striped" id="">
    <thead>
       <tr>
          <th>Id</th>
          <th>Year</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>


       <?php if($forum_reason): ?>
       <?php foreach($forum_reason as $r): ?>
       <tr>
          <td><?php echo $r['id']; ?></td>
          <td><?php echo $r['reason']; ?></td>
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
              <button type="button" onclick="deactivate_forum_reason('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

            <?php else: ?>
              <?php $id = $r['id']?>
              <button type="button" onclick="activate_forum_reason('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>

            <?php endif; ?>

           </td>
         </tr>

          <?php endforeach; ?>
        <?php endif; ?>

    </tbody>
  </table>


      </div>
    </div>
<!-- Reason for Disapproval of adviser -->
   <div class="col-12 form-col">
       <h3>Research Category</h3>
     <?php if(session()->getTempdata('successCateg')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successCateg'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('errorCateg')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorCateg'); ?>
       </div>
     <?php endif; ?>


     <?php if(session()->getTempdata('successDeactCateg')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successDeactCateg'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorDeactCateg')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeactCateg'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successActCateg')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successActCateg'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorActCateg')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorActCateg'); ?>
       </div>
      <?php endif; ?>


      <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addCategory" method="post">
          <div class="form-row col-12">
              <div class="col-lg-9 ml-3" style="max-width: 100%;">
                  <input type="text" class="form-control" id="validationCustom03" name="category" placeholder="Category">
                  <?php if($validation->getError('category')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('category'); ?>
                     </div>
                 <?php }?>
              </div>
             <div class="col-2 btn-add">
                 <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Category</button>
             </div>
        </div>
    </form>

<div class="col-md-12 mt-4">
  <table class="table table-bordered table-striped" id="course-list">
    <thead>
       <tr>
          <th>Id</th>
          <th>Category</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>


       <?php if($category): ?>
       <?php foreach($category as $c): ?>
       <tr>
          <td><?php echo $c['id']; ?></td>
          <td><?php echo $c['category']; ?></td>
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
              <button type="button" onclick="deactivate_category('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

            <?php else: ?>
              <?php $id = $c['id']?>
              <button type="button" onclick="activate_category('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>

            <?php endif; ?>

           </td>
         </tr>

          <?php endforeach; ?>
        <?php endif; ?>

    </tbody>
  </table>


      </div>
    </div>

<!-- Reason for Disapproval of Research (Admin) -->
<div class="col-12 form-col">
    <h3>Reason for Disapproval of Research (Admin)</h3>
     <?php if(session()->getTempdata('successAdminReason')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successAdminReason'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('errorDel')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDel'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('successDeactAdminReason')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successDeactAdminReason'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorDeactAdminReason')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeactAdminReason'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successActAdminReason')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successActAdminReason'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorActAdminReason')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorActAdminReason'); ?>
       </div>
      <?php endif; ?>


      <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addAdminReason" method="post">
          <div class="form-row col-12">
              <div class="col-lg-9 ml-3" style="max-width: 100%;">
                  <input type="text" class="form-control" id="validationCustom03" name="admin_reason" placeholder="Reason">
                  <?php if($validation->getError('admin_reason')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('admin_reason'); ?>
                     </div>
                 <?php }?>
              </div>
             <div class="col-2 btn-add">
                 <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Reason</button>
             </div>
        </div>
    </form>

<div class="col-md-12 mt-4">
  <table class="table table-bordered table-striped" id="reason-list">
    <thead>
       <tr>
          <th>Id</th>
          <th>Reason</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>


       <?php if($admin_reason): ?>
       <?php foreach($admin_reason as $s): ?>
       <tr>
          <td><?php echo $s['id']; ?></td>
          <td><?php echo $s['reason']; ?></td>
          <td>
            <?php if($s['deleted_at'] == null): ?>
             Activated
            <?php else: ?>
             Deactivated
            <?php endif; ?>

          </td>
          <td>
            <?php if($s['deleted_at'] == null): ?>
              <?php $id = $s['id']?>
              <button type="button" onclick="deactivate_admin_reason('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

            <?php else: ?>
              <?php $id = $s['id']?>
              <button type="button" onclick="activate_admin_reason('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>

            <?php endif; ?>

           </td>
         </tr>

          <?php endforeach; ?>
        <?php endif; ?>

    </tbody>
  </table>


      </div>
    </div>

<!-- event type -->
   <div class="col-lg-12 form-col">
     <div class="header">
       <h3 class="faculty-header mb-3">Event Type for Forum</h3>
     </div>
     <?php if(session()->getTempdata('successEventType')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successEventType'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('errorEventType')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorEventType'); ?>
       </div>
     <?php endif; ?>

     <?php if(session()->getTempdata('successDeactEventType')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successDeactEventType'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorDeactEventType')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeactEventType'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successActEventType')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successActEventType'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorActEventType')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorActEventType'); ?>
       </div>
      <?php endif; ?>


      <form class="form-row align-items-center" action="<?=base_url()?>/superadmin/addEventType" method="post">
          <div class="form-row col-12">
              <div class="col-lg-9 ml-3 mr-2" style="max-width: 100%;">
                  <input type="text" class="form-control" id="validationCustom03" name="event_type" placeholder="Event Type">
                  <?php if($validation->getError('event_type')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('event_type'); ?>
                     </div>
                 <?php }?>
              </div>
             <div class="col-2 btn-add">
                 <button class="btn btn-success sa-btn-add" type="submit"><i class="fas fa-plus"></i>  Add Event Type</button>
             </div>
        </div>
    </form>

<div class="col-12 mt-4">
  <table class="table table-bordered table-striped" id="">
    <thead>
       <tr>
          <th>Id</th>
          <th>Event Type</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>


       <?php if($event_type): ?>
       <?php foreach($event_type as $pt): ?>
       <tr>
          <td><?php echo $pt['id']; ?></td>
          <td><?php echo $pt['type']; ?></td>
          <td>
            <?php if($pt['deleted_at'] == null): ?>
             Activated
            <?php else: ?>
             Deactivated
            <?php endif; ?>

          </td>
          <td>
            <?php if($pt['deleted_at'] == null): ?>
              <?php $id = $pt['id']?>
              <button type="button" onclick="deactivate_event_type('<?= $id ?>')" class="btn btn-danger btn-sm">Deactivate</button>

            <?php else: ?>
              <?php $id = $pt['id']?>
              <button type="button" onclick="activate_event_type('<?= $id ?>')" class="btn btn-success btn-sm">Activate</button>
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
function deactivate_gender(id)
{
    if(confirm("Are you sure you want to deactivate this gender?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactGender/"+id;
    }
    return false;
}
function activate_gender(id)
{

    if(confirm("Are you sure you want to activate this gender?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actGender/"+id;
    }
    return false;
}

function deactivate_year(id)
{
    if(confirm("Are you sure you want to deactivate this year?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactYear/"+id;
    }
    return false;
}
function activate_year(id)
{

    if(confirm("Are you sure you want to activate this year?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actYear/"+id;
    }
    return false;
}


function deactivate_acad_status(id)
{
    if(confirm("Are you sure you want to deactivate this Academic Status?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactAcadStatus/"+id;
    }
    return false;
}
function activate_acad_status(id)
{

    if(confirm("Are you sure you want to activate this Academic Status?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actAcadStatus/"+id;
    }
    return false;
}

function deactivate_status(id)
{
    if(confirm("Are you sure you want to deactivate this Status?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactStatus/"+id;
    }
    return false;
}
function activate_status(id)
{

    if(confirm("Are you sure you want to activate this Status?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actStatus/"+id;
    }
    return false;
}

function deactivate_paper_type(id)
{
    if(confirm("Are you sure you want to deactivate this Paper Type?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactPaperType/"+id;
    }
    return false;
}
function activate_paper_type(id)
{

    if(confirm("Are you sure you want to activate this Paper Type?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actPaperType/"+id;
    }
    return false;
}


function deactivate_setting(id)
{
    if(confirm("Are you sure you want to deactivate this forum setting?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactSetting/"+id;
    }
    return false;
}
function activate_setting(id)
{

    if(confirm("Are you sure you want to activate this forum setting?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actSetting/"+id;
    }
    return false;
}

function deactivate_forum_reason(id)
{
    if(confirm("Are you sure you want to deactivate this forum reason?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactForumReason/"+id;
    }
    return false;
}
function activate_forum_reason(id)
{

    if(confirm("Are you sure you want to activate this forum reason?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actForumReason/"+id;
    }
    return false;
}

function deactivate_category(id)
{
    if(confirm("Are you sure you want to deactivate this category?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactCategory/"+id;
    }
    return false;
}
function activate_category(id)
{

    if(confirm("Are you sure you want to activate this category?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actCategory/"+id;
    }
    return false;
}


function deactivate_admin_reason(id)
{
    if(confirm("Are you sure you want to deactivate this reason?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactAdminReason/"+id;
    }
    return false;
}
function activate_admin_reason(id)
{

    if(confirm("Are you sure you want to activate this reason?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actAdminReason/"+id;
    }
    return false;
}

function deactivate_event_type(id)
{
    if(confirm("Are you sure you want to deactivate this Event Type?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactEventType/"+id;
    }
    return false;
}
function activate_event_type(id)
{

    if(confirm("Are you sure you want to activate this Event Type?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actEventType/"+id;
    }
    return false;
}

</script>
