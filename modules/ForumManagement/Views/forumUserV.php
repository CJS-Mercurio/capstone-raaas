<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
      <div class="col-lg-12 superadmin-form mb-3">

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

      		<div class="row">
        			<div class="col-md-4 mt-4">
        				<?php if($forum): ?>

                  <p><h6>Title:</h6> <?php echo $forum['title']; ?></p>
                  <p><h6>Date:</h6> <?php echo date('m-d-Y', strtotime($forum['dateFrom']))?> -  <?php echo date('m-d-Y', strtotime($forum['dateTo']))?></p>

                  <p><h6>Time:</h6> <?php echo $forum['time']; ?></p>
                  <p><h6>Type of event:</h6> <?php echo $forum['event_type']; ?></p>
                  <p><h6>Location :</h6> <?php echo $forum['location']; ?> (<?php echo $forum['parameter']; ?>)</p>
                  <p><h6>Other event details :</h6> <?php echo $forum['details']; ?></p>

                  <p><h6>Start of posting : <?php echo date('m-d-Y', strtotime($forum['start_posting']))?></h6></p>
                  <p><h6>Author : <?php echo $forum['submitted_name']; ?></h6></p>

              </div>


              <div class="col-md-5">
              <?php if($forum['forum_image']): ?>
      					<h4>Poster</h4>
                    <img class="mb-4" src="<?=base_url()?>/public/forumImages/<?= $forum['forum_image'];?>" height="500" width="400">
              <?php endif; ?>


              <?php endif; ?>
            </div>
          </div>
    </div>
  </div>
</div>

<script>

function delete_data(id)
{
    if(confirm("Are you sure you want to delete this forum?"))
    {
        window.location.href="<?php echo base_url(); ?>/forum/deleteForum/"+id;
    }
    return false;
}

function submit_data(id)
{
    if(confirm("Are you sure you want to submit this forum?"))
    {
        window.location.href="<?php echo base_url(); ?>/forum/submitAgain/"+id;
    }
    return false;
}


</script>
