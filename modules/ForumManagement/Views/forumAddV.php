
<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/forum">Forum</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Forum</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <?php if(session()->getTempdata('errorForum')): ?>
        <div class="alert alert-danger">
          <?= session()->getTempdata('errorForum'); ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url() ?>/forum/addForum"  method="post" enctype="multipart/form-data">
        <div class="form-group">
          <div class="form-row">
          <div class="form-group col-md-8">
            <label for="inputCity">Forum Title</label>
            <input type="text" class="form-control" name = "forumTitle" value="<?= set_value('forumTitle') ?>" id="forumTitle" aria-describedby="emailHelp" placeholder="Enter Title">
            <?php if($validation->getError('forumTitle')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('forumTitle'); ?>
                    </div>
            <?php }?>
          </div>
          <div class="form-group col-md-2">
            <label for="inputState">From</label>
            <input type="date" class="form-control" min=<?php echo date('Y-m-d'); ?> name="forumFrom" value="<?= set_value('forumFrom') ?>" id="forumFrom" placeholder="">
            <?php if($validation->getError('forumFrom')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('forumFrom'); ?>
                    </div>
            <?php }?>
          </div>
          <div class="form-group col-md-2">
            <label for="inputZip">To</label>
            <input type="date" class="form-control" min=<?php echo date('Y-m-d'); ?> name="forumTo" value="<?= set_value('forumTo') ?>" id="forumTo" placeholder="">
            <?php if($validation->getError('forumTo')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('forumTo'); ?>
                    </div>
            <?php }?>
          </div>
        </div>

        <div class="form-group">
          <label for="forumDate">Start of Posting</label>
          <input type="date" class="form-control" min=<?php echo date('Y-m-d'); ?> name="forumStart" value="<?= set_value('forumStart') ?>" id="forumStart" placeholder="">
          <?php if($validation->getError('forumStart')) {?>
                  <div class='text-danger'>
                    <?= $error = $validation->getError('forumStart'); ?>
                  </div>
          <?php }?>
        </div>
        <div class="form-group">
          <label for="forumTime">Time</label>
          <input type="time" class="form-control" name="forumTime" value="<?= set_value('forumTime')?>" id="forumTime" placeholder="">
          <?php if($validation->getError('forumTime')) {?>
                  <div class='text-danger'>
                    <?= $error = $validation->getError('forumTime'); ?>
                  </div>
          <?php }?>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="inputCity">Location</label>
            <input type="text" class="form-control" id="forumLocation" name="forumLocation"  value="<?= set_value('forumLocation') ?>">
            <?php if($validation->getError('forumLocation')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('forumLocation'); ?>
                    </div>
            <?php }?>

          </div>
          <div class="form-group col-md-4">
            <label for="inputCity">Setting</label>
            <select class="custom-select" id="forumParam" name="forumParam">
              <option selected value="">Choose...</option>
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
          <select class="custom-select" id="forumType" name="forumType">
            <option selected value="">Choose...</option>
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
          <label for="forumDetail">Event details or announcements</label>
          <textarea name="forumDetail" class="form-control" value="<?= set_value('forumDetail') ?>" aria-label="With textarea"><?= set_value('forumDetail') ?></textarea>
        </div>
        <div class="form-group">
          <br>
          <div class="alert alert-primary" role="alert">
            <b>Notice:</b> Please use <b>jpeg/png</b> format for Poster.
          </div>


          <label for="forumType">Event Poster</label><br>
              <input id="forumImage" type="file" name="forumImage">
              <?php if($validation->getError('forumImage')) {?>
                      <div class='text-danger'>
                        <?= $error = $validation->getError('forumImage'); ?>
                      </div>
              <?php }?>
        </div>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
      </form>
    </div>
  </div>
</div>
    </div>
  </div>
</div>

<script type="text/javascript">

</script>
