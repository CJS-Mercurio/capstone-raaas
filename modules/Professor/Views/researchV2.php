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



    </div>
  </div>
</div>
