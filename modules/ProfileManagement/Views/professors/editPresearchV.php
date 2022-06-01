<?php $page_session = \Config\Services::session()?>
<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/profile/professors/seminar">Seminars and Completed Research</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <?php if(session()->getTempdata('successResearch')): ?>
         <div class="alert alert-success">
           <?= session()->getTempdata('successResearch'); ?>
         </div>
        <?php endif; ?>

        <?php if(session()->getTempdata('errorResearch')): ?>
         <div class="alert alert-danger">
           <?= session()->getTempdata('errorResearch'); ?>
         </div>
        <?php endif; ?>

        <?php if($pResearch): ?>
          <form action="<?=base_url()?>/profile/professors/editPresearch/<?=$pResearch['id'] ?>" method="post">
            <div class="form-group">
              <label for="exampleFormControlInput1">Title</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="research_title" value="<?php echo $pResearch['research_title']; ?>">
              <?php if($validation->getError('research_title')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('research_title'); ?>
                    </div>
                <?php }?>
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Abstract</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="14" name="abstract"><?php  echo $pResearch['abstract']; ?></textarea>
              <?php if($validation->getError('abstract')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('abstract'); ?>
                    </div>
                <?php }?>
            </div>

            <div class="form-group">
              <label for="exampleFormControlInput1">School Year</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="school_year" value="<?php echo $pResearch['school_year']; ?>">
              <?php if($validation->getError('school_year')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('school_year'); ?>
                    </div>
                <?php }?>
              <?php if(session()->getTempdata('errorSY')): ?>
               <div class="text-danger">
                 <?= session()->getTempdata('errorSY'); ?>
               </div>
              <?php endif; ?>

            </div>

            <button type="submit" class="btn btn-primary" name="button" style="float: right;">Save changes</button>
          </form>
      <?php endif; ?>
    </div>
  </div>
</div>
