<?php $page_session = \Config\Services::session()?>

<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/student">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Information Sheet</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 std-form">
      <div class="header">
        <h3 class="std-header mb-3">Seminars, Trainings and Conference attended</h3>
      </div>
        <?php if($page_session->getTempdata('successSeminar')):?>
           <div class="alert alert-success"><?= $page_session->getTempdata('successSeminar');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('errorSeminar')):?>
           <div class="alert alert-danger"><?= $page_session->getTempdata('errorSeminar');?></div>
        <?php endif; ?>

         <?php if($page_session->getTempdata('deleted')):?>
           <div class="alert alert-success"><?= $page_session->getTempdata('deleted');?></div>
        <?php endif; ?>


        <form action="<?=base_url()?>/student/addSeminar/<?=$student['id']?>" method="post" class="form-row align-items-center" >

		           <div class="form-row col-12 ml-3">
		               <div class="col-4">
		                   <input type="text" class="form-control" id="validationCustom03" name="title" placeholder="Seminar Title">
		                   <span class="text-danger"> <?= display_error($validation, 'title'); ?></span>
		               </div>

		               <div class="col-2">
		                   <input type="text" class="form-control" id="validationCustom04" name="sponsor" placeholder="Sponsor Agency">
		                   <span class="text-danger"> <?= display_error($validation, 'sponsor'); ?></span>
		               </div>

		               <div class="col-2">
		                   <input type="text" class="form-control" id="validationCustom04" name="venue" placeholder="Venue">
		                   <span class="text-danger"> <?= display_error($validation, 'venue'); ?></span>
		               </div>

		               <div class="col-2">
		                   <input type="date" class="form-control" id="validationCustom04" name="date" placeholder="Date">
		                   <span class="text-danger"> <?= display_error($validation, 'date'); ?></span>
		               </div>


		              <div class="col-2 btn-add">
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

                   <?php if($s_seminar): ?>
			            <?php foreach($s_seminar as $ss): ?>
			                   <tr>
			                        <td><?php $num++; echo $num; ?></td>
							        <td><?php echo $ss['seminar_title']; ?></td>
							        <td><?php echo $ss['sponsor']; ?></td>
							        <td><?php echo $ss['venue']; ?></td>
							        <td><?php echo $ss['event_date']; ?></td>
							        <td>
							        	<?php $id = $ss['id']?>
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
</div>
<script type="text/javascript">

	function delete_data(id)
		{
		    if(confirm("Are you sure you want to remove it?"))
		    {
		        window.location.href="<?php echo base_url(); ?>/student/delSeminar/"+id;
		    }
		    return false;
		}

</script>
