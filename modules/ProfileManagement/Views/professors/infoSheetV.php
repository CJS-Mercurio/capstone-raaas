<?php $page_session = \Config\Services::session()?>
<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/profile/view">Seminars and Completed Researches List</a></li>
          <li class="breadcrumb-item active" aria-current="page">My Seminars/Researches</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">

      <div class="col-md-12">
        <div class="right-content">
          <div class="tabbable-responsive">
            <div class="tabbable">
              <ul class="nav nav-tabs" role="tablist" id="myTab">
                <li class="nav-item">
                  <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">Seminars, Trainings and Conference</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Completed Researches</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                <h3>Seminars, Trainings and Conference Attended</h3>
                <?php if($page_session->getTempdata('successSeminar')):?>
                   <div class="alert alert-success"><?= $page_session->getTempdata('successSeminar');?></div>
                <?php endif; ?>

                <?php if($page_session->getTempdata('errorSeminar')):?>
                   <div class="alert alert-danger"><?= $page_session->getTempdata('errorSeminar');?></div>
                <?php endif; ?>

                <?php if($page_session->getTempdata('successDelete')):?>
                   <div class="alert alert-success"><?= $page_session->getTempdata('successDelete');?></div>
                <?php endif; ?>

                <?php if($page_session->getTempdata('errorDelete')):?>
                   <div class="alert alert-danger"><?= $page_session->getTempdata('errorDelete');?></div>
                <?php endif; ?>


                <?php if($page_session->getTempdata('deleted')):?>
                   <div class="alert alert-success"><?= $page_session->getTempdata('deleted');?></div>
                <?php endif; ?>
              <center>

                <form action="<?=base_url()?>/profile/professors/addSeminar" method="post" class="form-row align-items-center seminar-form mt-4" >

                       <div class="form-row col-12">
                           <div class="col-3 mb-3 seminar-form-col">
                               <input type="text" class="form-control" id="validationCustom03" name="title" placeholder="Event Title" value="<?= set_value('title') ?>" required>
                               <?php if($validation->getError('title')) {?>
                                    <div class='text-danger'>
                                      <?= $error = $validation->getError('title'); ?>
                                    </div>
                                <?php }?>
                           </div>

                           <div class="col-2 mb-3 seminar-form-col">
                               <input type="text" class="form-control" id="validationCustom04" name="sponsor" placeholder="Sponsor Agency" value="<?= set_value('sponsor') ?>" required>
                               <?php if($validation->getError('sponsor')) {?>
                                    <div class='text-danger'>
                                      <?= $error = $validation->getError('sponsor'); ?>
                                    </div>
                                <?php }?>
                           </div>

                           <div class="col-2 mb-2 seminar-form-col">
                               <input type="text" class="form-control" id="validationCustom04" name="venue" placeholder="Venue" value="<?= set_value('venue') ?>" required>
                               <?php if($validation->getError('venue')) {?>
                                    <div class='text-danger'>
                                      <?= $error = $validation->getError('venue'); ?>
                                    </div>
                                <?php }?>
                           </div>

                           <div class="col-2 mb-3 seminar-form-col">
                               <input type="date" class="form-control" id="validationCustom04" name="date" placeholder="Date" value="<?= set_value('date') ?>" required>
                               <?php if($validation->getError('date')) {?>
                                    <div class='text-danger'>
                                      <?= $error = $validation->getError('date'); ?>
                                    </div>
                                <?php }?>
                           </div>
                          <div class="col-2 mb-3 btn-add">
                              <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-plus"></i> Add</button>
                          </div>
                  </div>
              </form>
            </center>
              <hr>
                <div class="container-table">
                  <div class="row">
                    <div class="col-12">
                      <table class="table table-bordered table-striped" id="seminar-list">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Sponsor Agency</th>
                            <th>Venue</th>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php if($p_seminar): ?>
                            <?php $num = 0; ?>
                            <?php foreach($p_seminar as $ps): ?>
                              <tr>
                                <?php if($ps['deleted_at'] == NULL): ?>
                                  <td><?php $num++; echo $num; ?></td>
                                  <td><?php echo $ps['event_title']; ?></td>
                                  <td><?php echo $ps['sponsor']; ?></td>
                                  <td><?php echo $ps['venue']; ?></td>
                                  <td><?php echo $ps['date_attended']; ?></td>
                                  <td>
                                    <?php $id = $ps['id']?>
                                    <button type="button" onclick="delete_seminar('<?= $id ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                  </td>
                                <?php endif; ?>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>


                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
            </div>
              <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                <h3>Completed Researches</h3>

                       <?php if($page_session->getTempdata('successResearch')):?>
                           <div class="alert alert-success"><?= $page_session->getTempdata('successResearch');?></div>
                        <?php endif; ?>
                        <?php if($page_session->getTempdata('successDeleteP')):?>
                           <div class="alert alert-success"><?= $page_session->getTempdata('successDeleteP');?></div>
                        <?php endif; ?>
                        <?php if($page_session->getTempdata('errorDeleteP')):?>
                           <div class="alert alert-danger"><?= $page_session->getTempdata('errorDeleteP');?></div>
                        <?php endif; ?>

                        <form class="mb-5" action="<?=base_url()?>/profile/professors/addPublication" method="post">
                         <div class="form-group">
                           <label for="exampleFormControlInput1">Title</label>
                           <input type="text" class="form-control" name="research_title" id="exampleFormControlInput1" placeholder="" value="<?= set_value('research_title') ?>" required>
                           <?php if($validation->getError('research_title')) {?>
                                <div class='text-danger'>
                                  <?= $error = $validation->getError('research_title'); ?>
                                </div>
                            <?php }?>
                         </div>
                         <div class="form-group">
                           <label for="exampleFormControlTextarea1">Abstract</label>
                           <textarea name="abstract" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= set_value('abstract') ?></textarea required>
                           <?php if($validation->getError('abstract')) {?>
                                <div class='text-danger'>
                                  <?= $error = $validation->getError('abstract'); ?>
                                </div>
                            <?php }?>

                         </div>
                         <div class="form-group">
                           <label for="exampleFormControlInput1">Year Completed</label>
                           <input name= "school_year" type="text" class="form-control" id="exampleFormControlInput1" placeholder="yyyy-yyyy" value="<?= set_value('school_year') ?>" required>
                           <?php if($validation->getError('school_year')) {?>
                                <div class='text-danger'>
                                  <?= $error = $validation->getError('school_year'); ?>
                                </div>
                            <?php }?>
                           <?php if($page_session->getTempdata('errorSY')):?>
                               <div class="text-danger"><?= $page_session->getTempdata('errorSY');?></div>
                            <?php endif; ?>

                         </div>
                         <div class="form-group mb-5">
                           <button class="btn btn-success float-right btn-sm" type="submit"><i class="fas fa-plus"></i> Add</button>
                         </div>

                       </form>
                       <div class="container">

                         <div class="row">

                         </div>
                       </div>
                       <hr>
                       <div class="container-table">
                         <div class="col-12">
                              <table class="table table-bordered table-striped" id="pResearch-list">
                                <thead>
                                  <tr>
                                    <th class="hidden">No.</th>
                                    <th>Title</th>
                                    <th>Abstract</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php if($p_research): ?>
                                    <?php $num = 0; ?>

                                    <?php foreach($p_research as $pr): ?>
                                      <tr>
                                        <?php if($pr['deleted_at'] == NULL): ?>
                                          <td class="hidden"><?php $num++; echo $num; ?></td>
                                          <td><?php echo $pr['research_title']; ?></td>
                                          <td><?php echo mb_strimwidth($pr['abstract'], 0, 150, "...") ?></td>
                                          <td>
                                            <?php $id = $pr['id']?>
                                            <form class="pResearch-list-btn" action="<?=base_url()?>/profile/professors/editPresearch/<?=$pr['id'] ?>" method="get">
                                              <button type="submit" class="btn btn-sm btn-warning" name="button"><i class="fas fa-edit"></i> Edit</button>
                                              <button type="button" onclick="delete_data('<?= $id ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                            </form>

                                          </td>

                                        <?php endif; ?>

                                      </tr>
                                    <?php endforeach; ?>
                                  <?php endif; ?>


                                </tbody>
                              </table>
                            </div>
                          </div>

              </div>
            </div>
          </div>

        </div>
      </div>

        </div>
    </div>
  </div>
</div>

<script>
function delete_data(id)
{
    if(confirm("Are you sure you want to remove it?"))
    {
        window.location.href="<?php echo base_url(); ?>/profile/professors/delPublication/"+id;
    }
    return false;
}

function delete_seminar(id)
{
    if(confirm("Are you sure you want to remove it?"))
    {
        window.location.href="<?php echo base_url(); ?>/profile/professors/delSeminar/"+id;
    }
    return false;
}
</script>
