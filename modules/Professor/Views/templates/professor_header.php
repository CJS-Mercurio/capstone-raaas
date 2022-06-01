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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
</head>
<body>
  <div id="wrapper">
    <!-- Nav Header -->
    <nav class="navbar navbar-expand-lg sticky-top">
      <div class="col-12 col-sm-1">
      <button type="button" class="hamburger animated fadeInLeft is-open" data-toggle="offcanvas">
          <span class="hamb-top"></span>
          <span class="hamb-middle"></span>
          <span class="hamb-bottom"></span>
      </button>
      </div>
    </nav>
          <!-- Sidebar -->
      <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
       <ul class="nav sidebar-nav">
         <div class="sidebar-header">
           <div class="sidebar-brand">
             <img class="img img-fluid img-responsive" src="/OrtacFinal./public/img/PUPLogo.png">
             <label>RAAS</label>
           </div>
         </div>
         <li>
           <a href="<?= base_url() ?>/professor">
             <i class="fa fa-home fa-2x side-icon"></i>
              <span class="nav-text">
                Home
              </span>
           </a>
         </li>
         <li class="nav-item has-submenu dropdown">
		         <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#"> <i class="fa fa-user-circle side-icon"> </i>
               <span class="nav-text caret"> Profile </span>
            </a>
		        <ul class="submenu collapse">
			         <li><a class="nav-link" href="/OrtacFinal/professor/profile"> Change Password </a></li>
			         <li><a class="nav-link mb-3" href="/OrtacFinal/professor/infoSheet"> Information Sheet </a></li>
  		      </ul>
	       </li>
        <li>
          <a href="<?= base_url() ?>/professor/manage">
            <!-- <i class="fa fa-laptop fa-2x"></i> -->
            <i class="fa fa-book-open side-icon"></i>
             <span class="nav-text">
               Manage Research
             </span>
          </a>
        </li>
          <!-- <li class="nav-item has-submenu">
                 <a class="nav-link dropdown-toggle faculty-menu" data-toggle="dropdown" href="#"> Faculty </a>
                 <ul class="nav navbar-nav">
                     <li><a class="nav-link submenu-item" href="<?=base_url()?>/professor/profSeminar"> Seminars </a></li>
                     <li><a class="nav-link submenu-item" href="<?=base_url()?>/professor/profPubResearch"> Published Researches </a></li>
                 </ul>
               </li> -->
        <li class="logout-btn">
          <a href="/OrtacFinal/logout">
            <i class="fa fa-power-off fa-2x side-icon logout-icon"></i>
            <span class="logout-text">
              Logout
            </span>
          </a>
        </li>
        </ul>
    </nav>
