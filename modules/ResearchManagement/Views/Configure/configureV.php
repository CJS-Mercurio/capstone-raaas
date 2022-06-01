
<?php $validation = \Config\services::validation()?>

<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Configure</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

    <div class="container-fluid form">
      <div class="row">
        <div class="col-lg-12 form-col">
          <form class="set-form" action="<?=base_url()?>/research/setSY" method="post">
            <?php if(session()->getTempdata('successSY')): ?>
              <div class="alert alert-success">
                <?= session()->getTempdata('successSY'); ?>
              </div>
           <?php endif; ?>

            <div class="form-group">
                <h3>Set School Year</h3>
                <?php if($ad_config): ?>
                  <?php foreach ($ad_config as $ac): ?>

                       <span class="text-info">Current school year: <b> <?php echo $ac['school_year']; ?> </b> </span>
                  <?php endforeach; ?>
               <?php endif; ?>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="school_year" placeholder="yyyy-yyyy" value="<?= set_value('school_year') ?>">
              <?php if($validation->getError('school_year')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('school_year'); ?>
                    </div>
                <?php }?>
              <?php if(session()->getTempdata('errorSY')): ?>
                  <div class="text-danger">
                    <?= session()->getTempdata('errorSY'); ?>
                  </div>
               <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-success float-right">Set</button>
          </form>
        </div>
        <div class="col-12 mb-3 form-col">
          <form class="set-form" action="<?=base_url()?>/research/setDir" method="post">
            <?php if(session()->getTempdata('successCD')): ?>
              <div class="alert alert-success">
                <?= session()->getTempdata('successCD'); ?>
              </div>
            <?php endif; ?>
            <div class="form-group">
                <h3>Set Current Director</h3>
                <?php if($ad_config): ?>
                  <?php foreach ($ad_config as $ac): ?>

                       <span class="text-info">Current director: <b> <?php echo $ac['current_director']; ?> </b> </span>
                  <?php endforeach; ?>
               <?php endif; ?>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="current_director" placeholder="" value="<?= set_value('current_director') ?>">
              <?php if($validation->getError('current_director')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('current_director'); ?>
                    </div>
                <?php }?>
            </div>
            <button type="submit" class="btn btn-success float-right">Set</button>
          </form>
        </div>
        <div class="col-lg-12 form-col">
          <button type="button" onclick="delete_data()" class="btn btn-info float-right remove-all-btn btn-sm">
            <i class="far fa-minus-square"></i>
            Remove all schedule
          </button>
          <h3>Set uploading schedule</h3>

          <?php if(session()->getTempdata('successSched')): ?>
           <div class="alert alert-success">
             <?= session()->getTempdata('successSched'); ?>
           </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('errorSched')): ?>
           <div class="alert alert-danger">
             <?= session()->getTempdata('errorSched'); ?>
           </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('existingSched')): ?>
           <div class="alert alert-danger">
             <?= session()->getTempdata('existingSched'); ?>
           </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('successRemove')): ?>
           <div class="alert alert-success">
             <?= session()->getTempdata('successRemove'); ?>
           </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('errorRemove')): ?>
           <div class="alert alert-danger">
             <?= session()->getTempdata('errorRemove'); ?>
           </div>
          <?php endif; ?>

          <form class="" action="<?=base_url()?>/research/setSched" method="post">
             <div class="form-row">
                <div class="col-6">
                    <select class="form-control" name="course_id">
                      <?php if ($course): ?>
                        <?php foreach ($course as $c): ?>
                          <option name="course_id" value="<?=esc($c['id'])?>"><?=esc($c['course_name'])?></option>
                        <?php endforeach; ?>
                      <?php else: ?>
                                <option value="" disabled selected>-- No Available Course --</option>
                      <?php endif; ?>
                      <?php if($validation->getError('course_id')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('course_id'); ?>
                    </div>
                <?php }?>

                    </select>
                  </form>
                </div>
                <div class="form-group col-md-2">
                  <input type="date" class="form-control" min=<?php echo date('Y-m-d'); ?> name="schedFrom" value="<?= set_value('forumFrom') ?>" id="schedFrom" placeholder="">
                  <?php if($validation->getError('schedFrom')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('schedFrom'); ?>
                    </div>
                <?php }?>

                </div>
                <div class="form-group col-md-2">
                  <input type="date" class="form-control" min=<?php echo date('Y-m-d'); ?> name="schedTo" value="<?= set_value('forumTo') ?>" id="schedTo" placeholder="">
                  <?php if($validation->getError('schedTo')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('schedTo'); ?>
                    </div>
                <?php }?>

                </div>
                <div class="col-2">
                   <button type="submit" class="btn btn-success"></i>Set</button>
                </div>
              </div>
            </form>
            <br>
              <div class="col-12">
                <table class="table table-bordered table-striped" id="faculty-list">
                  <thead>
                    <tr>
                      <th>Course</th>
                      <th>Schedule</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($course_sched): ?>
                      <?php foreach($course_sched as $c): ?>
                        <tr>
                          <td><?php echo ucwords($c['course_name']); ?></td>
                          <?php $f=strtotime($c['dateFrom']); $t=strtotime($c['dateTo']); ?>

                          <?php $from = date("M-d-Y", $f); $to = date("M-d-Y", $t);?>
                          <td><i> <?php echo $from. " to ". $to; ?></i></td>
                           <td>
                             <div class="form-row">
                                  <div class="form-group col-md-2">
                                    <?php $id = $c['course_id']; ?>
                                    <button type="button" onclick="remove_data('<?= $id ?>')" class="btn btn-danger mb-3"><i class="far fa-minus-square"></i> Remove</button>

                                  </div>
                             </div>

                           </td>

                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
                <br>

            </div>
        </div>
        <div class="col-lg-12 form-col">
          <h3>Faculty</h3>

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

          <form class="input" action="<?=base_url()?>/research/addFaculty" method="post">
            <div class="form-row">
              <div class="col-3">
                <input type="text" class="form-control" name="f_firstname" placeholder="Firstname" value="<?= set_value('f_firstname') ?>">
                <?php if($validation->getError('f_firstname')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('f_firstname'); ?>
                    </div>
                <?php }?>
              </div>
              <div class="col-3">
                <input type="text" class="form-control" name="f_lastname" placeholder="Lastname" value="<?= set_value('f_lastname') ?>">
                <?php if($validation->getError('f_lastname')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('f_lastname'); ?>
                    </div>
                <?php }?>
              </div>
              <div class="col-3">
                <input type="text" class="form-control" name="f_code" placeholder="Faculty Code" value="<?= set_value('f_code') ?>">
                <?php if($validation->getError('f_code')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('f_code'); ?>
                    </div>
                <?php }?>
              </div>
              <div class="col-3 btn-add">
                <button class="btn btn-success"><i class="fas fa-plus"></i>  Add</button>
              </div>
            </form>

            <div class="col-12 mt-3">
              <table class="table table-bordered table-striped" id="faculty-list">
                <thead>
                  <tr>
                    <th class="hidden">Code</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($faculty): ?>
                    <?php foreach($faculty as $f): ?>
                      <tr>
                        <td class="hidden"><?php echo $f['f_code']; ?></td>
                        <td><?php echo ucwords($f['first_name']. " ". $f['last_name']); ?></td>
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



    <!-- <div class="container-fluid form">
      <div class="row">
        <div class="col-lg-12 form-col">
          <h3>Set uploading schedule</h3>

          <?php if(session()->getTempdata('successSched')): ?>
           <div class="alert alert-success">
             <?= session()->getTempdata('successSched'); ?>
           </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('errorSched')): ?>
           <div class="alert alert-danger">
             <?= session()->getTempdata('errorSched'); ?>
           </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('existingSched')): ?>
           <div class="alert alert-danger">
             <?= session()->getTempdata('existingSched'); ?>
           </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('successRemove')): ?>
           <div class="alert alert-success">
             <?= session()->getTempdata('successRemove'); ?>
           </div>
          <?php endif; ?>

          <?php if(session()->getTempdata('errorRemove')): ?>
           <div class="alert alert-danger">
             <?= session()->getTempdata('errorRemove'); ?>
           </div>
          <?php endif; ?>

          <form class="" action="<?=base_url()?>/research/setSched" method="post">
             <div class="form-row">
                <div class="col-6">
                    <select class="form-control" name="course_id">
                      <?php if ($course): ?>
                        <?php foreach ($course as $c): ?>
                          <option name="course_id" value="<?=esc($c['id'])?>"><?=esc($c['course_name'])?></option>
                        <?php endforeach; ?>
                      <?php else: ?>
                                <option value="" disabled selected>-- No Available Course --</option>
                      <?php endif; ?>
                      <?php if($validation->getError('course_id')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('course_id'); ?>
                            </div>
                        <?php }?>

                    </select>
                  </form>
                </div>
                <div class="form-group col-md-2">
                  <input type="date" class="form-control" min=<?php echo date('Y-m-d'); ?> name="schedFrom" value="<?= set_value('forumFrom') ?>" id="schedFrom" placeholder="">
                   <?php if($validation->getError('schedFrom')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('schedFrom'); ?>
                            </div>
                        <?php }?>


                </div>
                <div class="form-group col-md-2">
                  <input type="date" class="form-control" min=<?php echo date('Y-m-d'); ?> name="schedTo" value="<?= set_value('forumTo') ?>" id="schedTo" placeholder="">
                   <?php if($validation->getError('schedTo')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('schedTo'); ?>
                            </div>
                        <?php }?>


                </div>
                <div class="col-2">
                   <button type="submit" class="btn btn-success"></i> Set</button>
                </div>
              </div>
            </form>
            <br>
              <div class="col-12">
                <button type="button" onclick="delete_data()" class="btn btn-warning float-right mb-3">
                  <i class="far fa-minus-square"></i>
                  Remove all schedule
                </button>

                <table class="table table-bordered table-striped" id="faculty-list">
                  <thead>
                    <tr>
                      <th>Course</th>
                      <th>Schedule</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($course_sched): ?>
                      <?php foreach($course_sched as $c): ?>
                        <tr>
                          <td><?php echo ucwords($c['course_name']); ?></td>
                          <?php $f=strtotime($c['dateFrom']); $t=strtotime($c['dateTo']); ?>

                          <?php $from = date("M-d-Y", $f); $to = date("M-d-Y", $t);?>
                          <td><i> <?php echo $from. " to ". $to; ?></i></td>
                           <td>
                             <div class="form-row">
                                  <div class="form-group col-md-2">
                                    <?php $id = $c['course_id']; ?>
                                    <button type="button" onclick="remove_data('<?= $id ?>')" class="btn btn-danger mb-3">Remove</button>

                                  </div>
                             </div>

                           </td>

                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
                <br>

            </div>
        </div>
        <div class="col-lg-12 form-col">
          <h3>Faculty</h3>

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

          <form class="input" action="<?=base_url()?>/research/addFaculty" method="post">
            <div class="form-row">
              <div class="col-3">
                <input type="text" class="form-control" name="f_firstname" placeholder="Firstname">
                 <?php if($validation->getError('f_firstname')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('f_firstname'); ?>
                            </div>
                <?php }?>

              </div>
              <div class="col-3">
                <input type="text" class="form-control" name="f_lastname" placeholder="Lastname">
                 <?php if($validation->getError('f_lastname')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('f_lastname'); ?>
                            </div>
                <?php }?>
              </div>
              <div class="col-3">
                <input type="text" class="form-control" name="f_code" placeholder="Faculty Code">
                 <?php if($validation->getError('f_code')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('f_code'); ?>
                            </div>
                <?php }?>
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
                        <td><?php echo ucwords($f['first_name']. " ". $f['last_name']); ?></td>
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
    </div> -->

    </div>
  </div>
</div>
<script type="text/javascript">
function deactivate_data(id)
{
    if(confirm("Are you sure you want to deactivate this faculty?"))
    {
        window.location.href="<?php echo base_url(); ?>/research/deactFaculty/"+id;
    }
    return false;
}


function activate_data(id)
{

    if(confirm("Are you sure you want to activate this faculty?"))
    {
        window.location.href="<?php echo base_url(); ?>/research/actFaculty/"+id;
    }
    return false;
}

function delete_data()
{

    if(confirm("Are you sure you want to delete all schedule?"))
    {
        window.location.href="<?php echo base_url(); ?>/research/empty";
    }
    return false;
}

function remove_data(id)
{

    if(confirm("Are you sure you want to remove this schedule?"))
    {
        window.location.href="<?php echo base_url(); ?>/research/removeSched/"+id;
    }
    return false;
}

</script>
