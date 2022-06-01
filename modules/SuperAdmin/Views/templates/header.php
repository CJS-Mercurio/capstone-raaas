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
		<link rel="stylesheet" href="<?=base_url()?>/public/font-awesome/css/all.css">
		<link rel="stylesheet" href="<?=base_url()?>/public/css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

</head>
<body>
    <!-- Nav Header -->
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
            <a class="nav-link" aria-pressed ="true" href="<?=base_url()?>/superadmin">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-pressed ="true" href="<?= base_url() ?>/superadmin/department">Department</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-pressed ="true" href="<?= base_url() ?>/superadmin/form">Forms</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-pressed ="true" href="<?= base_url() ?>/superadmin/role">Roles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " aria-pressed ="true" href="<?= base_url() ?>/superadmin/module">Modules</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " aria-pressed ="true" href="<?= base_url() ?>/superadmin/permission">Permissions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " aria-pressed ="true" href="<?= base_url() ?>/superadmin/userAccount">User Accounts</a>
          </li>
           <li class="nav-item">
            <a class="nav-link " aria-pressed ="true" href="<?= base_url() ?>/profile/activity">Audit Trail</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 ml-auto">
          <a class="btn btn-outline-light" href="<?= base_url() ?>/logout"><i class="fa fa-sign-out-alt"></i> Logout </a>
        </form>
    </nav>
