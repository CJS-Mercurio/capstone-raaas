<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Research Analytics Approval and Archiving System</title>
    <link rel="icon" type="image/x-icon" href="/OrtacFinal./public/assets/images/logos/logo.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/OrtacFinal./public/css/bootstrap.min.css">
		<link rel="stylesheet" href="/OrtacFinal./public/font-awesome/css/all.css">
		<link rel="stylesheet" href="/OrtacFinal./public/css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
</head>
<body>
    <!-- Nav Header -->
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
      <nav class="navbar navbar-inverse fixed-top sidebar " id="sidebar-wrapper" role="navigation">
       <ul class="nav sidebar-nav">
         <div class="sidebar-header">
           <div class="sidebar-brand">
             <img class="img img-fluid img-responsive" src="/OrtacFinal./public/img/PUPLogo.png">
             <label>RAAS</label>
           </div>
         </div>
         <li>
           <a href="<?= base_url() ?>/student">
             <i class="fa fa-home fa-2x side-icon"></i>
              <span class="nav-text">
                Home
              </span>
           </a>
         </li>
 <?php if($allowed_task): ?>
    <?php foreach($allowed_task as $at): ?>
       <?php if($at['tid'] == 13): ?>
         <li class="nav-item has-submenu dropdown">
		         <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#"> <i class="fa fa-user-circle side-icon"> </i>
               <span class="nav-text caret"> Profile </span>
            </a>
		        <ul class="submenu collapse">
			         <li><a class="nav-link" href="/OrtacFinal/student/profile"> Change Password </a></li>
			         <li><a class="nav-link mb-3" href="/OrtacFinal/student/infoSheet"> Information Sheet </a></li>
  		      </ul>
	       </li>
        <?php endif; ?>
       <?php if($at['tid'] == 4): ?>
        <li>
          <a href="<?= base_url() ?>/student/manage">
            <i class="fa fa-book-open side-icon"></i>
             <span class="nav-text">
               Manage Research
             </span>
          </a>
        </li>
      <?php endif; ?>
      <?php if($at['tid'] == 5): ?>
        <?php if($at['deleted_at'] == NULL): ?>
          <li>
             <a href="">
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
           <li class="nav-item has-submenu dropdown">
               <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#"> <i class="fa fa-list side-icon"> </i>
                   <span class="nav-text caret"> Generate Reports </span>
              </a>
              <ul class="submenu collapse">
                 <li><a class="nav-link" href=""> Dashboard </a></li>
                 <li class="nav-item has-submenu">
                   <a class="nav-link dropdown-toggle faculty-menu" data-toggle="dropdown" href="#"> Faculty </a>
                   <ul class="nav navbar-nav">
                       <li><a class="nav-link submenu-item" href=""> Seminars </a></li>
                       <li><a class="nav-link submenu-item" href=""> Published Researches </a></li>
                   </ul>
                 </li>
                  <li><a class="nav-link mb-3" href="/OrtacFinal/report/reports"> Researches </a></li>
              </ul>
           </li>
      <?php endif; ?>
     <?php endif; ?>
     <?php if($at['tid'] == 8): ?>
       <?php if($at['deleted_at'] == NULL): ?>

         <li>
           <a href="">
             <i class="fa fa-users side-icon"></i>
              <span class="nav-text">
                User Accounts
              </span>
           </a>
         </li>
     <?php endif; ?>
   <?php endif; ?>

          <!-- <?php if($at['tid'] == 2): ?>
           <li class="nav-item has-submenu">
                     <a class="nav-link dropdown-toggle faculty-menu" data-toggle="dropdown" href="#"> Faculty </a>
                     <ul class="nav navbar-nav">
                         <li><a class="nav-link submenu-item" href="<?=base_url()?>/student/profSeminar"> Seminars </a></li>
                         <li><a class="nav-link submenu-item" href="<?=base_url()?>/student/profPubResearch"> Published Researches </a></li>
                     </ul>
                   </li>
         <?php endif; ?> -->
      <?php endforeach; ?>
    <?php endif; ?>

        </ul>
    </nav>
