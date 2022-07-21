<?php $page_session = \Config\Services::session()?>
<?php $validation = \Config\services::validation()?>
<!-- Page Content -->
<div class="home-page">
  <div class="container">
    <div class="row">
      <div class="col-md-12 welcome-col">
        <h2>Welcome to</h2>
        <h1>Research Analytics Approval and Archiving System</h1>
        <a href="#announcement" type="button" class="btn btn-outline-light mt-3 learn-more" name="button"><i class="far fa-bell"></i> ANNOUNCEMENTS </a>
        <a href="#researches" type="button" class="btn btn-outline-light mt-3 learn-more" name="button"><i class="far fa-folder-open"></i> RESEARCHES </a>
      </div>
    </div>
    <div class="login-wrap ml-auto">
      <div class="login-html">
        <h3 class="sign-in-title">Sign in as:</h3>


        <?php if(session()->getTempdata('success')): ?>
           <div class="text-success"><?= session()->getTempdata('success'); ?></div>
        <?php endif;?>

        <?php if(session()->getTempdata('successChange')): ?>
           <div class="text-success" style="height: 30px;"><?= session()->getTempdata('successChange'); ?></div>
        <?php endif;?>
 
        <form class="form-login" action="<?=base_url()?>/loginV" method="post">
          <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Student</label>
          <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Faculty</label>
          <div class="login-form">
            <!-- STUDENT -->
            <div class="sign-in-htm">
              <div class="group">
                  <?php if(session()->getTempdata('error')): ?>
                   <div class="text-danger"><?= session()->getTempdata('error'); ?></div>
                   <br>
                <?php endif;?>
                
                <label for="user" class="label">Student No.</label>
                <input type="text" class="input" name="username" id="username" value="<?= set_value('username') ?>" required>
                <?php if($validation->getError('username')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('username'); ?>
                    </div>
                <?php }?>
              </div>
              <div class="group">
                <label for="password" class="label">Password</label>
                <input id="password" name="password" type="password" class="input" data-type="password" required>
                <?php if($validation->getError('password')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('password'); ?>
                    </div>
                <?php }?>
               
              </div>
                <div class="group mb-3" style="float: right;">
                <a href="<?=base_url()?>/forgot_pass">Forgot Password</a>
              </div>
              <div class="group mt-3">
                <input type="submit" class="button" value="Sign In" >
              </div>
            </div>
          </form>
            <!-- PROFESSOR -->
            <form class="form-login" action="<?=base_url()?>/login_faculty" method="post">
            <div class="sign-up-htm">
              <div class="group">
                <?php if(session()->getTempdata('error')): ?>
                   <div class="text-danger"><?= session()->getTempdata('error'); ?></div>
                   <br>
                <?php endif;?>
                <label for="user" class="label">Faculty Code</label>
                <input type="text" class="input" name="username1" id="username1" value="<?= set_value('username') ?>" required>
                <?php if($validation->getError('username1')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('username1'); ?>
                    </div>
                <?php }?>
              </div>
              <div class="group">
                <label for="password" class="label">Password</label>
                <input id="password" name="password1" type="password" class="input" data-type="password" required>
                <?php if($validation->getError('password1')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('password1'); ?>
                    </div>
                <?php }?>
              </div>
              <div class="group mb-3" style="float: right;">
                <a href="<?=base_url()?>/forgot_pass">Forgot Password</a>
              </div>
              <div class="group mt-3">
                <input type="submit" class="button" value="Sign In" >
              </div>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>

  </div>

<!-- Banner Ends Here -->
<div class="scroll-down">
  <a href="#announcement">
    <i class="fa fa-arrow-down"></i>
  </a>
</div>

