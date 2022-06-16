<?php $page_session = \Config\Services::session()?>
<!-- <div class="container-fluid breadcrumb-container">
  <div class="row breadcrumb-row">
    <div class="col-lg-3">
      <h1 class="breadcrumb-header"><i class="fa fa-folder"></i> Researches</h1>
    </div>
    <div class="col-lg-9 breadcrumbs">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb float-right">
          <p>
            <li class="breadcrumb-item"><a href="../login">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Research View</li>
          </p>
        </ol>
      </nav>
    </div>
  </div>
</div> -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12 about-head">
         <img src="<?=base_url()?>/public/assets/images/logos/logo.png" width="200" height="200">
        <h1> Researches</h1>
        <p><a href="<?= base_url() ?>/login">Home</a> / <span>Research View</span></p>
      </div>
    </div>
  </div>
</div>
<div class="container forum-container mt-5">
  <div class="row">
      <div class="col-lg-12 forum-view">

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


      		<div class="row">
      			<div class="col-md-7">
        			<?php if($research): ?>
               <?php foreach ($research as $r): ?>
        	  			 <h2 class="researchTitle"><?= $r['title'];?></h2><hr>
                   <!-- Working here Copyright-->
                   <?php if($r['privacy'] == 1): ?>
                                          <?php if($r['file'] != ''): ?>
                                            <p class="alert alert-info" style="width: 225px;"><b>This research is Copyrighted.</b></p>
                                          <?php endif; ?>
                                      <?php endif; ?>
                   <!-- Working here Copyright-->
                   <h4 class="forumText">Abstract</h4>
                   <?php if(empty($r['abstract'])): ?>
                     <center><i><h6 class="text-secondary mb-5">No abstract available</h6></i></center>
                   <?php else: ?>
                     <h6 class="forumText"><?= $r['abstract'];?></h6>
                   <?php endif; ?>
                   <br>
                   <?php if($r['category_id']): ?>
                     <p><b>Subject - Topical Term:
                     <i class="keywords-text"><?= ucwords($r['category_id']);?></i>
                     </b></p>
                   <?php endif; ?>
                   <hr>
                   <div class="row">
                     <div class="col-10">
                       <h5 class="forumText">View Research File</h5>
                     </div>
                     <div class="col">
                       <?php if($r['privacy'] == 1): ?>
                           <?php if($r['file'] != ''): ?>
                             <button type="button" onclick="login()" class="btn btn-info btn-sm"><span class="fa fa-download"></span>View here</button>
                           <?php else: ?>
                             <p>No available soft copy.</p>
                           <?php endif; ?>
                       <?php else: ?>
                          <button type="button" class="btn btn-info btn-sm" disabled><span class="fa fa-download"></span> View here</button>
                       <?php endif; ?>
                     </div>
                   </div>
                   <hr>
                   <div class="row mb-5">
                     <div class="col-10">
                       <h5 class="forumText">View Full Paper</h5>
                     </div>
                     <div class="col">
                       <?php if($r['full_paper'] != ''): ?>
                         <button type="button" onclick="login()" class="btn btn-info btn-sm"><span class="fa fa-download"></span> View here</button>
                       <?php else: ?>
                         <i>
                           <p>No available soft copy.</p>
                         </i>
                       <?php endif; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                     </div>
                   </div>

            </div>
            <div class="col-md-5">
              <div class="card forum-card">
                <div class="row no-gutters">
                  <div class="card-body">
                    <?php if($r['course_name']): ?>
                        <h6>Course : <?= ucwords($r['course_name']); ?></h6><hr>
                    <?php endif; ?>
                        <h6>School Year : <?= $r['school_year']; ?></h6><hr>
                        <h6>Defense Date : <?= $r['defense_date']; ?></h6><hr>
                        <h6>Date Submitted : <?= $r['date_submitted']; ?></h6><hr>
                        <h6>Keywords : <i><?= ucwords($r['keywords']);?></i></h6><hr>
                        <h6>Research Adviser :
                        <?php if(isset($r['first_name'])): ?>
                            <?= ucwords($r['first_name']. " ". $r['last_name']); ?></h6>
                        <?php endif; ?>
                        <hr>
                        <div class="row">
                          <div class="col">
                            <div class="listFlex">
                              <h6>Authors :
                              <ul>
                              <?php if($author): ?>
                                  <?php foreach($author as $a): ?>
                                    <li><?= ucwords($a['first_name']. " ".  $a['last_name']); ?></li>
                                  <?php endforeach; ?>
                              <?php else: ?>
                                 <li>None</li>
                              <?php endif; ?>
                              </ul>
                              </h6>
                            </div>
                          </div>
                          <div class="col">
                            <div class="listFlex">
                              <h6>Panelist :
                                <?php if($panels): ?>
                                <ul>
                                     <?php foreach($panels as $p): ?>
                                         <li><?= ucwords($p['first_name']. " ".  $p['last_name']); ?></li>
                                       <?php endforeach; ?>
                                </ul>
                                 <?php endif; ?>
                              </h6>
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
</div>
</div>
</div>

<script type="text/javascript">
function login()
{
    if(confirm("You need to log in to your account to view this file. \nDo you want to log in now?"))
    {
        window.location.href="<?php echo base_url(); ?>/loginV";
    }
    return false;
}

</script>
