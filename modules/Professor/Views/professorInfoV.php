<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Information Sheet</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
        <h3 class="prof-header mb-3">Seminars, Trainings and Conference attended</h3>


        <?php if($page_session->getTempdata('successSeminar')):?>
           <div class="alert alert-success"><?= $page_session->getTempdata('successSeminar');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('errorSeminar')):?>
           <div class="alert alert-danger"><?= $page_session->getTempdata('errorSeminar');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('deleted')):?>
           <div class="alert alert-success"><?= $page_session->getTempdata('deleted');?></div>
        <?php endif; ?>

        <form action="<?=base_url()?>/professor/addSeminar/<?=$professor['id']?>" method="post" class="form-row align-items-center" >

		           <div class="form-row col-12">
		               <div class="col-4 mb-3">
		                   <input type="text" class="form-control" id="validationCustom03" name="title" placeholder="Seminar Title">
		                   <span class="text-danger"> <?= display_error($validation, 'title'); ?></span>
		               </div>

		               <div class="col-2 mb-3 sponsor">
		                   <input type="text" class="form-control" id="validationCustom04" name="sponsor" placeholder="Sponsor Agency">
		                   <span class="text-danger"> <?= display_error($validation, 'sponsor'); ?></span>
		               </div>

		               <div class="col-2 mb-3">
		                   <input type="text" class="form-control" id="validationCustom04" name="venue" placeholder="Venue">
		                   <span class="text-danger"> <?= display_error($validation, 'venue'); ?></span>
		               </div>

		               <div class="col-2 mb-3 date">
		                   <input type="date" class="form-control" id="validationCustom04" name="date" placeholder="Date">
		                   <span class="text-danger"> <?= display_error($validation, 'date'); ?></span>
		               </div>


		              <div class="col-2 mb-3 btn-add">
		                  <button class="btn btn-success" type="submit"><i class="fas fa-plus-circle"></i>Add</button>
		              </div>
		   		</div>
		  </form>

		    <div class="col-12 mt-3">
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
			                        <!-- <td><?php $num++; echo $num; ?></td> -->
			                        <td><?php echo $ps['id']; $id =  $ps['id']; ?></td>
							        <td><?php echo $ps['seminar_title']; ?></td>
							        <td><?php echo $ps['sponsor']; ?></td>
							        <td><?php echo $ps['venue']; ?></td>
							        <td><?php echo $ps['event_date']; ?></td>
							         <td>
										<?php $id = $ps['id']?>
									 	<button type="button" onclick="delete_seminar('<?= $id ?>')" class="btn btn-danger btn-sm">Delete</button>
							        </td>

			               		</tr>
		             	<?php endforeach; ?>
              		 <?php endif; ?>


                  </tbody>
                </table>
              </div>


      <div class="header">
        <h3 class="prof-header mb-3">Published Researches</h3>

      </div>

       <?php if($page_session->getTempdata('successResearch')):?>
           <div class="alert alert-success"><?= $page_session->getTempdata('successResearch');?></div>
        <?php endif; ?>


       <?php if($page_session->getTempdata('deletedPub')):?>
           <div class="alert alert-success"><?= $page_session->getTempdata('deletedPub');?></div>
        <?php endif; ?>

       <form action="<?=base_url()?>/professor/addResearch/<?=$professor['id']?>" method="post" class="form-row align-items-center" >

		           <div class="form-row col-12 ml-2">
		               <div class="col-4">
		               	<input type="text" class="form-control" id="validationCustom03" name="research_title" placeholder="Research Title">
		                   <span class="text-danger"> <?= display_error($validation, 'research_title'); ?></span>
		               </div>

		               <div class="col-2">
		                   <input type="text" class="form-control" id="validationCustom04" name="publication" placeholder="Referred Publication">
		                   <span class="text-danger"> <?= display_error($validation, 'publication'); ?></span>
		               </div>

		               <div class="col-2">
		                   <input type="text" class="form-control" id="validationCustom04" name="volume" placeholder="Volume/Issue No.">
		                   <span class="text-danger"> <?= display_error($validation, 'volume'); ?></span>
		               </div>

		               <div class="col-2">
		                   <input type="text" class="form-control" id="validationCustom04" name="institute" placeholder="Institute/Branch">
		                   <span class="text-danger"> <?= display_error($validation, 'institute'); ?></span>
		               </div>

		               <div class="col-2 mb-3">
		                   <input type="date" class="form-control" id="validationCustom04" name="date_published" placeholder="Date Published">
		                   <span class="text-danger"> <?= display_error($validation, 'date_published'); ?></span>
		               </div>


                 </div>
		             <div class="col-12 btn-add ml-4">
		                  <button class="btn btn-success add-btn ml-5" type="submit"><i class="fas fa-plus-circle"></i>Add</button>
		             </div>
		  </form>

		    <div class="col-12 mt-3">
                <table class="table table-bordered table-striped" id="pResearch-list">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Title</th>
                      <th>Referred Pulication</th>
                      <th>Vol/Issue No.</th>
                      <th>Institute</th>
                      <th>Date Published</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>

  					 <?php if($p_research): ?>
                  	 	<?php $num = 0; ?>

			            <?php foreach($p_research as $pr): ?>
			                   <tr>
			                        <td><?php $num++; echo $num; ?></td>
							        <td><?php echo $pr['research_title']; ?></td>
							        <td><?php echo $pr['publication']; ?></td>
							        <td><?php echo $pr['volume']; ?></td>
							        <td><?php echo $pr['institute']; ?></td>
							        <td><?php echo $pr['event_date']; ?></td>
							        <td>
							         <?php $id = $pr['id']?>
									 <button type="button" onclick="delete_data('<?= $id ?>')" class="btn btn-danger btn-sm">Delete</button>
			                		</td>
			               		</tr>
		             	<?php endforeach; ?>
              		 <?php endif; ?>


                  </tbody>
                </table>
              </div>
    </div>
  </div>
</div>

<script>
function delete_data(id)
{
    if(confirm("Are you sure you want to remove it?"))
    {
        window.location.href="<?php echo base_url(); ?>/professor/delpResearch/"+id;
    }
    return false;
}

function delete_seminar(id)
{
    if(confirm("Are you sure you want to remove it?"))
    {
        window.location.href="<?php echo base_url(); ?>/professor/delSeminar/"+id;
    }
    return false;
}
</script>
