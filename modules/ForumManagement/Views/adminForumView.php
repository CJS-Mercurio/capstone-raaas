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
  <div class="row">
    <div class="forum-col">
      <div class="row">
        <div class="col-lg-7">
          <?php if($forum['status'] == 0): ?>
            <p>
              <b>Current Status: </b><span class="badge badge-warning mr-5">Waiting for Approval</span>
            </p>

        </div>
        <div class="col-lg-5 float-right approve-div">
          <?php if($user['id'] == $forum['submitted_id']): ?>
            <a type="submit" class="text-warning border-right mr-1 ml-5" href= "<?=base_url()?>/forum/adminEditForum/<?= $forum['id'] ?>"><i class="fas fa-pencil-alt"></i> Edit Forum </button>
              <?php $id = $forum['id']?>
              <a type="button" onclick="delete_data('<?= $id?>')" class="text-danger border-right mr-1"><i class="far fa-thumbs-down"></i> Delete Forum </a>
              <a type="button" onclick="approve_data('<?= $id?>')" class="text-success"><i class="far fa-thumbs-up"></i> Approve</a>
              <?php else: ?>
                <?php $id = $forum['id']?>
                <a type="button" onclick="approve_data('<?= $id?>')" class="text-success border-right mr-1"><i class="far fa-thumbs-up"></i> Approve </a>
                <a type="button" class="text-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-thumbs-down"></i> Disapprove</a>
              <?php endif; ?>
        </div>
          <?php else: ?>
            <p class="text-secondary">An error occured</p>
          <?php endif; ?>

        </div>
      </div>
      <div class="col-lg-12 form-col">
        <div class="container-fluid forum-div">
          <div class="row">
            <?php if($forum['status'] == 0):?>
              <div class="col-6 poster-div">
                <?php if(empty($forum['forum_image'])): ?>
                  <center>
                  <h5 class="text-secondary">No poster Available</h5>
                </center>
                <?php else: ?>
                      <img class="thumbnail" height="600px" width="200px" src="<?=base_url()?>/public/forumImages/<?= $forum['forum_image'];?>">
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
    <?php endif; ?>

              </div>
            </div>
          </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalCenterTitle">Reason for Disapproval</h5>
     </div>
     <div class="modal-body">

       <form method="post" action="<?=base_url()?>/forum/disapproveForum/<?= $forum['id']?>">

           <select class="custom-select" id="reason" name="reason">
             <option selected value="">Choose...</option>
             <?php foreach ($forum_reason as $r): ?>
               <?php if($r['deleted_at'] == NULL): ?>
                    <option name="reason" value="<?=$r['reason']; ?>" <?= set_select('reason', $r['reason']) ?>><?=$r['reason']; ?></option>
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


<script>
function approve_data(id)
{
    if(confirm("Are you sure you want to approve this forum?"))
    {
        window.location.href="<?php echo base_url(); ?>/forum/approveForum/"+id;
    }
    return false;
}

function delete_data(id)
{
    if(confirm("Are you sure you want to delete this forum?"))
    {
        window.location.href="<?php echo base_url(); ?>/forum/deleteForum/"+id;
    }
    return false;
}

</script>
