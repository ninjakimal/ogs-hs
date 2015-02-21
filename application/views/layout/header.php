<?php

$controller = $this->uri->segment(1, null);
$method = $this->uri->segment(2, null);
$username = $this->session->userdata('session_user');
$role = $this->session->userdata('session_role');
$sidebar_state = $this->session->userdata('sidebar_state');
$session_photo = $this->session->userdata('user_photo');
$uploads_folder = 'uploads';
$session_full_name = $this->session->userdata('session_full_name');
$data = array(
    'session_photo' => $session_photo,
    'uploads_folder' => $uploads_folder, 
    //'user_photo_url' => $session_photo,
    'full_name' => $session_full_name,
    'role' => $role,
    'controller' => $controller,
    'method' => $method,
    );

if($method == 'edit'){
    $edit_method = true;
}else{
    $edit_method = false;
}

if($method == 'view'){
    $view_method = true;
}else{
    $view_method = false;
}

$document_type = $controller;
$id = $this->uri->segment(3, '');
$view_url = base_url($document_type.'/view/'.$id);

$current_url = current_url();

$search_data = $this->session->userdata( 'search_data' );
?>


<!doctype html>
<!--[if IE 8]>         <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9"> <![endif]-->

<!--[if IE ]>
   <html class="ie">
   <![endif]-->
   <html class="ie">
   <!-- Meta, title, CSS, favicons, etc. -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <title>HS OGS</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width">
   <link rel="icon" type="image/png" href="<?php echo base_url('theme/assets/img/favicon.ico'); ?>">

   <?php $this->load->view('layout/header-scripts'); ?>
</head>


<body class="<?php echo $sidebar_state; ?>">

    <header>
        <div id="banner" class="container-fluid-md">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="banner-title">SPC Online Grading System</h2>
                </div>
            </div>
        </div>
        <div id="navbar-hs" class="navbar navbar-default">
          <div class="container">
            <div class="navbar-collapse collapse" id="navbar-main">
              <ul class="nav navbar-nav">
                <li>
                  <a href="<?php echo base_url('user/profile'); ?>"><i class="fa fa-info-circle"></i> Profile</a>
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-book"></i> Subjects <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="<?php echo base_url('subject'); ?>"><i class="fa fa-male"></i> Add Subject</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('subject/assign-subject-grade-level'); ?>"><i class="fa fa-male"></i> Assign Subject to Grade Level</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('curiculum/offer-subject'); ?>"><i class="fa fa-male"></i> Offer Subject</a>
                    </li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-male"></i> Instructors <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="<?php echo base_url('teacher'); ?>"><i class="fa fa-male"></i> Add Instructor</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('teacher/assign-project'); ?>"><i class="fa fa-male"></i> Assign Project</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('teacher/assign-quiz'); ?>"><i class="fa fa-male"></i> Assign Quiz</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('teacher/assign-recitation'); ?>"><i class="fa fa-male"></i> Assign Recitation</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('curiculum/assign-instructor'); ?>"><i class="fa fa-male"></i> Assign Instructors</a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="<?php echo base_url('student'); ?>"><i class="fa fa-users"></i> Students</a>
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-plus"></i> Assign <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="<?php echo base_url('curiculum/add-section'); ?>"><i class="fa fa-male"></i> Add Section</a>
                    </li>
                  </ul>
                </li>
                
                
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-cog"></i> Curiculum <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('curiculum'); ?>">Manage Curiculum</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="<?php echo base_url('user/profile'); ?>"><i class="fa fa-user"></i> Welcome <?php echo $username; ?></a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a>
                </li>
              </ul>

            </div>
          </div>
        </div>
    </header>


            <div class="page-wrapper">

                <?php //$this->load->view('layout/sidebar', $data); ?>

                <div class="page-content">

                    <div class="container">


