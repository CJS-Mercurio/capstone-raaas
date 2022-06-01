<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/forum">Forum</a></li>
          <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
    <?php if($forum): ?>
          <div class="row">
              <div class="forum-col">
                <div class="row">
                  <div class="col-lg-12">
                <?php if($forum['status'] == 0): ?>
                  <p>
                    <b>Current Status: </b><span class="badge badge-warning mr-5">Waiting for Approval</span>
                    <?php $id = $forum['id']?>
                    <a class="text-danger float-right" type="button" onclick="delete_data('<?= $id?>')">
                      Delete Forum
                    </a>
                    <a class="text-warning mr-3 float-right" type="submit" name="button" href="<?=base_url()?>/forum/editForum/<?= $forum['id'] ?>">Edit Forum </a>
                  </p>
                <?php elseif($forum['status'] == 4): ?>
                  <p>
                    <b>Current Status: </b><span class="badge badge-secondary">Not posted</span>
                  </p>
                <?php elseif($forum['status'] == 1): ?>
                  <p>
                    <b>Current Status: </b><span class="badge badge-success">Approved</span>
                  </p>
                <?php elseif($forum['status'] == 3): ?>
                  <p>
                    <b>Current Status: </b><span class="badge badge-success">Posted</span>
                  </p>
                <?php elseif($forum['status'] == 2): ?>
                  <p>
                      <b>Current Status: </b><span class="badge badge-danger">Disapproved</span>
                      <b>Reason for disapproval: </b><span class="badge badge-danger mr-5"><?php echo $forum['reason_for_disapproval'];?></span>
                    <?php $id = $forum['id']?>
                    <!-- <button type="button" onclick="submit_data('<?= $id?>')" class="btn btn-primary">Submit Again</button> -->
                    <a type="button" onclick="submit_data('<?= $id?>')" class="text-primary mr-1 ml-5 border-right">
                      Submit Again
                    </a>
                    <a class="text-warning mr-1 border-right" type="submit" name="button" href="<?=base_url()?>/forum/editForum/<?= $forum['id'] ?>">
                        Edit Forum
                    </a>
                    <?php $id = $forum['id']?>
                      <a class="text-danger" type="button" onclick="delete_data('<?= $id?>')">
                        Delete Forum
                      </a>
                    <?php else: ?>
                      <p class="text-secondary">An error occured</p>
                    <?php endif; ?>
                 </p>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
      <div class="col-12 form-col">

        <?php if(session()->getTempdata('successForum')): ?>
          <div class="alert alert-success">
            <?= session()->getTempdata('successForum'); ?>
          </div>
        <?php endif; ?>

        <?php if(session()->getTempdata('errorForum')): ?>
          <div class="alert alert-success">
            <?= session()->getTempdata('errorForum'); ?>
          </div>
        <?php endif; ?>

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
        <div class="container-fluid forum-div">
          <div class="row">
              <div class="col-6 poster-div">
                  <?php if(empty($forum['forum_image'])): ?>
                    <center>
                      <h5 class="text-secondary">No poster available</h5>
                    </center>
                  <?php else: ?>
                      <img class="thumbnail" height="600px" width="400px" src="<?=base_url()?>/public/forumImages/<?= $forum['forum_image'];?>">
                  <?php endif; ?>
              </div>
              <div class="col-6">
                <div class="row">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">Title:</th>
                        <td><?php echo $forum['title']; ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Date:</th>
                        <td>
                          <?php $f=strtotime($forum['dateFrom']); $t=strtotime($forum['dateTo']); ?>

                          <?php $from = date("M-d-Y", $f); $to = date("M-d-Y", $t);?>
                          <?php echo $from. " to ". $to; ?></p>

                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Time:</th>
                        <td><?php echo $forum['time']; ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Type of Event:</th>
                        <td><?php echo $forum['event_type']; ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Location:</th>
                        <td><?php echo $forum['location']; ?> (<?php echo $forum['parameter']; ?>)</td>
                      </tr>
                      <?php if($forum['details']): ?>
                        <tr>
                          <th scope="row">Other Event Details:</th>
                          <td><?php echo $forum['details']; ?></td>
                        </tr>
                      <?php endif; ?>
                      <tr>
                        <th scope="row">Author:</th>
                        <td><?php echo $forum['submitted_name']; ?></td>
                      </tr>
                    </tbody>
                  </table>
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
