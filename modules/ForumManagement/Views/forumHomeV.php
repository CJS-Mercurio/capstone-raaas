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
    <?php foreach ($allowed_task as $at): ?>

      <?php if($at['tid'] == 15): ?>
        <button type="button" class="btn btn-info approve-btn float-right" onclick="document.location = '<?=base_url()?>/forum/toApproveForum'">
          <i class="fas fa-thumbs-up"></i>
          To approve forum
        </button>
      <?php endif; ?>
    <?php endforeach; ?>

      <button type="button" class="btn btn-success float-right btn-sm" onclick="document.location = '<?= base_url() ?>/forum/addForum'" name="addForum">
        <i class="fas fa-plus"></i>
        Add Forum
      </button>
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

      <?php if(session()->getTempdata('errorDeact')): ?>
       <div class="alert alert-danger">
         <?= session()->getTempdata('errorDeact'); ?>
       </div>
      <?php endif; ?>
      <h3>Forums</h3>
      <div class="container-table">
        <div class="row1">
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
                  <?php if($f['submitted_id'] == $user['id']): ?>
                    <?php if($f['deleted_at'] == NULL): ?>
                      <tr>
                        <td> <?php echo $f['title']; ?> </td>
                        <?php if($f['status'] == 0): ?>
                          <td>Waiting for Admin approval</td>
                        <?php elseif($f['status'] == 1): ?>
                          <td>Approved</td>
                        <?php elseif($f['status'] == 2): ?>
                          <td>Disapproved</td>
                        <?php elseif($f['status'] == 3): ?>
                          <td>Posted</td>
                        <?php elseif($f['status'] == 4): ?>
                          <td>Not posted</td>
                        <?php else: ?>
                          <td>Invalid</td>
                        <?php endif; ?>
                        <td>
                          <form method="post" action="<?=base_url()?>/forum/viewForum/<?= $f['id'] ?>">
                            <button type="submit" class="btn btn-info fa fa-eye"></button>
                          </form>

                        </td>
                      </tr>
                    <?php endif; ?>
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
