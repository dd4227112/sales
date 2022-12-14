<?php include('log.php');
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="<?php echo base_url();?>images/system_icon.png">

  <title>Sale Record Management System</title>

  <!-- Bootstrap CSS -->
  <!-- Bootstrap CSS -->
  <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="<?php echo base_url();?>css/bootstrap-theme.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/elegant-icons-style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>fontawesome/css/all.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>DataTables/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/widgets.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/style-responsive.css" rel="stylesheet">
  <script src="<?php echo base_url();?>js/jquery-1.8.3.min.js"></script>
  <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>js/scripts.js"></script>
  <script type="text/javascript" src="<?php echo base_url()?>DataTables/js/jquery.dataTables.min.js"></script>
  <!-- <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
  <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" /> -->

</head>

<body>
  <!-- container section start -->
  <section id="container" class="">


    <nav class="header dark-bg">
 	<!-- <nav class="navbar navbar-expand-sm dark-bg"> -->
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="<?php echo base_url();?>index.php/Welcome/home" class="logo">SR <span class="lite">MS</span></a>
      <!--logo end-->

      <div class="top-nav notification-row">
        <ul class="nav pull-right top-menu">
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt=""  width="30px" height="30px" src="<?php echo base_url();?>images/system_icon.png">
                            </span>
                            <span class="username"><?php echo $this->session->userdata('name');?></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li>
                <a href="<?php echo base_url();?>index.php/Welcome/Change_password"><i class="icon_profile"></i>Change password</a>
              </li>         
              <li>
                <a href="<?php echo base_url();?>index.php/Welcome/Logout"><i class="fas fa-power-off"></i> Log Out</a>
              </li>
            </ul>
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </nav>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li>
            <a class="" href="<?php echo base_url();?>index.php/Welcome/home">
                          <i class="icon_cart_alt"></i>
                          <span>Products</span>
                      </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Report</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="<?php echo base_url();?>index.php/Welcome/Today_report">Today's report</a></li>
              <li><a class="specific_report" href="javascript:;">Specific day report</a></li>
              <li><a class="duration_report" href="javascript:;">Periodic report</a></li>

            </ul>
          </li>
          <li> 
            <a class="" href="<?php echo base_url();?>index.php/Welcome/Services">
                          <i class="fa fa-undo-alt"></i>
                          <span>Other Services</span>
                      </a>
          </li>
          <li>
            <a class="" href="<?php echo base_url();?>index.php/Welcome/mkopo">
                          <i class="fa fa-landmark"></i>
                          <span>Loans</span>
                      </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_profile"></i>
                          <span>Account</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="<?php echo base_url();?>index.php/Welcome/Change_password">Change Password</a></li>
              <li><a class="" href="<?php echo base_url();?>index.php/Welcome/Logout">Logout</a></li>
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
          <section class="panel">

