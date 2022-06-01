<?php $page_session = \Config\Services::session()?>
<div class="container">

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

  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/profile/trash">Trash</a></li>
          <li class="breadcrumb-item active" aria-current="page">Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <?php if($research): ?>
      <?php foreach($research as $r): ?>
    <div class="col-3">
      <?php if($r['research_status'] == 3):?>
          <form method="post" action="<?=base_url()?>/research/pdfResearch/<?= $r['did'] ?>">
               <button type="submit" name="button" class="btn btn-outline-success">Download Voucher</button>
            </form>

     <?php endif; ?>
    </div>
  </div>


  <div class="row">
      <div class="col-lg-12 form-col">

                <h3><?php echo $r['title']; ?></h3>
                <div class="container research-body">
                  <div class="col-lg-12 research-col">
                    <div class="row">
                      <h2>Abstract</h2>
                      <p class="abstract-text"><?= $r['abstract'];?></p>
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
                      <div class="col-sm-6 left-side">
                        <p>School Year: <?= $r['school_year']?></p>
                        <p>Defense date: <?= $r['defense_date']?></p>
                        <p>Date Submitted: <?= $r['date_submitted']?></p>
                      </div>
                      <div class="col-sm-6 right-side">
                        <h2>Authors:</h2>
                          <div class="listFlex">
                             <div>
                                <ul>
                                <?php if($authors): ?>
                                    <?php foreach($authors as $a): ?>
                                      <li class="ml-3"><?= ucwords($a['first_name']. " ".  $a['last_name']); ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                   <li>None</li>
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
                        <?php if($r['first_name']): ?>
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
                        <?php if($r['privacy'] == 1): ?>
                          <form method="post" action="<?=base_url()?>/src/watermark-edit-existing-pdf.php">
                            <!-- <form method="post" action="<?=base_url()?>/research/downloadResearch/<?= $r['did'] ?>"> -->
                            <input type="hidden" name="file" value="<?= $r['file'] ?>">
                            <?php if($r['file'] != ''): ?>
                              <button type="submit" name="dl" class="btn btn-success std-researchV mb-3">
                                <i class="fa fa-download std-researchV-icon"></i>
                                View here
                              </button>
                            <?php else: ?>
                              <p>No available soft copy.</p>
                            <?php endif; ?>
                          </form>
                        <?php else: ?>
                          <button type="" name="dl" class="btn btn-success std-researchV mb-3" disabled>
                            <i class="fa fa-download std-researchV-icon"></i>
                            View here
                          </button>
                        <?php endif; ?>
                      </div>
                      <div class="col-sm-6 right-side">
                        <h5>View Full Paper</h5>
                        <form method="post" action="<?=base_url()?>/src/watermark-edit-existing-pdf.php">
                          <?php if($r['full_paper'] != ''): ?>
                            <input type="hidden" name="full" value="<?= $r['full_paper'] ?>">
                            <button type="submit"  name="dlf" class="btn btn-success std-researchV mb-3">
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
