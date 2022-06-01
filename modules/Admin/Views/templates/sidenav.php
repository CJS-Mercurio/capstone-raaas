<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/OrtacFinal./public/css/bootstrap.min.css">
		<link rel="stylesheet" href="/OrtacFinal./public/font-awesome/css/all.css">
		<link rel="stylesheet" href="/OrtacFinal./public/css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
</head>
<body>
  <nav class="main-menu" id="#sidebar">
            <ul>
                <li>
                    <a href="/OrtacFinal/admin">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            Home
                        </span>
                    </a>

                </li>
                <li class="has-subnav">
                    <a href="<?= base_url() ?>/admin/config">
                        <i class="fa fa-laptop fa-2x"></i>
                        <span class="nav-text">
                            Configure
                        </span>
                    </a>

                </li>
             
                <li class="has-subnav">
                    <a href="#">
                       <i class="fa fa-list fa-2x"></i>
                        <span class="nav-text">
                            Generate Reports
                        </span>
                    </a>
                </li>
            </ul>

        </nav>
        <ul class="logout">
          <li>
            <a href="#">
              <i class="fa fa-power-off fa-2x"></i>
              <span class="nav-text">
                Logout
              </span>
            </a>
          </li>
        </ul>
