<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">List of Research</a></li>
          <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
      <div class="col-lg-12 form-col">

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

        <?php if(session()->getTempdata('tama')): ?>
         <div class="alert alert-success">
           <?= session()->getTempdata('tama'); ?>
         </div>
        <?php endif; ?>

        <?php if(session()->getTempdata('mali')): ?>
         <div class="alert alert-danger">
           <?= session()->getTempdata('mali'); ?>
         </div>
        <?php endif; ?>

        <?php if($research): ?>
          <?php foreach ($research as $r): ?>
            <div class="row">
              <div class="col-10">
                <h1 class="title"><?= $r['title'];?></h1>
                 <!-- Working here Copyright-->
                 <?php if($r['privacy'] == 1): ?>
                                          <?php if($r['file'] != ''): ?>
                                            <p class="alert alert-info" style="width: 225px;"><b>This research is Copyrighted.</b></p>
                                          <?php endif; ?>
                                      <?php endif; ?>
                   <!-- Working here Copyright-->
              </div>
              <div class="col">
                <?php if($favorite): ?>
                  <form class="" action="<?=base_url()?>/research/removeFavorite/<?= $r['did'] ?>" method="post">
                    <!-- <button type="submit" name="button" class="heart btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Add to favorites"></button> -->
                    <button type="submit" class="btn btn-success btn-outline-light fas fa-heart success fav-btn" data-toggle="tooltip" data-placement="bottom" title="remove to favorites"></button>
                  </form>
                <?php else: ?>
                  <form class="" action="<?=base_url()?>/research/addFavorite/<?= $r['did'] ?>" method="post">

                    <!-- <button type="submit" name="button" class="btn btn-sm btn-success heart" data-toggle="tooltip" data-placement="bottom" title="Add to favorites"></button> -->
                    <button type="submit" class="btn btn-success btn-outline-light far fa-heart empty fav-btn" data-toggle="tooltip" data-placement="bottom" title="Add to favorites"></button>
                  </form>
                <?php endif; ?>
              </div>
            </div>

      		<div class="row">
      			<div class="col-sm-12">
                   <?php if($loggedIn): ?>
                       <?php if($loggedIn['role_id'] == 1): ?>
                         <?php if( $r['privacy'] == 2 ||  $r['privacy'] == null): ?>
                             <p>
                               <button class="btn btn-secondary full-research-btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                 <span class="fa fa-check"></span> Enable Full Research View
                               </button>
                             </p>
                             <div class="collapse" id="collapseExample">
                               <div class="card card-body">
                                 <p><b>Please insert Copyright Certificate</b></p>
                                 <form class="" action="<?=base_url()?>/research/copyright/<?=$r['did'] ?>" method="post" enctype="multipart/form-data">
                                   <div class="input-group mb-3">
                                     <div class="custom-file">
                                        <input id="inputGroupFile02" type="file" name="uploadCert">
                                     </div>
                                   </div>
                                   <button type="submit" name="button" class="btn btn-primary float-right">Upload</button>
                                 </form>
                               </div>
                             </div>
                          <?php else: ?>
                            <button class="btn btn-secondary full-research-btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                              <span class="fa fa-check"></span> Enabled Full Research View
                            </button>
                          <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                              <p><b>Copyright Certificate</b></p>
                              <img class="mb-4" src="<?=base_url()?>/public/copyright/<?= $r['copyright'];?>" height="400" width="400">
                              <form class="" action="<?=base_url()?>/research/updateCopyright/<?=$r['did'] ?>" method="post" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                  <div class="custom-file">
                                     <input id="inputGroupFile02" type="file" name="uploadCert">
                                  </div>
                                </div>
                                <?php $id = $r['did']; ?>
                                <button type="button" onclick="remove('<?= $id ?>')" class="btn btn-danger float-right">Remove certificate</button>
                                <button type="submit" name="button" class="btn btn-primary float-right mr-1">Update</button>

                              </form>
                            </div>
                          </div>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>

            </div>
          </div>

          <div class="container research-body">
            <div class="col-lg-12 research-col">
              <div class="row">
                <h2>Abstract</h2>
                <?php if (empty($r['abstract'])): ?>
                  <p class="text-secondary no-abstract float-right">No Abstract Available</p>
                <?php else: ?>
                  <p class="abstract-text" style="text-align: justify;"><?= $r['abstract'];?></p>
                <?php endif; ?>
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
                  <?php if(empty($r['keywords'])): ?>
                    <i class="text-secondary">No keywoards available</i>
                  <?php else: ?>
                    <i class="keywords-text"><?= ucwords($r['keywords']);?></i>
                  <?php endif; ?>
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
                  <h2>View Research File</h2>
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
                  <h2>View Full Paper</h2>
                  <form method="post" action="<?=base_url()?>/src/watermark-edit-existing-pdf.php">
                    <?php if($r['full_paper'] != ''): ?>
                        <?php if($r['privacy'] == 1): ?>
                          <input type="hidden" name="full" value="<?= $r['full_paper'] ?>">
                          <button type="submit"  name="dlf" class="btn btn-success std-researchV mb-3">
                            <i class="fa fa-download std-researchV-icon"></i>
                            View here
                          </button>
                      <?php else: ?>
                        <button type="submit"  name="dlf" class="btn btn-success std-researchV mb-3" disabled>
                          <i class="fa fa-download std-researchV-icon"></i>
                          View here
                        </button>
                      <?php endif; ?>
                    <?php else: ?>
                      <p>No available soft copy.</p>
                    <?php endif; ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php if($r['privacy'] == 1): ?>

            <div class="row">
              <div class="col-lg-10 ml-4">
                <h3>Citation</h3>
                <a href="<?=base_url()?>/research/downloadCite/<?= $r['did'] ?>" class="fa fa-download text-success float-right"> Download</a>

                <!-- Author, A.A.. (Year of Publication). The Title of work. -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="apa-tab" data-toggle="tab" href="#apa" role="tab" aria-controls="apa" aria-selected="true">APA</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="mla-tab" data-toggle="tab" href="#mla" role="tab" aria-controls="mla" aria-selected="false">MLA</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="chicago-tab" data-toggle="tab" href="#chicago" role="tab" aria-controls="chicago" aria-selected="false">Chicago</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="asa-tab" data-toggle="tab" href="#asa" role="tab" aria-controls="asa" aria-selected="false">ASA</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="apa" role="tabpanel" aria-labelledby="apa-tab">
                    <?php if($author): ?>
                      <?php foreach($author as $a):  ?>
                        <?php $initial = ''?>
                        <?php $first_name = explode(" ", $a['first_name']) ?>
                        <?php foreach ($first_name as $fn): ?>
                          <?php $initial .= ucwords($fn[0]) . "."?>
                        <?php endforeach; ?>
                        <?= ucwords($a['last_name']) . ", " . $initial ?>
                      <?php endforeach; ?>
                      <?= "(" . date("Y", strtotime ($r['date_submitted'])) . ")" . ". " . $r['title']?>
                    <?php else: ?>
                      <li>None</li>
                    <?php endif; ?></div>

                    <div class="tab-pane fade" id="mla" role="tabpanel" aria-labelledby="mla-tab">
                      <?php if($author): ?>
                        <?php foreach($author as $a):  ?>
                          <?= ucwords($a['last_name']. ", ".  $a['first_name']) . ". "; ?>
                        <?php endforeach; ?>
                        <?= $r['title'] . ". " . date("Y", strtotime ($r['date_submitted']))?>
                      <?php else: ?>
                        <li>None</li>
                      <?php endif; ?>
                    </div>
                    <div class="tab-pane fade" id="chicago" role="tabpanel" aria-labelledby="chicago-tab">
                      <?php if($author): ?>
                        <?php foreach($author as $a):  ?>
                          <?= ucwords($a['last_name']. ", ".  $a['first_name']) . ". "; ?>
                        <?php endforeach; ?>
                        <?= $r['title'] . ". " . date("Y", strtotime ($r['date_submitted']))?>
                      <?php else: ?>
                        <li>None</li>
                      <?php endif; ?>
                    </div>
                    <div class="tab-pane fade" id="asa" role="tabpanel" aria-labelledby="asa-tab">
                      <?php if($author): ?>
                        <?php foreach($author as $a):  ?>
                          <?= ucwords($a['last_name']. ", ".  $a['first_name']) . ". "; ?>
                        <?php endforeach; ?>
                        <?= date("Y", strtotime ($r['date_submitted'])) . ". " . $r['title']  ?>
                      <?php else: ?>
                        <li>None</li>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
            </div>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
    </div>
  </div>
</div>


<script type="text/javascript">
function remove(id)
{
    if(confirm("Are you sure you want to remove the copyright certificate?"))
    {
        window.location.href="<?php echo base_url(); ?>/research/removeCert/"+id;
    }
    return false;
}

</script>
