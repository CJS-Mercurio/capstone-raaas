
<?php $validation = \Config\services::validation()?>
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
    <div class="col-12 form-col">
      <?php if(session()->getTempdata('errorForum')): ?>
        <div class="alert alert-danger">
          <?= session()->getTempdata('errorForum'); ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url() ?>/forum/adminEditForum/<?=$forum['id']; ?>"  method="post" enctype="multipart/form-data">
        <div class="form-group">
          <div class="form-row">
          <div class="form-group col-md-8">
            <label for="inputCity">Forum Title</label>
            <input type="text" class="form-control" name = "forumTitle" value="<?= $forum['title']; ?>" id="forumTitle" aria-describedby="emailHelp" placeholder="Enter Title">
            <?php if($validation->getError('forumTitle')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('forumTitle'); ?>
                    </div>
            <?php }?>
          </div>
          <div class="form-group col-md-2">
            <label for="inputState">From</label>
            <input type="date" class="form-control" min=<?php echo date('Y-m-d'); ?> name="forumFrom" value="<?= $forum['dateFrom']; ?>" id="forumFrom" placeholder="">
            <?php if($validation->getError('forumFrom')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('forumFrom'); ?>
                    </div>
            <?php }?>
          </div>
          <div class="form-group col-md-2">
            <label for="inputZip">To</label>
            <input type="date" class="form-control" min=<?php echo date('Y-m-d'); ?> name="forumTo" value="<?= $forum['dateTo']; ?>" id="forumTo" placeholder="">
            <?php if($validation->getError('forumTo')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('forumTo'); ?>
                    </div>
            <?php }?>
          </div>
        </div>

        <div class="form-group">
          <label for="forumDate">Start of Posting</label>
          <input type="date" class="form-control" name="forumStart" value="<?= $forum['start_posting']; ?>" id="forumStart" placeholder="">
          <?php if($validation->getError('forumStart')) {?>
                  <div class='text-danger'>
                    <?= $error = $validation->getError('forumStart'); ?>
                  </div>
          <?php }?>
        </div>
        <div class="form-group">
          <label for="forumTime">Time</label>
          <input type="time" class="form-control" name="forumTime" value="<?= $forum['time']; ?>" id="forumTime" placeholder="">
          <?php if($validation->getError('forumTime')) {?>
                  <div class='text-danger'>
                    <?= $error = $validation->getError('forumTime'); ?>
                  </div>
          <?php }?>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="inputCity">Location</label>
            <input type="text" class="form-control" name = "forumLocation" value="<?= $forum['location']; ?>" id="forumLocation" aria-describedby="emailHelp" placeholder="Enter Location">
            <?php if($validation->getError('forumLocation')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('forumLocation'); ?>
                    </div>
            <?php }?>
          </div>
          <div class="form-group col-md-4">
            <label class="hidden" for="inputCity">Setting</label>
            <select name="forumParam"  id="inputState" class="form-control">
              <option selected value="<?= $forum['parameter']; ?>"><?= $forum['parameter']; ?></option>
              <?php foreach ($setting as $s): ?>
                <?php if($s['deleted_at'] == NULL): ?>
                     <option name="forumParam" value="<?=$s['name']; ?>" <?= set_select('forumParam', $s['name']) ?>><?=$s['name']; ?></option>
                <?php endif; ?>
              <?php endforeach ?>
            </select>
            <?php if($validation->getError('forumParam')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('forumParam'); ?>
                    </div>
            <?php }?>
          </div>
        </div>
        <div class="form-group">
          <label for="forumType">Type of Event</label>
          <select name="forumType"  id="inputState" class="form-control">
            <option selected value="<?= $forum['event_type']; ?>"><?= $forum['event_type']; ?></option>
            <?php foreach ($event_type as $et): ?>
              <?php if($et['deleted_at'] == NULL): ?>
                   <option name="forumType" value="<?=$et['type']; ?>" <?= set_select('forumType', $et['type']) ?>><?=$et['type']; ?></option>
              <?php endif; ?>
            <?php endforeach ?>
          </select>
          <?php if($validation->getError('forumType')) {?>
                  <div class='text-danger'>
                    <?= $error = $validation->getError('forumType'); ?>
                  </div>
          <?php }?>
        </div>
        <div class="form-group">
          <label for="forumDetail">Other event details</label>
          <textarea name="forumDetail" class="form-control" value="<?= $forum['details']; ?>" aria-label="With textarea"><?= $forum['details']; ?></textarea>
        </div>
        <div class="form-group">

          <div class="alert alert-primary" role="alert">
            <b>Notice:</b> Please use <b>jpeg/png</b> format for Poster.
          </div>


          <p>Current image: <?= $forum['forum_image']; ?></p>
           <div class="input-group mb-3">
               <div class="custom-file">
                  <input type="hidden" name="forum_image" value="<?= $forum['forum_image']; ?>">
                  <input id="inputGroupFile02" type="file" name="forumImage">
               </div>
               <div class="input-group-append">
                   <button type="submit" class="btn btn-success mt-5">Update</button>
               </div>
             </div>
      </form>
    </div>
  </div>
</div>
