<?php $page_session = \Config\Services::session();

session_start();
  if (!isset($_SESSION['logged_user']))
  {
      header("Location: login_view");
      die();
  } else {

      header("");
  }
?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">My Documents</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
  <div class="container-fluid form">
    <div class="row">
      <div class="col-lg-12 form-col">
        <h3>My Documents</h3>
        <?php if($page_session->getTempdata('success')):?>
          <div class="alert alert-success"><?= $page_session->getTempdata('success');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('deleted')):?>
           <div class="alert alert-success"><?= $page_session->getTempdata('deleted');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('successDelete')):?>
          <div class="alert alert-success"><?= $page_session->getTempdata('successDelete');?></div>
        <?php endif; ?>

        <?php if($page_session->getTempdata('errorDelete')):?>
           <div class="alert alert-danger"><?= $page_session->getTempdata('errorDelete');?></div>
        <?php endif; ?>
            <div class="tabbable-responsive">
              <div class="tabbable">
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                  <li class="nav-item">
                    <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">To approve</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">To claim voucher</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">Disapproved</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                  <h5 class="card-title">To approve</h5>
                  <h6><i>Waiting for admin approval</i></h6>
                        <table class="table table-bordered table-striped" id="forum-list">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>

                        <?php if($user_research): ?>
                            <?php $ctr = 1; ?>
                            <?php foreach($user_research as $ur): ?>
                              <?php if($ur['deleted_at'] == null && $ur['research_status'] == 1): ?>
                                   <tr>
                                        <td><?php echo $ctr++; ?></td>
                                        <td><?php echo $ur['title']; ?></td>
                                        <td>
                                           <form method="post" action="<?=base_url()?>/research/viewResearch/<?= $ur['id'] ?>">
                                            <button type="submit" class="btn btn-info">View</button>
                                          </form>
                                        </td>

                               </tr>
                             <?php endif; ?>
                           <?php endforeach; ?>
                         <?php endif; ?>

                     </tbody>
                   </table>
                </div>
                <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                  <h5 class="card-title">To Claim Voucher</h5>
                  <h6><i>List of approved researches</i></h6>
                        <table class="table table-bordered table-striped" id="seminar-list">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>

                        <?php if($user_research): ?>
                        <?php $ctr = 1; ?>
                            <?php foreach($user_research as $ur): ?>
                              <?php if($ur['deleted_at'] == null && $ur['research_status'] == 3): ?>
                                   <tr>
                                        <td><?php echo $ctr++; ?></td>
                                        <td><?php echo $ur['title']; ?></td>

                                 <td>
                                   <form method="post" action="<?=base_url()?>/research/viewResearch/<?= $ur['id'] ?>">
                                    <button type="submit" class="btn btn-info"><span class="fa fa-eye"></span></button>
                                  </form>
                                 </td>
                               </tr>
                             <?php endif; ?>
                           <?php endforeach; ?>
                         <?php endif; ?>
                     </tbody>
                   </table>
                </div>
                <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                  <h5 class="card-title">Disapproved</h5>
                  <h6><i>List of disapproved researches</i></h6>
                        <table class="table table-bordered table-striped" id="research-list">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>

                        <?php if($user_research): ?>
                        <?php $ctr = 1; ?>
                            <?php foreach($user_research as $ur): ?>
                              <?php if($ur['deleted_at'] == null && $ur['research_status'] == 2): ?>
                                   <tr>
                                        <td><?php echo $ctr++; ?></td>
                                        <td><?php echo $ur['title']; ?></td>

                                 <td>
                                   <form method="post" action="<?=base_url()?>/research/viewResearch/<?= $ur['id'] ?>">
                                    <button type="submit" class="btn btn-info"><span class="fa fa-eye"></span></button>
                                  </form>
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
          <!-- <button class="btn btn-success upload" type="submit" onclick="document.location = '<?=base_url()?>/research/upload'">
            <i class="fa fa-upload"></i>
          Upload Document</button> -->
    </div>
  </div>
</div>
