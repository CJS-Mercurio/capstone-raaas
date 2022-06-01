<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Forum</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <div class="col-12 form-col">
      <button type="button" class="btn btn-success float-right add-forum-btn btn-sm" onclick="document.location = '<?= base_url() ?>/forum/addForum'" name="addForum">
        <i class="fa fa-plus"></i>
        Add Forum
      </button>
      <h3>Forum</h3>
      <?php if(session()->getTempdata('successForum')): ?>
        <div class="alert alert-success">
          <?= session()->getTempdata('successForum'); ?>
        </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successDeact')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successDeact'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successPost')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successPost'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorPost')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorPost'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('successUnpost')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('successUnpost'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorUnpost')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorUnpost'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('errorDeact')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeact'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('disapproved')): ?>
       <div class="alert alert-success">
         <?= session()->getTempdata('disapproved'); ?>
       </div>
      <?php endif; ?>

      <?php if(session()->getTempdata('notDisapproved')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('notDisapproved'); ?>
       </div>
      <?php endif; ?>

      <div class="col-md-12">
        <div class="right-content">
          <div class="tabbable-responsive">
            <div class="tabbable">
              <ul class="nav nav-tabs" role="tablist" id="myTab">
                  <?php foreach ($allowed_task as $at): ?>
                    <?php if($at['tid'] == 15): ?>
                      <li class="nav-item">
                        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">Approval</a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <li class="nav-item">
                  <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Posting</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">To delete</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                <h5 class="card-title">Approval</h5>
                <table class = "table table-bordered table-striped" id = "forum-list">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($forum): ?>
                      <?php foreach($forum as $f): ?>
                        <?php if($f['deleted_at'] == NULL && $f['status'] == 0): ?>
                            <tr>
                              <td> <?php echo $f['title']; ?> </td>
                              <td>
                                <?php if($f['status'] == 0): ?>
                                   Waiting for approval
                                 <?php else: ?>
                                   <button type="button" class="btn btn-dark btn-sm disabled">Invalid</button>
                                 <?php endif; ?>
                              </td>
                                  <td>
                                    <form method="post" action="<?=base_url()?>/forum/adminViewForum/<?= $f['id'] ?>">
                                     <button type="submit" class="btn btn-info fa fa-eye"></button>
                                    </form>
                                  </td>
                            </tr>
                         <?php endif; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                <h5 class="card-title">Posting</h5>
                <table class = "table table-bordered table-striped" id = "research-list">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Start of Posting</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($forum): ?>
                      <?php foreach($forum as $f): ?>
                        <?php $current = date("Y-m-d h:i:sa"); ?>
                       <?php if(($current < $f['dateTo']) && $f['status'] == 1 || $f['status'] == 4 || $f['status'] == 3): ?>
                        <?php if($f['deleted_at'] == NULL &&  $current < $f['dateTo']): ?>
                            <tr>
                              <td> <?php echo $f['title']; ?> </td>
                              <td>
                                <?php $s=strtotime($f['start_posting']); ?>

                                <?php $start = date("M-d-Y", $s); ?>
                                <?php echo $start; ?>
                              </td>

                                  <td class="action-btn">
                                    <form class="form-action" method="post" action="<?=base_url()?>/forum/viewForum/<?= $f['id'] ?>">
                                     <button type="submit" class="btn btn-info fa fa-eye mr-1"></button>
                                    </form>
                                           <?php if($f['status'] == 3): ?>
                                             <?php $id = $f['id']?>
                                             <button type="button" onclick="unpost_data('<?= $id ?>')" class="btn btn-danger btn-sm action-btn">Unpost</button>
                                           <?php else: ?>
                                             <?php $id = $f['id']?>
                                             <button type="button" onclick="post_data('<?= $id ?>')" class="btn btn-success btn-sm action-btn">Post</button>
                                           <?php endif; ?>

                                  </td>
                            </tr>
                          <?php endif; ?>
                         <?php endif; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                <h5 class="card-title">To delete</h5>
                <table class = "table table-bordered table-striped" id = "seminar-list">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($forum): ?>
                      <?php foreach($forum as $f): ?>
                        <?php if($f['deleted_at'] == NULL && $current > $f['dateTo']): ?>
                          <?php $current = date("Y-m-d h:i:sa"); ?>
                            <tr>
                              <td> <?php echo $f['title']; ?> </td>
                              <td>Event is expired</td>
                                  <td>
                                      <?php $id = $f['id'] ?>
                                      <button type="button" onclick="delete_data('<?= $id ?>')" class="btn btn-danger btn-sm action-btn"><i class="fa fa-trash"></i> Delete</button>
                                  </td>
                            </tr>
                         <?php endif; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>
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

<script>
function delete_data(id)
{
    if(confirm("Are you sure you want to delete this forum?"))
    {
        window.location.href="<?php echo base_url(); ?>/forum/deleteForum/"+id;
    }
    return false;
}

function post_data(id)
{
    if(confirm("Are you sure you want to post this forum?"))
    {
        window.location.href="<?php echo base_url(); ?>/forum/postForum/"+id;
    }
    return false;
}

function unpost_data(id)
{
    if(confirm("Are you sure you want to unpost this forum?"))
    {
        window.location.href="<?php echo base_url(); ?>/forum/unpostForum/"+id;
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
