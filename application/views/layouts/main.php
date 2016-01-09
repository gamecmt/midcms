<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
	<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<title>MIDCMS</title>
</head>

<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>">MIDCMS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url(); ?>">首页 <span class="sr-only">(current)</span></a></li>
        <?php if ($this->session->userdata('logged_in')): ?>
        <li><a href="<?php echo base_url(); ?>projects">Projects </a></li>
        <?php endif; ?>
        <li><a href="<?php echo base_url(); ?>users/register">注册 </a></li>
      </ul>
      <?php if($this->session->userdata('logged_in')): ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url(); ?>users/logout">退出</a></li>
      </ul>
      <?php endif;?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
	<div class="col-xs-3">
		
		<?php $this->load->view('users/login_view'); ?>

	</div>
	<div class="col-xs-9">

		<?php $this->load->view($main_view); ?>

	</div>
</div>
</body>
</html>