<section class="section" id="announcement">
  <div class="container-fluid">
    <h4 class="announcement-title mb-4"> <i class="far fa-bell"></i> Announcements</h4>
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-title">
            <h4>Conferences, Trainings and Seminars</h4>
          </div>
          <div class="card-body">
            <table class = "table" id = "forum-list">
              <?php $bool = false; ?>
              <?php if($forum_view): ?>
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($forum_view)):?>
                    <center>
                      <h6>
                        <i>No Available Content</i>
                      </h6>
                    </center>
                  <?php else: ?>

                  <?php endif;?>
                  <?php foreach($forum_view as $f): ?>
                    <?php $current = date("Y-m-d h:i:sa"); ?>

                    <?php if($f['status'] == 3): ?>
                      <?php if($f['deleted_at'] == NULL && $current < $f['dateTo']): ?>
                        <?php $bool = true; ?>
                        <tr>
                          <td>
                            <h6 class="forumTitle">
                              <b>
                                <a href="<?=base_url()?>/viewGuestForum/<?= $f['id']; ?>"><?php echo $f['title']; ?></a>
                              </b>
                            </h6>
                          </td>
                          <?php $f=strtotime($f['dateFrom']) ?>
                          <?php $from = date("M-d-Y", $f); ?>
                          <td>
                            <h6>
                              <?php echo $from; ?></td>
                            </h6>
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
        <div class="col-sm-6">
          <div class="card">
            <div class="card-title">
              <h4>
                Schedule of Uploading
              </h4>
            </div>
            <div class="card-body">
              <table class = "table" id = "other-list">
                <?php if($course_sched): ?>
                  <thead>
                    <tr>
                      <th>Course</th>
                      <th>Schedule</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach($course_sched as $cs): ?>

                      <tr>
                        <td>
                            <h6 class="course">
                              <b>
                                <?php echo $cs['course_name']; ?>
                              </b>
                            </h6>
                        </td>
                        <?php $f=strtotime($cs['dateFrom']); $t=strtotime($cs['dateTo']); ?>

                        <?php $from = date("M-d-Y", $f); $to = date("M-d-Y", $t);?>
                        <td>
                          <h6>
                            <?php echo $from. " to ". $to; ?></td>
                          </h6>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
<section class="section" id="researches">
  <div class="container-fluid research-container">
    <h4 class="researches-title mb-4"><i class="far fa-folder-open"></i> Researches</h4>
    <div class="row">
      <div class="card">
        <div class="card-title">
          <h4>List of Researches</h4>
        </div>
        <div class="card-body">
          <table class="table table-responsive" id="research-list">
            <thead>
              <tr>
                <td>List of Research</td>
              </tr>
            </thead>
            <tbody class="research-body">


           <?php if($document): ?>
               <?php foreach($document as $r): ?>
                 <?php if($r['research_status'] == 3 && $r['deleted_at'] == null): ?>
                 <tr>
                    <td>
                      <div class="row">
                        <div class="col-10">
                          <h5 class="researchTitle">
                            <a href="<?=base_url()?>/guest_view/<?= $r['did']?>"> <?php echo $r['title']; ?></a>
                          </h5>
                        </div>
                        <div class="col-2 text-primary">
                          <h6 class="document-type"><b> <?php echo "[" . $r['type']. "]"?></b></h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <b>
                            <h6 class="text-success"><?php echo $r['course_name']; ?></h6>
                          </b>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <?php if(empty($r['abstract'])): ?>
                            <i>
                              <h6 class="text-secondary">No abstract available</h6>
                            </i>
                          <?php else: ?>
                            <h6 class="abstract"><?php echo mb_strimwidth($r['abstract'], 0, 150, "...") ?></h6>
                          <?php endif; ?>
                          <p>
                              <i>
                                <?php if($r['keywords']): ?>
                                <b>Keywords: </b><?php echo $r['keywords']; ?>
                                <?php else: ?>
                                <b>Keywords: </b>Not Available
                                <?php endif; ?>
                              </i>
                          </p>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col text-primary">
                            <h6>
                              <?php echo $r['category_id']; ?>
                              <!-- <?php if(!empty($r['downloads'])):?>
                                <?php $count = 0; ?>
                                  <?php if($v['research_status'] == 3): ?>
                                    Cited
                                    <?php $count += 1; ?>
                                    <?php echo $count; ?>
                                  <?php endif; ?>
                              <?php else:?>
                                Not yet cited
                              <?php endif;?> -->
                              <b> | </b> S.Y. <?php echo $r['school_year'];?>
                            </h6>
                        </div>
                      </div>

                    </td>
                </tr>
                 <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>

        </tbody>
      </table>
        </div>
      </div>
    </div>
  </div>
</section>
