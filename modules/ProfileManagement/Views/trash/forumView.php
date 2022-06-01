<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/profile/trash">Trash</a></li>
          <li class="breadcrumb-item active" aria-current="page">Forum</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <?php if($forum): ?>
  <div class="row">
      <div class="col-12 form-col">
        <div class="container-fluid forum-div">
          <div class="row">
              <div class="col-6 poster-div">
                <?php if($forum['forum_image']): ?>
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
                <?php endif; ?>
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
