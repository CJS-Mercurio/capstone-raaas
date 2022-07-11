<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


      <title>Research Analytics Approval and Archiving System</title>
      <link rel="icon" type="image/x-icon" href="<?=base_url()?>/public/assets/images/logos/logo.png">


      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="<?=base_url()?>/public/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?=base_url()?>/public/css/style2.css">
      <link rel="stylesheet" href="<?=base_url()?>/public/font-awesome/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4.0.5/bootstrap-4.min.css">

      <!-- <link rel="stylesheet" href="/OrtacFinal./public/assets/css/fontawesome.css"> -->
      <!-- CSS -->

  </head>
<body>
    <!-- Nav Headear -->
a

    <nav class="navbar navbar-expand-lg fixed-top" id="navbarResponsive">
      <input type="checkbox" id="check">
      <label for="check">
        <i class="fas fa-bars" id="toggle-btn"></i>
        <i class="fas fa-times" id="cancel"></i>
      </label>
      <div class="navbar-brand">
        <img class="navbar-brand img-fluid img-responsive ml-5" src="<?=base_url()?>/public/assets/images/logos/logo.png">
        <h6 class="navbar-brand navbar-title text-light">R<span class="text-danger">AAA</span>S</h6>
      </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" aria-pressed ="true" href="<?=base_url()?>/home">Home</a>
          </li>
          <?php if($allowed_task): ?>
            <?php foreach($allowed_task as $at): ?>
             <?php if($at['tid'] == 6): ?>
               <?php if($at['deleted_at'] == NULL): ?>
                 <li class="nav-item">
                   <a class="nav-link" href="<?=base_url()?>/research/upload">Upload Document</a>
                 </li>
               <?php endif; ?>
             <?php endif; ?>
           <?php endforeach; ?>
         <?php endif; ?>
          <?php if($allowed_task): ?>
            <?php $roleCheck = 0; $funcCheck = 0; ?>
            <?php foreach($allowed_task as $at): ?>
             <?php if($at['tid'] == 21): ?>
               <?php if($at['deleted_at'] == NULL): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>/research/config">Configure</a>
                  </li>
                <?php endif; ?>
              <?php endif; ?>
              <?php if($at['tid'] == 19): ?>
                <?php if($at['deleted_at'] == NULL): ?>
                  <li class="nav-item">
                    <a class="nav-link text-light" href="<?=base_url()?>/report/reports">Generate Reports</a>
                  </li>
                <?php endif; ?>
               <?php endif; ?>
               <?php if($at['tid'] == 24): ?>
                 <?php if($at['deleted_at'] == NULL): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>/profile/view">Seminars & Completed Researches</a>
                  </li>
                <?php endif; ?>
             <?php endif; ?>
             <?php if($at['tid'] == 12): ?>
               <?php if($at['deleted_at'] == NULL): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>/forum">Forum</a>
                  </li>
                <?php endif; ?>
             <?php endif; ?>
           <?php endforeach; ?>
        <?php endif; ?>
<!-- Created By: Mercurio -->
<!-- Current User -->
         <?php if($current_user): ?>
          <?php if($current_user['role_id'] == 1): ?>
            <div style="margin-left: 200px; padding: 1px; color: maroon;" class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
              <strong>Welcome! Admin</strong>
            </div>
          <?php endif; ?>

          <?php if($current_user['role_id'] == 2): ?>
            <div style="margin-left: 200px; padding: 3px; color: maroon;" class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
              <strong>Welcome! Student</strong>
            </div>
          <?php endif; ?>

          <?php if($current_user['role_id'] == 3): ?>
            <div style="margin-left: 200px; padding: 1px; color: maroon;" class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
              <strong>Welcome! Professor</strong>
            </div>
          <?php endif; ?>

          <?php if($current_user['role_id'] == 4): ?>
            <div style="margin-left: 200px; padding: 1px; color: maroon;" class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
              <strong>Welcome! Faculty</strong>
            </div>
          <?php endif; ?>
        <?php endif; ?>  
<!-- Current User -->
        </ul>           
        <form class="form-inline my-2 my-lg-0 ml-auto">
          <a class="btn btn-outline-light" href="<?=base_url()?>/logout"><i class="fa fa-sign-out-alt"></i> Logout </a>
        </form>
    </nav>



    <div class="container-fluid second-nav">
      <div class="row second-nav-row">
        <div class="col-7">
            <?php if($allowed_task): ?>
              <?php $roleCheck = 0; $funcCheck = 0; ?>
              <?php foreach($allowed_task as $at): ?>
                <?php if($at['tid'] == 6): ?>
                  <?php if($at['deleted_at'] == NULL): ?>
                    <li>
                      <a href="<?= base_url() ?>/research">
                        <i class="far fa-address-book"></i>
                           My Documents
                      </a>
                    </li>
                  <?php endif; ?>
               <?php endif; ?>
               <?php if($at['tid'] == 18): ?>
                 <?php if($at['deleted_at'] == NULL): ?>
                   <li>
                     <a href="<?= base_url()?>/research/analyticsHome">
                       <i class="far fa-chart-bar"></i>
                          Metrics
                     </a>
                   </li>
                 <?php endif; ?>
              <?php endif; ?>
              <?php if($at['tid'] == 2): ?>
                <?php if($at['deleted_at'] == NULL): ?>
                  <li>
                    <a href="<?= base_url()?>/profile/change">
                      <i class="fa fa-cogs"></i>
                         Account Settings
                    </a>
                  </li>
                <?php endif; ?>
             <?php endif; ?>
              <?php if($at['tid'] == 11): ?>
                <?php if($at['deleted_at'] == NULL): ?>
                  <li>
                    <a href="<?= base_url() ?>/research/myLibHome">
                      <i class="far fa-copy"></i>
                         My Library
                    </a>
                  </li>
                <?php endif; ?>
             <?php endif; ?>
              <?php if($at['tid'] == 3): ?>
                <?php if($at['deleted_at'] == NULL): ?>
                  <li>
                    <a href="<?= base_url() ?>/profile/professors">
                      <i class="far fa-user"></i>
                         User Account
                    </a>
                  </li>
                <?php endif; ?>
             <?php endif; ?>
             <?php endforeach; ?>
          <?php endif; ?>
          <li>
          <a href="<?= base_url() ?>/profile/trash">
            <i class="far fa-trash-alt"></i>
               Trash
          </a>
        </li>
        </div>
        <div class="col-5 input-group">
        <?php if($current_user): ?>
          <?php if($current_user['role_id'] == 1): ?>
            <input type="text" class="form-control" onEnter="scan()" name="slug" id="slug" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Research Barcode" required>
              <div class="input-group-prepend">
                <button class="btn btn-success" type="button" id="button-addon2" onclick="scan()">Search</button>
              </div>
            <?php endif; ?>
          <?php endif; ?>
          </div>
      </div>
    </div>
