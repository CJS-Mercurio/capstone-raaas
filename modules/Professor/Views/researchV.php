<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/professor">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/professor">List of Research</a></li>
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

	  			 <h1><?= $research['title'];?></h1>
	  			 <br>
	  			  <p>School Year: <?= $research['school_year']?></p>
				   <p>Defense date: <?= $research['defense_date']?></p>
				   <p>Date Submitted: <?= $research['date_submitted']?></p>


				   <h4>Abstract</h4>
				   <p><?= $research['abstract'];?>

				     <h5>Keywords</h5>
				   	<i><?= ucwords($research['keywords']);?></i>
				   </p>

				    <h5>Research Adviser</h5>
				    <?php if($research['adviser'] == ''): ?>
				    	<li>None</li>
				    <?php else: ?>
				   		<p><?= $research['adviser']?></p>
				   	<?php endif; ?>

				    <h5>Authors</h5>
				   <div class="listFlex">
				      <div>
				         <ul>
				   		<?php if($authors): ?>
				         	<?php foreach($authors as $a): ?>
				           		<li><?= ucwords($a['f_firstname']. " ".  $a['f_lastname']); ?></li>
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
					           		<li><?= ucwords($p['f_firstname']. " ".  $p['f_lastname']); ?></li>
					           	<?php endforeach; ?>
					        <?php else: ?>
					        	<li>None</li>
					 		<?php endif; ?>
				         </ul>
				      </div>
				   </div>
				   <h5>Download Full Research</h5>
				 			<form method="post" action="<?=base_url()?>/student/download/<?= $research['id'] ?>">

			                 		<?php if($research['file'] != ''): ?>
			                 		<button type="submit" class="btn btn-success std-researchV mb-3">
                            <i class="fa fa-download std-researchV-icon"></i>
                            Download
                          </button>
			                 		<?php else: ?>
			                 			<p>No available soft copy.</p>
			                 		<?php endif; ?>
			                 	</form>

      		<?php endif; ?>
 		</div>


 				<div class="col-4 mt-5">

      				<div class="card text-center">
						    <div class="card-header">
						      Current Status
						    </div>
						  <div class="card-body">
						   <?php if($research['research_status'] == 1):?>
						  		<h5>Approved</h5>
						    <?php elseif($research['research_status'] == 0): ?>
						  		<h5>Waiting for Approval</h5>
						  	<?php elseif($research['research_status'] == 3): ?>
						  		<h5>Disapproved</h5>
				   					<p>Reason for denial: <?= $research['reason_for_denial']?></p>
				   					<form method="post" action="<?=base_url()?>/professor/submitAgain/<?= $research['id'] ?>">
				   						<button class="btn btn-success">Submit Again</button>
				   					</form>
						  	<?php else: ?>
						  		<h5>An error occured</h5>

						    <?php endif; ?>

						  </div>
						</div>

						<br>


						<?php if($research['research_status'] == 0 || $research['research_status'] == 3):?>
      					<div class="card text-center">
						       <div class="card-body">
						          <h5 class="card-title">Action</h5>

			                 		<button onclick="document.location= '<?=base_url()?>/professor/edit_prof_res/<?= $research['id'] ?>' " type="submit" class="btn btn-warning mt-1">Edit Research</button>
			                 		<button type="button" class="btn btn-danger mt-1" data-toggle="modal" data-target="#exampleModalCenter">
									  Delete Research
									</button>
						  </div>
						</div>
					    <?php endif; ?>
      			</div>
      		</div>


            <!-- Modal for delete-->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <h5>Are you sure you want to delete this research?</h5>
			      </div>
			      <div class="modal-footer">

			      	<form method="post" action="<?=base_url()?>/professor/delete_prof_res/<?= $research['id'] ?>">
						<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				        <button type="submit" class="btn btn-secondary">Yes</button>

					</form>

			      </div>
			    </div>
			  </div>
			</div>

    </div>
  </div>
</div>
