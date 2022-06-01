<?php $page_session = \Config\Services::session()?>
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <div class="container-header">
        <label for="">Upload Research Here</label>
      </div>
          <?php if($page_session->getTempdata('tama')):?>
            <div class="alert alert-success"><?= $page_session->getTempdata('tama');?></div>
          <?php endif; ?>

          <?php if($page_session->getTempdata('mali')):?>
            <div class="alert alert-danger"><?= $page_session->getTempdata('mali');?></div>
          <?php endif; ?>

       <form action="<?=base_url()?>/student/fileUpload" method="post" enctype="multipart/form-data" class="mt-5">
        <div class="input-group mb-3">
          <div class="custom-file">
             <input id="inputGroupFile02" type="file" name="uploadFile">
           <!--  <input type="file" class="custom-file-input" name="uploadFile" id="inputGroupFile02">
            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label> -->
          </div>
          <div class="input-group-append">
           <!--  <span class="input-group-text" id="inputGroupFileAddon02">Upload</span> -->
           <input type="submit" class="btn btn-primary" name="upload_btn" value="Upload">
          </div>
        </div>
       </form>
          <span class="text-danger"> <?= display_error($validation, 'uploadFile'); ?></span>

    </div>
  </div>
</div>
