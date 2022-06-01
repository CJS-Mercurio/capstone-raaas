<!-- <div class="container-fluid breadcrumb-container">
  <div class="row breadcrumb-row">
    <div class="col-lg-3 mt-2">
      <h1 class="breadcrumb-header"><i class="fa fa-calendar"></i> Forums</h1>
    </div>
    <div class="col-lg-9 breadcrumbs">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb float-right">

            <li class="breadcrumb-item"><a href="../login">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Forum View</li>

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
        <h1>Forums</h1>
        <p><a href="<?=base_url()?>/login">Home</a> / <span>Forum View</span></p>
      </div>
    </div>
  </div>
</div>
<!-- lasdf -->
<div class="container-fluid forum-container">
  <div class="row">
      <div class="col-lg-12 mb-3 forum-view">

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
            <?php if($forum): ?>
              <div class="col-md-6 mb-5">
                <h3 class="mt-5"><?php echo $forum['title']; ?></h3>
                <?php if(empty($forum['forum_image'])):?>
                  <center class="mt-5"><i>No poster available</i></center>
                <?php else: ?>
                  <center>
                    <img class="forum-poster mb-4" src="<?=base_url()?>/public/forumImages/<?= $forum['forum_image'];?>" height="350" width="40%">
                  </center>
                <?php endif;?>
              </div>
              
        	 <div class="col-md-5 mt-5 mb-5">
                <div class="card forum-card">
                  <div class="row no-gutters">
                     <div class="card-body mt-2 mb-2">
                        <h5 class="card-title">Event Details</h5>
                        <hr> 
                        <p class="card-text">Take note of the important details, so you won't miss anything. See you!</p>
                      </div>
                    <div class="card-body">
                      <h6>Date : <?php $f=strtotime($forum['dateFrom']); $t=strtotime($forum['dateTo']); ?>
                          <?php $from = date("M-d-Y", $f); $to = date("M-d-Y", $t);?>
                          <?php echo $from. " to ". $to; ?></h6>
                          <hr>
                      <h6>Time : <?php echo $forum['time']; ?></h6><hr>
                      <h6>Type of event : <?php echo $forum['event_type']; ?></h6><hr>
                      <h6>Location : <?php echo $forum['location']; ?> (<?php echo $forum['parameter']; ?>)</h6><hr>
                      <?php if($forum['details']): ?>
                        <br>
                        <h6>Other event details : </h6><p><?php echo $forum['details']; ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              
          <?php endif; ?>
              <div class="col-md-4 mt-4">

              </div>
          </div>
    </div>
  </div>
</div>
