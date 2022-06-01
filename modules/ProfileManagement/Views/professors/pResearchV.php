<?php $page_session = \Config\Services::session()?>
<?php $validation = \Config\services::validation()?>

<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/profile/view">Seminars and Completed Research</a></li>
          <li class="breadcrumb-item active" aria-current="page">Completed Research View</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <?php if(session()->getTempdata('tama')): ?>
         <div class="alert alert-success">
           <?= session()->getTempdata('tama'); ?>
         </div>
        <?php endif; ?>

        <?php if(session()->getTempdata('mali')): ?>
         <div class="alert alert-danger">
           <?= session()->getTempdata('mali'); ?>
         </div>
        <?php endif; ?>

        <?php if($pResearch): ?>
          <h3><?php echo $pResearch['research_title']; ?></h3>
          <?php if($loggedIn): ?>
              <?php if($loggedIn['role_id'] == 1): ?>
                <?php if($pResearch['publication'] == null): ?>
                    <p>
                      <button class="btn mb-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span class="fa fa-edit"></span>Tag as Published
                      </button>
                    </p>
                    <div class="collapse mb-5 mt-3" id="collapseExample">
                      <div class="card card-body">
                        <form class="" action="<?=base_url()?>/profile/tagPublish/<?=$pResearch['id'] ?>" method="post" enctype="multipart/form-data">
                        <p><b>Date of published</b></p>
                        <input class="form-control form-control-sm mb-4" type="date" placeholder="" name="date_published" required>
                        <?php if($validation->getError('date_published')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('date_published'); ?>
                            </div>
                        <?php }?>
                        <p><b>Refereed Publication</b></p>
                         <input class="form-control form-control-sm mb-4" type="text" placeholder="" name="publication" required>
                         <?php if($validation->getError('publication')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('publication'); ?>
                            </div>
                        <?php }?>
                         <p><b>Volume</b></p>
                          <input class="form-control form-control-sm mb-4" type="text" placeholder="" name="volume" required>
                          <?php if($validation->getError('volume')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('volume'); ?>
                            </div>
                        <?php }?>
                         <p><b>Research URL</b></p>
                          <input class="form-control form-control-sm mb-4" type="text" placeholder="" name="url" required>
                          <?php if($validation->getError('url')) {?>
                            <div class='text-danger'>
                              <?= $error = $validation->getError('url'); ?>
                            </div>
                        <?php }?>
                        <p><b>Insert proof of publication</b></p>
                          <div class="input-group mb-3">
                            <div class="custom-file">
                               <input id="inputGroupFile02" type="file" name="uploadCert" required>
                            </div>
                          </div>
                          <button type="submit" name="button" class="btn btn-primary float-right">
                            <i class="fa fa-upload"></i>
                            Upload
                          </button>
                        </form>
                      </div>
                    </div>
                 <?php else: ?>
                   <p>
                   <button class="btn mb-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                     <span class="fa fa-check"></span>Tag as published
                   </button>
                 </p>
                 <div class="collapse mb-5 mt-3" id="collapseExample">
                   <div class="card card-body">
                     <p><b>Date of publication</b></p>
                    <form class="" action="<?=base_url()?>/profile/updatePublication/<?=$pResearch['id'] ?>" method="post" enctype="multipart/form-data">

                       <input class="form-control form-control-sm mb-4" type="date" value="<?= $pResearch['date_published']?>" name="date_published">
                       <?php if($validation->getError('date_published')) {?>
                           <div class='text-danger'>
                             <?= $error = $validation->getError('date_published'); ?>
                           </div>
                       <?php }?>
                       <p><b>Refereed Publication</b></p>
                        <input class="form-control form-control-sm mb-4" type="text" value="<?= $pResearch['publication']?>" name="publication">
                       <?php if($validation->getError('publication')) {?>
                           <div class='text-danger'>
                             <?= $error = $validation->getError('publication'); ?>
                           </div>
                       <?php }?>
                       <p><b>Volume</b></p>
                        <input class="form-control form-control-sm mb-4" type="text" value="<?= $pResearch['volume']?>" name="volume">
                       <?php if($validation->getError('volume')) {?>
                           <div class='text-danger'>
                             <?= $error = $validation->getError('volume'); ?>
                           </div>
                       <?php }?>
                       <p><b>Research URL</b></p>
                        <input class="form-control form-control-sm mb-4" type="text" value="<?= $pResearch['institute']?>" name="url">
                       <?php if($validation->getError('url')) {?>
                           <div class='text-danger'>
                             <?= $error = $validation->getError('url'); ?>
                           </div>
                       <?php }?>
                     </p>
                     <br>
                     <p><b>Proof of publication</b></p>
                     <img class="mb-4" src="<?=base_url()?>/public/publication/<?= $pResearch['proof_publication'];?>" height="200" width="200">

                       <div class="input-group mb-3">
                         <div class="custom-file">
                            <input id="inputGroupFile02" type="file" name="uploadCert">
                         </div>
                       </div>
                       <?php $id = $pResearch['id']; ?>
                       <button type="submit" name="button" class="btn btn-secondary" style="float: right; ">Update</button>
                       <button type="button" onclick="remove('<?= $id ?>')" class="btn btn-outline-secondary mr-1 float-right">Remove proof</button>

                     </form>
                   </div>
                 </div>
                 <?php endif; ?>
               <?php endif; ?>
             <?php endif; ?>

          <?php  if(isset($pResearch['proof_publication'])): ?>
          <p><i>Refereed Publication: <?php  echo $pResearch['publication']; ?></i></p>
          <br>
          <?php endif; ?>
          
          <?php  if(isset($pResearch['volume'])): ?>
          <p><i>Volume: <?php  echo $pResearch['volume']; ?></i></p>
           <br>
           <?php endif; ?>
          
          <?php  if(isset($pResearch['institute'])): ?>
          <p><i>Research URL: <a href="<?= $pResearch['institute']?>" target= "_blank"> <?php  echo $pResearch['institute']; ?><a/></i></p>
             <br>
           <?php endif; ?>
         
          <?php  if(isset($pResearch['abstract'])): ?>
              <p>Abstract: <?php  echo $pResearch['abstract']; ?></a></p>
              <br>
          <?php endif; ?>
          
          <p><i>School year completed: <?php  echo $pResearch['school_year']; ?></i></p>
          
          <?php  if(isset($pResearch['date_published'])): ?>
          <br>
          <p><i>Date Published <?php  echo $pResearch['date_published']; ?></i></p>
           <?php endif; ?>
           
        <?php endif; ?>
    </div>
  </div>
</div>

<script type="text/javascript">
function remove(id)
{
    if(confirm("Are you sure you want to remove this proof of publication?"))
    {
        window.location.href="<?php echo base_url(); ?>/profile/removeProof/"+id;
    }
    return false;
}

</script>
