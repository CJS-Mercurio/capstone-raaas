<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
      <div class="container mt-5">

            <?php if($page_session->getTempdata('success')):?>
              <div class="alert alert-success"><?= $page_session->getTempdata('success');?></div>
            <?php endif; ?>

            <?php if($page_session->getTempdata('error')):?>
              <div class="alert alert-danger"><?= $page_session->getTempdata('error');?></div>
            <?php endif; ?>


       <form method="post" action="<?=base_url()?>/student/upload">
        <div class="form-group">
          <label for="inputAddress">Title</label>
          <input type="text" class="form-control" name="title" id="inputAddress" placeholder="" value="<?= set_value('title') ?>">
          <span class="text-danger"> <?= display_error($validation, 'title'); ?></span>
        </div>
        <div class="form-group">
        <label for="exampleFormControlTextarea1">Abstract</label>
        <textarea class="form-control" name="abstract" id="exampleFormControlTextarea1" rows="3" value="<?= set_value('abstract') ?>"></textarea>
          <span class="text-danger"> <?= display_error($validation, 'abstract'); ?></span>

      </div>
        <div class="form-group">
          <label for="inputAddress">Keyword/s</label>
          <input type="text" class="form-control" name="keyword" id="inputAddress" placeholder="" value="<?= set_value('keyword') ?>">
          <span class="text-danger"> <?= display_error($validation, 'keyword'); ?></span>

        </div>
       <div class="form-group">
          <label for="inputAddress2">Author/s</label>
          <?php if(count($author) > 0): ?>
           <select class="form-control selectpicker authorSelect" multiple data-live-search= "true" name="selectedAuthors[]" id="selectedAuthors">
             <?php foreach($author as $a): ?> 
                   <option name="author" value="<?= $a['id']; ?>"> <?= $a['first_name']. " " .$a['last_name']; ?></option>

             <?php endforeach; ?>
          </select> 
          <span class="text-danger"> <?= display_error($validation, 'author'); ?></span>

              <?php endif; ?>
        </div>

         <div class="form-group">
              <label for="adviser">Adviser</label>
              <div class="form-group mb-3">
                <?php if(count($faculty) > 0): ?>
                <select class="custom-select" id="adviser" name="adviser">
                  <option selected value="">Choose...</option>
                  <?php foreach ($faculty as $a): ?>
                         <option name="adviser" value="<?= $a['f_firstname']. " " .$a['f_lastname']; ?>"><?= $a['f_firstname']. " " .$a['f_lastname']; ?></option>
                  <?php endforeach ?>
                </select>
              <?php endif; ?>
                  <span class="text-danger"> <?= display_error($validation, 'adviser'); ?></span>

              </div>
          </div>

     
        <div class="form-group">
          <?php if($page_session->getTempdata('successPanel')):?>
              <div class="alert alert-success"><?= $page_session->getTempdata('successPanel');?></div>
            <?php endif; ?>

          <?php if($page_session->getTempdata('errorPanel')):?>
              <div class="alert alert-danger"><?= $page_session->getTempdata('errorPanel');?></div>
          <?php endif; ?>
          
        </div>

          <div class="form-row align-items-center">
            <div class="col">
                 <div class="form-group">
                  <label for="inputAddress2">Panelist/s</label>
                   <?php if(count($panel) > 0): ?>
                   <select class="form-control selectpicker panelSelect" multiple data-live-search= "true" name="selectedPanelist[]" id="selectedPanelist">
                    <?php foreach($panel as $p): ?> 
                           <option name="panelist" value="<?= $p['id']; ?>"><?= $p['f_firstname']. " " .$p['f_lastname']; ?></option>

                     <?php endforeach; ?>
                  </select>
                  <span class="text-danger"> <?= display_error($validation, 'panelist'); ?></span>

                    <?php endif; ?>
                </div>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                  Add Panelist
                </button>
            </div>
          </div>


       
        <div class="form-group">
          <label for="inputAddress">Defense Date</label>
          <input type="date" class="form-control" name="defense_date" id="inputAddress" placeholder="yyyy-mm-dd" value="<?= set_value('defense_date') ?>">
          <span class="text-danger"> <?= display_error($validation, 'defense_date'); ?></span>

        </div>
        <div class="form-group">
          <label for="inputAddress">Date Submitted</label>
          <input type="date" class="form-control" name="date_submitted" id="inputAddress" placeholder="yyyy-mm-dd" value="<?= set_value('date_submitted') ?>">
          <span class="text-danger"> <?= display_error($validation, 'date_submitted'); ?></span>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
       <hr>
       
          <?php if($page_session->getTempdata('tama')):?>
            <div class="alert alert-success"><?= $page_session->getTempdata('tama');?></div>
          <?php endif; ?>

          <?php if($page_session->getTempdata('mali')):?>
            <div class="alert alert-danger"><?= $page_session->getTempdata('mali');?></div>
          <?php endif; ?>

       <form action="<?=base_url()?>/student/fileUpload" method="post" enctype="multipart/form-data" class="mt-5">

         <?php if($page_session->getTempdata('rid')):?>
             <?php $rid = $page_session->getTempdata('rid');
              $page_session->setTempdata('file_rid', $rid);?>
          <?php endif; ?>
             
         <label for="inputGroupFile02">Upload Research here</label>
       
        <div class="input-group mb-3">

          <div class="custom-file">
             <input id="inputGroupFile02" type="file" name="uploadFile">
          </div>
          <div class="input-group-append">
           <!--  <span class="input-group-text" id="inputGroupFileAddon02">Upload</span> -->
           <input type="submit" class="btn btn-primary" name="upload_btn" value="Upload">
          </div>
        </div>

       </form>
          <span class="text-danger"> <?= display_error($validation, 'uploadFile'); ?></span>
        <br>


        <!-- Modal for adding panelist -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Panelist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form method="post" action="/OrtacFinal/student/addPanel">
                 <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Firstname</label>
                      <input type="text" class="form-control" name="firstname" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">Lastname</label>
                      <input type="text" class="form-control" name="lastname" id="inputPassword4" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputAddress">Company</label>
                    <input type="text" class="form-control" name="company" id="inputAddress" >
                  </div>
                  <div class="form-group">
                    <label for="inputAddress2">Position</label>
                    <input type="text" class="form-control" name="position" id="inputAddress2">
                  </div>
              </div>
             
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
           </form>
            </div>
          </div>
        </div>
    
        
      
    </div>
  </div>
</div>