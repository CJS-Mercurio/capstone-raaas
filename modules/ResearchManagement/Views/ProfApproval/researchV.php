<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url()?>/admin/pending">List</a></li>
          <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
      <div class="col-lg-12 form-col">

      		<div class="row">
      			<div class="col-8">

      			<?php if($research): ?>
              <?php foreach($research as $r): ?>

      	  			 <h1><?= $r['title'];?></h1>


      				  <br>
      	  			  <p>School Year: <?= $r['school_year']?></p>
      				   <p>Defense date: <?= $r['defense_date']?></p>
      				   <p>Date Submitted: <?= $r['date_submitted']?></p>


      				   <h4>Abstract</h4>
      				   <p><?= $r['abstract'];?>

      				   <h5>Keywords</h5>
      				   	<i><?= ucwords($r['keywords']);?></i>
      				   </p>

                 <?php if($r['first_name']): ?>
                   <h5>Research Adviser</h5>
                   <p><?= ucwords($r['first_name']. " ". $r['last_name']); ?></p>

                 <?php endif; ?>


    				      <h5>Authors</h5>
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

        				   <h5>Panelist</h5>
        				   <div class="listFlex">
        				      <div>
        				         <ul>
        				           <?php if($panels): ?>
        			                   <?php foreach($panels as $p): ?>
        			                     <li><?= ucwords($p['first_name']. " ".  $p['last_name']); ?></li>
        			                   <?php endforeach; ?>
        			               <?php else: ?>
        			               		<li>None</li>
        			               <?php endif; ?>
        						         </ul>
        						      </div>
        						   </div>

  				  		 <h5>Download Full Research</h5>
      				 			<form method="post" action="<?=base_url()?>/student/download/<?= $r['id'] ?>">

      						    <?php if($r['file'] != ''): ?>
      		                  <button type="submit" class="btn btn-success std-researchV mb-3">
      		                    <i class="fa fa-download std-researchV-icon"></i>
      		                    Download
      		                  </button>

      			                 	<?php else: ?>
      			                 		<p>No available soft copy.</p>
      			                 	<?php endif; ?>

      			                 	</form>

            			</div>

                  		<div class="col-4 mt-4">
                  				<div class="card text-center">
            						  <div class="card-header">
            						    Current Status
            						  </div>
            						  <div class="card-body">
            						    <?php if($r['research_status'] == 3):?>
            						  		<h5>Approved</h5>
            						    <?php elseif($r['research_status'] == 0): ?>
            						  		<h5>Waiting for Approval</h5>
            						  	<?php elseif($r['research_status'] == 2): ?>
            						  		<h5>Disapproved</h5>
            						  	<?php else: ?>
            						  		<h5>An error occured</h5>

            						    <?php endif; ?>

            						  </div>
            						  <?php if($r['research_status'] == 0):?>

            							  <div class="card-footer">
            					                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1">
            										  Approve
            									 </button>
            					                   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Disapprove</button>
                               				   </form>
            							  </div>


            						 <?php endif; ?>
            						</div>

            						<br>

                  			</div>
                  		</div>
                   <?php endforeach; ?>
                <?php endif; ?>

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
              <?php foreach ($research as $r): ?>
                <?php $id = $r['did']; ?>
              <?php endforeach; ?>

			        <form method="post" action="<?=base_url()?>/research/approveRes/<?= $id; ?>">
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
            <?php foreach ($research as $r): ?>
              <?php $id = $r['did']; ?>
            <?php endforeach; ?>

			        <form method="post" action="<?=base_url()?>/research/disapproveRes/<?= $id ?>">

			        		<select class="custom-select" id="reason" name="reason">
                    <option selected value="">Choose...</option>
                    <?php foreach ($adviser_reason as $s): ?>
                      <?php if($s['deleted_at'] == NULL): ?>
                           <option name="reason" value="<?=$s['reason']; ?>" <?= set_select('reason', $s['reason']) ?>><?=$s['reason']; ?></option>
                      <?php endif; ?>
                    <?php endforeach ?>
                  </select>

			                <!-- <div class="form-check mt-5">
					            <label class="form-check-label " for="defaultCheck1">Other: Please specify</label>
					            <input class="form-control form-control-sm ml-3 w-50" name="reason" type="text" placeholder="" style="display: inline">
					        </div> -->
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
</div>
