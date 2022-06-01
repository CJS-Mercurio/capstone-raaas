<?php $page_session = \Config\Services::session()?>
<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/research">My Documents</a></li>
          <li class="breadcrumb-item active" aria-current="page">Research</li>
          <li class="breadcrumb-item active" aria-current="page">Edit Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
      <div class="col-lg-12 form-col">
        <h3>Edit Document</h3>


            <?php if($page_session->getTempdata('error')):?>
              <div class="alert alert-danger"><?= $page_session->getTempdata('error');?></div>
            <?php endif; ?>

            <?php if($page_session->getTempdata('success')):?>
              <div class="alert alert-success"><?= $page_session->getTempdata('success');?></div>
            <?php endif; ?>

            <?php if($page_session->getTempdata('tama')):?>
              <div class="alert alert-success"><?= $page_session->getTempdata('tama');?></div>
            <?php endif; ?>

            <?php if($page_session->getTempdata('mali')):?>
              <div class="alert alert-danger"><?= $page_session->getTempdata('mali');?></div>
            <?php endif; ?>



        <div class="alert alert-warning" role="alert">
          <b>Warning: </b>Fields with asterisk (*) are required.
        </div>


       <form method="post" action="<?=base_url()?>/research/editResearch/<?=$research['id'] ?>" enctype="multipart/form-data">
         <div class="form-row">
           <div class="form-group col-8">
               <label for="inputAddress">Title<span class="text-danger"><b>*</b></span></label>
                 <input type="text" class="form-control" name="title" id="inputAddress" placeholder="" value="<?= $research['title'] ?>">
                 <?php if($validation->getError('title')) {?>
                       <div class='text-danger'>
                         <?= $error = $validation->getError('title'); ?>
                       </div>
                   <?php }?>
           </div>

           <div class="form-group col-4">
             <label for="inputPassword4">Document Type<span class="text-danger"><b>*</b></span></label>
              <?php if(count($type) > 0): ?>
                       <select class="custom-select" id="paper_type" name="paper_type">
                         <?php foreach ($type as $pt): ?>

                           <?php if($pt['id'] == $research['document_type_id']): ?>
                             <option selected value="<?= $pt['id']; ?>"><?= $pt['type']; ?></option>
                           <?php endif; ?>

                                <option name="paper_type" value="<?=$pt['id']; ?>"><?=$pt['type']; ?></option>
                         <?php endforeach ?>
                       </select>
                     <?php endif; ?>
                     <?php if($validation->getError('paper_type')) {?>
                           <div class='text-danger'>
                             <?= $error = $validation->getError('paper_type'); ?>
                           </div>
                       <?php }?>
           </div>
         </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Abstract<span class="text-danger"><b>*</b></span></label>
          <textarea class="form-control" name="abstract" id="exampleFormControlTextarea1" rows="3" value="<?= $research['abstract'] ?>"><?= $research['abstract'] ?></textarea>
              <?php if($page_session->getTempdata('errorAbs')):?>
                <div class="text-danger"><?= $page_session->getTempdata('errorAbs');?></div>
              <?php endif; ?>
          </div>

          <hr class="mt-5">
          <div class="form-group">
            <label for="inputAddress">Keyword/s<span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="keyword" id="inputAddress" placeholder="" value="<?= $research['keywords'] ?>">
            <?php if($validation->getError('keyword')) {?>
                  <div class='text-danger'>
                    <?= $error = $validation->getError('keyword'); ?>
                  </div>
              <?php }?>
              <?php if($page_session->getTempdata('errorKey')):?>
                  <div class="text-danger"><?= $page_session->getTempdata('errorKey');?></div>
              <?php endif; ?>
          </div>

          <div class="form-group">
                 <label for="category">Subject - Topical Term</label>
                 <div class="form-group mb-3">
                  <?php if($category): ?>
                   <select class="custom-select" id="category" name="category">
                     <option selected value="">Choose...</option>
                     <?php foreach ($category as $c): ?>
                       <?php if($c['category'] == $research['category_id']): ?>
                         <option selected value="<?= $c['category']; ?>"><?= $c['category']; ?></option>
                      <?php endif; ?>

                         <?php if($c['deleted_at'] == NULL): ?>
                              <option name="category" value="<?= $c['category']; ?>" <?= set_select('category', $c['category']) ?>><?= $c['category']; ?></option>
                         <?php endif;  ?>
                     <?php endforeach ?>
                   </select>
                 <?php else: ?>
                   <select class="custom-select" id="category" name="category">
                     <option value="">No data found</option>
                   </select>
                 <?php endif; ?>
                 <?php if($validation->getError('category')) {?>
                       <div class='text-danger'>
                         <?= $error = $validation->getError('category'); ?>
                       </div>
                   <?php }?>

                 </div>
             </div>


        <div class="form-group">
               <label for="course">Course<span class="text-danger"><b>*</b></span></label>
               <div class="form-group mb-3">
                 <?php if(count($course) > 0): ?>
                 <select class="custom-select" id="course" name="course">
                 <?php foreach ($course as $c): ?>
                   <?php if($c['id'] == $research['course_id']): ?>
                     <option selected value="<?= $c['id']; ?>"><?= $c['course_name']; ?></option>
                   <?php endif; ?>

                     <?php if($c['deleted_at'] == NULL): ?>
                          <option name="course" value="<?= $c['id']; ?>" <?= set_select('course', $c['id']) ?>><?= $c['course_name']; ?></option>
                     <?php endif;  ?>
                   <?php endforeach ?>
                 </select>
               <?php endif; ?>
               <?php if($validation->getError('course')) {?>
                     <div class='text-danger'>
                       <?= $error = $validation->getError('course'); ?>
                     </div>
                 <?php }?>

               </div>
           </div>


       <hr class="mt-5">
       <div class="form-group">
              <label for="adviser">Adviser</label>
              <div class="form-group mb-3">
                <?php if(count($faculty) > 0): ?>
                <select class="custom-select" id="adviser" name="adviser">
                  <?php foreach ($faculty as $a): ?>

                    <?php if($a['id'] == $research['adviser']): ?>
                      <option selected value="<?= $a['id']; ?>"><?= $a['first_name']. " " .$a['last_name']; ?></option>
                    <?php endif; ?>

                    <?php if($a['deleted_at'] == NULL): ?>
                         <option name="adviser" value="<?= $a['id']; ?>" <?= set_select('adviser', $a['id']) ?>><?= $a['first_name']. " " .$a['last_name']; ?></option>
                    <?php endif;  ?>
                  <?php endforeach ?>
                </select>
              <?php endif; ?>
              <?php if($validation->getError('adviser')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('adviser'); ?>
                    </div>
                <?php }?>

              </div>
          </div>

          <div class="form-row align-items-center">
            <div class="col">
                 <div class="form-group">
                   <?php if($page_session->getTempdata('successAuthor')):?>
                       <div class="alert alert-success"><?= $page_session->getTempdata('successAuthor');?></div>
                   <?php endif; ?>

                   <?php if($page_session->getTempdata('errorAuthor')):?>
                       <div class="alert alert-danger"><?= $page_session->getTempdata('errorAuthor');?></div>
                   <?php endif; ?>

                   <label for="selectedAuthors">Author/s<span class="text-danger"><b>*</b></span></label>
                   <?php if($author): ?>
                    <select class="form-control selectpicker authorSelect" multiple data-live-search= "true" name="selectedAuthors[]" id="selectedAuthors">
                      <?php foreach($author as $u): ?>
                        <?php if($u['first_name'] && $u['last_name']): ?>
                            <option name="selectedAuthors" value="<?= $u['id']; ?>" <?= set_select('selectedAuthors', $u['id']) ?>> <?= $u['first_name']. " " .$u['last_name']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                   </select>
                       <?php endif; ?>
                </div>
                <?php if($validation->getError('selectedAuthors')) {?>
                      <div class='text-danger'>
                        <?= $error = $validation->getError('selectedAuthors'); ?>
                      </div>
                  <?php }?>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModalCenterAuthor">
                  Add Author
                </button>
            </div>
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
                      <?php if($p['deleted_at'] == NULL): ?>
                           <option name="selectedPanelist" value="<?= $p['id']; ?>"><?= $p['first_name']. " " .$p['last_name']; ?></option>
                      <?php endif; ?>
                     <?php endforeach; ?>
                  </select>
                    <?php endif; ?>
                </div>
                <?php if($validation->getError('selectedPanelist')) {?>
                      <div class='text-danger'>
                        <?= $error = $validation->getError('selectedPanelist'); ?>
                      </div>
                  <?php }?>
            </div>

            <div class="col-auto">
                <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModalCenter">
                  Add Panelist
                </button>
            </div>
          </div>

        <hr class="mt-5">
        <div class="form-group">
          <label for="inputAddress">Defense Date</label>
          <input type="date" class="form-control" name="defense_date" id="inputAddress" placeholder="yyyy-mm-dd" value="<?= $research['defense_date'] ?>">
          <?php if($validation->getError('defense_date')) {?>
                <div class='text-danger'>
                  <?= $error = $validation->getError('defense_date'); ?>
                </div>
            <?php }?>

        </div>
        <div class="form-group">
          <label for="inputAddress">Date Submitted<span class="text-danger"><b>*</b></span></label>
          <input type="date" class="form-control" name="date_submitted" id="inputAddress" placeholder="yyyy-mm-dd" value="<?= $research['date_submitted'] ?>">
          <?php if($validation->getError('date_submitted')) {?>
                <div class='text-danger'>
                  <?= $error = $validation->getError('date_submitted'); ?>
                </div>
            <?php }?>

        </div>
       <hr class="mt-5">

          <div class="alert alert-primary" role="alert">
            <b>Notice: </b>Please use <b>pdf</b> format for Research File, Journal and Monograph.
          </div>

                    <p>Current research file: <?= $research['file']?></p>
                      <div class="input-group mb-3">
                          <div class="custom-file">
                              <input id="inputGroupFile02" type="file" name="uploadFile">
                            </div>
                          </div>
                          <?php if($validation->getError('uploadFile')) {?>
                                <div class='text-danger'>
                                  <?= $error = $validation->getError('uploadFile'); ?>
                                </div>
                            <?php }?>
                      <p>Current full paper: <?= $research['full_paper']?></p>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input id="inputGroupFile02" type="file" name="uploadFull">
                              </div>
                              <div class="input-group-append">
                                <button type="submit" class="btn btn-success mt-5">Update</button>
                              </div>
                            </div>
                            <?php if($validation->getError('uploadFull')) {?>
                                  <div class='text-danger'>
                                    <?= $error = $validation->getError('uploadFull'); ?>
                                  </div>
                              <?php }?>
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
              <form method="post" action="<?=base_url()?>/research/editAddPanel/<?= $research['id'] ?>">
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
                    <label for="inputAddress">Occupation</label>
                    <input type="text" class="form-control" name="occupation" id="inputAddress" >
                  </div>
                  <div class="form-group">
                    <label for="inputAddress2">Company</label>
                    <input type="text" class="form-control" name="company" id="inputAddress2">
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

        <!-- Modal for adding Author -->
        <div class="modal fade" id="exampleModalCenterAuthor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size: 15px; "><i>*Add authors which are not a student or professor in the University</i></p>
                <br>
                <form method="post" action="<?=base_url()?>/research/editAddAuthor/<?= $research['id'] ?>">
                  <div class="form-group">
                    <label for="inputAddress">Firstname</label>
                    <input type="text" class="form-control" name="firstname" id="inputAddress" >
                  </div>
                  <div class="form-group">
                    <label for="inputAddress2">Middlename</label>
                    <input type="text" class="form-control" name="middlename" id="inputAddress2">
                  </div>
                  <div class="form-group">
                    <label for="inputAddress2">Lastname</label>
                    <input type="text" class="form-control" name="lastname" id="inputAddress2">
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
