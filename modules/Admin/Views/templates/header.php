<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/OrtacFinal./public/css/bootstrap.min.css">
		<link rel="stylesheet" href="/OrtacFinal./public/font-awesome/css/all.css">
		<link rel="stylesheet" href="/OrtacFinal./public/css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

</head>
<body>

  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="search-container">
      <div class="row">
           <div class="span12">
              <form id="custom-search-form" class="form-search form-horizontal pull-right">
              <div class="input-append span12">
                  <input type="text" class="search-query" placeholder="Search">
                  <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                  <a class="button logout" href="/OrtacFinal/logout">Logout </a>
              </div>
            </form>
          </div>
        </div>
      </div>
  </nav>
          <!-- Sidebar -->
      <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
       <ul class="nav sidebar-nav">
         <div class="sidebar-header">
           <div class="sidebar-brand">

           </div>
         </div>
         <li>
           <a href="/OrtacFinal/admin">
             <i class="fa fa-home side-icon"></i>
              <span class="nav-text">
                Home
              </span>
           </a>
         </li>
         <?php if($allowed_task): ?>
           <?php foreach($allowed_task as $at): ?>
            <?php if($at['tid'] == 5): ?>
                <?php if($at['deleted_at'] == NULL): ?>
                  <li>
                     <a href="<?= base_url() ?>/admin/config">
                       <i class="fa fa-cogs side-icon"></i>
                        <span class="nav-text">
                            Configure
                        </span>
                     </a>
                   </li>
                 <?php endif; ?>
              <?php endif; ?>

            <?php if($at['tid'] == 6): ?>
              <?php if($at['deleted_at'] == NULL): ?>

                   <li class="nav-item has-submenu">
          		         <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#"> <i class="fa fa-list side-icon"> </i>
                           <span class="nav-text caret"> Generate Reports </span>
                      </a>
          		        <ul class="submenu collapse">
          			         <li><a class="nav-link" href="/OrtacFinal/admin/reportDashboard"> Dashboard </a></li>
          			         <li class="nav-item has-submenu">
                           <a class="nav-link dropdown-toggle faculty-menu" data-toggle="dropdown" href="#"> Faculty </a>
                           <ul class="nav navbar-nav">
                               <li><a class="nav-link submenu-item" href="<?=base_url()?>/admin/profSeminar"> Seminars </a></li>
                               <li><a class="nav-link submenu-item" href="<?=base_url()?>/admin/profPubResearch"> Published Researches </a></li>
                           </ul>
                          <li><a class="nav-link mb-3" href="/OrtacFinal/admin/reports"> Researches </a></li>
            		      </ul>
          	       </li>
              <?php endif; ?>
           <?php endif; ?>

           <?php if($at['tid'] == 8): ?>
             <?php if($at['deleted_at'] == NULL): ?>

               <li>
                 <a href="<?= base_url() ?>/admin/userRequest">
                   <i class="fa fa-users side-icon"></i>
                    <span class="nav-text">
                      User Accounts
                    </span>
                 </a>
               </li>
             <?php endif; ?>
           <?php endif; ?>

           <?php if($at['tid'] == 13 || $at['tid'] == 14): ?>
             <?php if($at['deleted_at'] == NULL): ?>
                <?php if($roleCheck != 1): ?>
                   <?php $roleCheck = 1; ?>
                   <li class="nav-item has-submenu dropdown">
                      <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#"> <i class="fa fa-user-circle side-icon"> </i>
                         <span class="nav-text caret"> Profile </span>
                      </a>
                     <ul class="submenu collapse">
                     <?php if($at['tid'] == 13): ?>
                        <li><a class="nav-link" href=""> Change Password </a></li>
                     <?php endif; ?>
                     <?php if($at['tid'] == 14): ?>
                        <li><a class="nav-link mb-3" href=""> Information Sheet </a></li>
                     <?php endif; ?>
                     </ul>
                  </li>
               <?php endif; ?>
             <?php endif; ?>
          <?php endif; ?>

           <?php if($at['tid'] == 4): ?>
             <?php if($at['deleted_at'] == NULL): ?>
                 <li>
                   <a href="">
                     <i class="fa fa-users side-icon"></i>
                      <span class="nav-text">
                        Manage Research
                      </span>
                   </a>
                 </li>
               <?php endif; ?>
          <?php endif; ?>

       <?php endforeach; ?>
  <?php endif; ?>
          </ul>
    </nav>
