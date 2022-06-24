<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/research">My Documents</a></li>
          <li class="breadcrumb-item active" aria-current="page">Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <div class="col-12 alert-container">
  <?php if($research): ?>
    <?php foreach($research as $r): ?>
      <?php if($page_session->getTempdata('success')):?>
        <div class="alert alert-success"><?= $page_session->getTempdata('success');?></div>
      <?php endif; ?>
      <?php if(session()->getTempdata('submit')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('submit'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorSubmit')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorSubmit'); ?>
       </div>
      <?php endif; ?>

      <?php if($page_session->getTempdata('mali')):?>
        <div class="alert alert-danger"><?= $page_session->getTempdata('mali');?></div>
      <?php endif; ?>

      <?php if($page_session->getTempdata('tama')):?>
        <div class="alert alert-success"><?= $page_session->getTempdata('tama');?></div>
      <?php endif; ?>
    </div>
    <div class="forum-col">
      <div class="row">
        <div class="col-lg-12">

                <?php if($r['research_status'] == 0 || $r['research_status'] == 1 || $r['research_status'] == 2|| $r['research_status'] == 4):?>

                  <?php $id = $r['did']?>
                  <!-- <button type="button" onclick="delete_data('<?= $id ?>')" class="btn btn-danger float-right mr-1">
                  </button> -->
                  <p>
                    <a onclick="delete_data('<?= $id ?>')" class="float-right text-danger link" type="submit">
                      <i class="fa fa-trash"></i>
                      Delete
                    </a>
                    <a href="<?=base_url()?>/research/editResearch/<?= $r['did'] ?>" type="submit" class="text-warning float-right mr-3 link">
                      <i class="fas fa-pencil-alt"></i>
                      Edit Research
                    </a>
                  </p>

                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          <?php if($research): ?>
            <?php foreach($research as $r): ?>
          <?php if($r['research_status'] == 3):?>
            <p>
              <b>Current Status: </b><span class="badge badge-success">Approved</span>
              <a href="<?=base_url()?>/research/pdfResearch/<?= $r['did'] ?>" type="submit" name="button" class="text-success float-right link" target="_blank"><i class="fa fa-download"></i> Download Voucher</a>
            </p>
          <?php elseif($r['research_status'] == 0 || $r['research_status'] == 1): ?>
            <p>
              <b>Current Status: </b><span class="badge badge-warning mr-5">Waiting for Approval</span>
            </p>
          <?php elseif($r['research_status'] == 2): ?>
            <p>
                <b>Current Status: </b><span class="badge badge-danger">Disapproved</span>
                <b>Reason for disapproval: </b><span class="badge badge-danger mr-5"><?= $r['reason_for_denial']?></span>
                <?php $id = $r['did']; ?>
                <a type="button" onclick="submit_data_admin('<?= $id?>')" class="text-primary ml-5 mr-3 float-right"><i class="fas fa-redo-alt"></i> Submit Again</a>
            </p>
            <?php else: ?>
              <h5>An error occured</h5>
            <?php endif; ?>

        </div>
        </div>
      </div>
    </div>


  <div class="row">
      <div class="col-lg-12 form-col">

                <h3><?php echo $r['title']; ?></h3>
                <!-- Working here Copyright-->
                <?php if($r['privacy'] == 1): ?>
                                          <?php if($r['file'] != ''): ?>
                                            <p class="alert alert-info" style="width: 225px;"><b>This research is Copyrighted.</b></p>
                                          <?php endif; ?>
                                      <?php endif; ?>
                   <!-- Working here Copyright-->
                <div class="container research-body">
                  <div class="col-lg-12 research-col">
                    <div class="row">
                      <h2>Abstract</h2>
                      <p class="abstract-text" style="text-align: justify;"><?= $r['abstract'];?></p>
                      <br>
                      <?php if($r['category_id']): ?>
                        <p><b>Subject - Topical Term:
                        <i class="keywords-text"><?= ucwords($r['category_id']);?></i>
                        </b></p>
                      <?php endif; ?>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-6 left-side">
                        <h2>Keywords:</h2>
                        <i class="keywords-text"><?= ucwords($r['keywords']);?></i>
                      </div>
                      <div class="col-sm-6 right-side">
                        <?php if($r['course_name']): ?>
                            <h2>Course: </h2>
                            <p><?php echo ucwords($r['course_name']); ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-6 left-side year-date">
                          <h6>
                            <b>
                              School Year:
                            </b>
                             <?= $r['school_year']?>
                          </h6>
                          <h6>
                            <b>
                              Defense date:
                            </b>
                             <?= $r['defense_date']?>
                          </h6>
                          <h6>
                            <b>
                              Date Submitted:
                            </b>
                             <?= $r['date_submitted']?>
                          </h6>
                      </div>
                      <div class="col-sm-6 right-side">
                        <h2>Authors:</h2>
                          <div class="listFlex">
                             <div>
                                <ul>
                                <?php if($author): ?>
                                    <?php foreach($author as $a): ?>
                                      <li class="ml-3"><?= ucwords($a['first_name']. " ".  $a['last_name']); ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                   <li class="ml-3">None</li>
                                <?php endif; ?>
                                </ul>
                             </div>
                          </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-6 left-side">
                        <h2>Research Adviser: </h2>
                        <?php if(isset($r['first_name'])): ?>
                          <p><?= ucwords($r['first_name']. " ". $r['last_name']); ?></p>
                        <?php endif; ?>
                      </div>
                      <div class="col-sm-6 right-side">
                        <h2>Panelist: </h2>
                        <?php if($panels): ?>
                         <div class="listFlex">
                            <div>
                               <ul>
                                    <?php foreach($panels as $p): ?>
                                        <li class="ml-3"><?= ucwords($p['first_name']. " ".  $p['last_name']); ?></li>
                                      <?php endforeach; ?>
                               </ul>
                            </div>
                         </div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-6 left-side">
                        <h5>View Research File</h5>
                        <form method="post" action="<?=base_url()?>/src/watermark-edit-existing-pdf.php">
                                <!-- <form method="post" action="<?=base_url()?>/research/downloadResearch/<?= $r['did'] ?>"> -->
                                <input type="hidden" name="file" value="<?= $r['file'] ?>">
                                <?php if($r['file'] != ''): ?>
                                  <button type="submit" name="dl" class="btn btn-success std-researchV mb-3" target="_blank">
                                    <i class="fa fa-download std-researchV-icon"></i>
                                    View here
                                  </button>
                                <?php else: ?>
                                  <p>No available soft copy.</p>
                                <?php endif; ?>
                          </form>
                      </div>
                      <div class="col-sm-6 right-side">
                        <h5>View Full Paper</h5>
                        <form method="post" action="<?=base_url()?>/src/watermark-edit-existing-pdf.php">
                          <?php if($r['full_paper'] != ''): ?>
                            <input type="hidden" name="full" value="<?= $r['full_paper'] ?>">
                            <button type="submit"  name="dlf" class="btn btn-success std-researchV mb-3" target="_blank">
                              <i class="fa fa-download std-researchV-icon"></i>
                              View here
                            </button>
                          <?php else: ?>
                            <p>No available soft copy.</p>
                          <?php endif; ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
        <?php  endforeach; ?>
     <?php endif; ?>

    </div>
  </div>
</div>
    </div>
  </div>
</div>
<script>
function submit_data_admin(id)
{
    if(confirm("Are you sure you want to submit this document?"))
    {
        window.location.href="<?php echo base_url(); ?>/research/adminSubmit/"+id;
    }
    return false;
}

function submit_data_adv(id)
{
    if(confirm("Are you sure you want to submit this document?"))
    {
        window.location.href="<?php echo base_url(); ?>/research/advSubmit/"+id;
    }
    return false;
}

function delete_data(id)
{
    if(confirm("Are you sure you want to delete this document?"))
    {
        window.location.href="<?php echo base_url(); ?>/research/deleteResearch/"+id;
    }
    return false;
}
</script>
