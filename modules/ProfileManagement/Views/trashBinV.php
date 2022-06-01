<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Trash</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <h3>Trash </h3>
      <div class="container-table">
        <?php if(session()->getTempdata('errorRestore')): ?>
           <div class="alert alert-danger"><?= session()->getTempdata('errorRestore'); ?></div>
        <?php endif;?>

        <?php if(session()->getTempdata('successRestore')): ?>
           <div class="alert alert-success"><?= session()->getTempdata('successRestore'); ?></div>
        <?php endif;?>
        <div class="row">
              <span class="note mb-3"><i>*Activities that have been in trash more than 30 days will be automatically deleted.</i></span>


              <table class = "table table-bordered table-striped" id = "forum-list">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Deleted</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($research): ?>
                    <?php foreach($research as $r): ?>
                      <?php if($r['deleted_at'] != NULL): ?>
                          <?php
                          $d = new \DateTime($r['deleted_at']);
                          $now = new \DateTime();
                          ?>
                          <?php if($d->diff($now)->days < 30): ?>
                            <tr>
                              <td>
                                <a class="" href="<?=base_url()?>/profile/documentView/<?= $r['id'] ?>"> <?php echo $r['title']; ?></a>
                              </td>
                              <td> <?php echo $r['deleted_at']; ?> </td>

                              <td>
                                  <?php $id = $r['id']?>
                                  <button type="button" onclick="restoreDocu('<?= $id ?>')" class="btn btn-info fas fa-recycle"> Restore</button>

                              </td>
                            </tr>
                          <?php endif; ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  <?php if($forum): ?>
                    <?php foreach($forum as $f): ?>
                      <?php if($f['deleted_at'] != NULL): ?>
                          <?php
                          $d = new \DateTime($f['deleted_at']);
                          $now = new \DateTime();
                          ?>
                          <?php if($d->diff($now)->days < 30): ?>
                            <tr>
                              <td>
                                <a class="" href="<?=base_url()?>/profile/forumView/<?= $f['id'] ?>"> <?php echo $f['title']; ?></a>
                              </td>

                              <td> <?php echo $f['deleted_at']; ?> </td>

                              <td>
                                <?php $id = $f['id']?>
                                <button type="button" onclick="restoreForum('<?= $id ?>')" class="btn btn-info fa fa-trash-restore"> Restore</button>

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

<script type="text/javascript">

  function restoreDocu(id)
  {
      if(confirm("Are you sure you want to restore this data?"))
      {
          window.location.href="<?php echo base_url(); ?>/profile/documentRestore/"+id;
      }
      return false;
  }

  function restoreForum(id)
  {
      if(confirm("Are you sure you want to restore this data?"))
      {
          window.location.href="<?php echo base_url(); ?>/profile/forumRestore/"+id;
      }
      return false;
  }
</script>
