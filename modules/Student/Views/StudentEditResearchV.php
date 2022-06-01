<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/student">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/student/manage">Manage</a></li>
          <li class="breadcrumb-item"><a href="/OrtacFinal/student/view_research/<?= $research['id']?>">View</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
      <div class="col-lg-12 form-col">
          <h3>Edit Research</h3>

            <?php if($page_session->getTempdata('error')):?>
              <div class="alert alert-danger"><?= $page_session->getTempdata('error');?></div>
            <?php endif; ?>


        <form method="post" action="<?=base_url()?>/student/editResearch/<?=$research['id'] ?>" enctype="multipart/form-data">
        <div class="form-group">
          <label for="inputAddress">Title</label>
            <input type="text" class="form-control" name="title" id="inputAddress" placeholder="" value="<?= $research['title'] ?>">

          </div>
          <div class="form-group">
              <label for="exampleFormControlTextarea1">Abstract</label>
              <textarea class="form-control" name="abstract" id="exampleFormControlTextarea1" rows="3" value="<?= $research['abstract'] ?>"><?= $research['abstract'] ?></textarea>

          </div>
          <div class="form-group">
            <label for="inputAddress">Keyword/s</label>
            <input type="text" class="form-control" name="keyword" id="inputAddress" placeholder="" value="<?= $research['keywords'] ?>">

          </div>

         <div class="form-group">
          <label for="inputAddress2">Author/s</label>
          <?php if(count($author) > 0): ?>
           <select class="form-control selectpicker authorSelect" multiple data-live-search= "true" name="selectedAuthors[]" id="selectedAuthors">
             <?php foreach($author as $a): ?>
                <?php if($a['status'] == 1): ?>
                   <option name="author" value="<?= $a['id']; ?>"> <?= $a['first_name']. " " .$a['last_name']; ?></option>
                <?php endif; ?>
             <?php endforeach; ?>
          </select>

              <?php endif; ?>
        </div>


        <div class="form-group">
          <label for="inputAddress">Adviser</label>
           <?php if(count($adviser) > 0): ?>
            <select name="adviser" class="form-control" name="adviser">
                <option>Choose here...</option>
              <?php foreach($adviser as $a): ?>
                <option name="adviser" value="<?= $a['f_firstname']. " " .$a['f_lastname']; ?>"><?= $a['f_firstname']. " " .$a['f_lastname']; ?></option>
              <?php endforeach; ?>
            </select>
           <?php endif; ?>
        </div>

        <div class="form-row align-items-center">
            <div class="col">
                 <div class="form-group">

                  <?php if($page_session->getTempdata('successPanel')):?>
                      <div class="alert alert-success"><?= $page_session->getTempdata('successPanel');?></div>
                  <?php endif; ?>

                  <?php if($page_session->getTempdata('errorPanel')):?>
                      <div class="alert alert-danger"><?= $page_session->getTempdata('errorPanel');?></div>
                  <?php endif; ?>

                  <label for="selectedPanelist">Panelist/s</label>
                   <?php if(count($panel) > 0): ?>
                   <select class="form-control selectpicker panelSelect" multiple data-live-search= "true" name="selectedPanelist[]" id="selectedPanelist">
                    <?php foreach($panel as $p): ?>
                           <option name="selectedPanelist" value="<?= $p['id']; ?>"><?= $p['f_firstname']. " " .$p['f_lastname']; ?></option>

                     <?php endforeach; ?>
                  </select>
                    <?php endif; ?>
                </div>
                   <span class="text-danger"> <?= display_error($validation, 'selectedPanelist'); ?></span>

            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModalCenter">
                  Add Panelist
                </button>
            </div>
          </div>


        <div class="form-group">
          <label for="inputAddress">Defense Date</label>
          <input type="date" class="form-control" name="defense_date" id="inputAddress" placeholder="yyyy-mm-dd" value="<?= $research['defense_date'] ?>">

        </div>
        <div class="form-group">
          <label for="inputAddress">Date Submitted</label>
          <input type="date" class="form-control" name="date_submitted" id="inputAddress" placeholder="yyyy-mm-dd" value="<?= $research['date_submitted'] ?>">
        </div>
        <hr>

           <p>Current file: <?= $research['file']?></p>
            <div class="input-group mb-3">
                <div class="custom-file">
                   <input id="inputGroupFile02" type="file" name="uploadFile">
                </div>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success mt-5">Update</button>
                </div>
              </div>
            </form>



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
              <form method="post" action="/OrtacFinal/student/editAddPanel/<?= $research['id'] ?>">
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
