<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/student">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Forum</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">

    <div class="col-lg-12 form-col">
      <?php if(session()->getTempdata('successForum')): ?>
        <div class="alert alert-success">
          <?= session()->getTempdata('successForum'); ?>
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

      <table class = "table table-bordered table-striped" id = "forum-list">
        <thead>
          <tr>
            <th>Title</th>
            <th>Start of Posting</th>
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
                    <td> <?php echo $f['start_posting']; ?> </td>
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

</script>
