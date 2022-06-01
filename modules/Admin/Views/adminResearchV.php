<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item"><a href="/OrtacFinal/admin/pending">List</a></li>
          <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="forum-col">
      <div class="row">
        <div class="col-12">
          <?php if($research['research_status'] == 0):?>

            <div class="card-footer">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1">
                  Approve
               </button>
                         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Disapprove</button>
                         </form>
            </div>
         <?php endif; ?>
        </div>
      </div>
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
                                    <li><?= ucwords($a['first_name']. " ".  $a['last_name']); ?></li>
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
                                      <li><?= ucwords($p['first_name']. " ".  $p['last_name']); ?></li>
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
                                <button type="submit" name="dl" class="btn btn-success std-researchV mb-3">
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

						<br>

      			</div>
      		</div>


      		<!-- Modal of approve -->
      		<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form method="post" action="<?=base_url()?>/admin/approveResearch/<?= $research['id'] ?>">
			        	<h5>Are you sure you want to approve this research?</h5>

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			        <button type="submit" class="btn btn-primary">Yes</button>
			      </div>
			    </div>
			   </form>
			  </div>
			</div>

      		<!-- Modal for disapprove -->
			 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalCenterTitle">Reason for Disapproval</h5>
			      </div>
			      <div class="modal-body">
			        <form method="post" action="<?=base_url()?>/admin/disapproveResearch/<?= $research['id'] ?>">

			        		<select class="custom-select" id="reason" name="reason">
			                  <option selected value="">Choose...</option>
			                  <option name="reason" value="Invalid Title">Invalid Title</option>
			                  <option name="reason" value="Too few abstract">Too few abstract</option>
			                  <option name="reason" value="No softcopy of research">No softcopy of research</option>
			                  <option name="reason" value="Cannot download research">Cannot download research</option>

			               </select>

			                <div class="form-check mt-5">
					            <label class="form-check-label " for="defaultCheck1">Other: Please specify</label>
					            <input class="form-control form-control-sm ml-3 w-50" name="reason" type="text" placeholder="" style="display: inline">
					        </div>


				      </div>
				      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Save changes</button>
				      </div>
				    </div>
			     </form>
			  </div>
			</div>



  </div>
</div>
