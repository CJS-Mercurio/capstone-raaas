<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
		<link rel="stylesheet" href="<?=base_url()?>/public/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="/OrtacFinal./public/css/style2.css"> -->
		<link rel="stylesheet" href="<?=base_url()?>/public/font-awesome/css/all.css">
		<link rel="stylesheet" href="<?=base_url()?>/public/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/fontawesome.css">

    <title>Research Analytics Approval and Archiving System</title>
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>/public/assets/images/logos/logo.png">

     <style>
      .page-heading{
    	margin-top: -25px;
    	box-sizing: border-box;
    	background-position: center center;
    	background-size: cover;
    	background-image: linear-gradient(to right, rgba(0,0,0, 0.7) 100%, transparent), url("<?=base_url()?>/public/assets/images/bg-library.jpg");
       }
       
       .home-page{
        	margin-top: -25px;
        	box-sizing: border-box;
        	background-position: center center;
        	background-size: cover;
        	background-image: linear-gradient(to right, rgba(0,0,0, 0.7) 100%, transparent), url("<?=base_url()?>/public/assets/images/bg-library.jpg");
        	background-attachment: fixed;
        	height: 95vh;
        }
    </style>

  </head>
  <body>
    <!-- Header -->
    <header>

      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <div class="col-md-12">
            <div class="row">
            <div class="navbar-brand">
                <img src="<?=base_url()?>/public/assets/images/logos/logo.png" alt="">
                <h6 class="navbar-brand navbar-title text-light">R<span class="text-danger">AAA</span>S</h6>
            </div>
              <div class="navbar-nav ml-auto" id="navbarResponsive">
                <ul class="page-btn">
                  <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>/login">Home
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>/about">About Us</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>/metrics">Metrics</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="toggle-btn" onclick="myFunction();">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </nav>
    </header>
