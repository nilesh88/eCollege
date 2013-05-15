<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Project name</title>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url() . 'assets/css/bootstrap.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url() . 'assets/css/font-awesome.min.css'; ?>">
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo site_url() . 'assets/css/font-awesome-ie7.css'; ?>">
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url() . 'assets/css/style.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url() . 'assets/css/bootstrap-responsive.css'; ?>">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url() . 'assets/js/bootstrap.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo site_url() . 'assets/js/holder.js'; ?>"></script>
</head>
<body>
	<div id="wrap">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="<?php echo site_url() . 'home'; ?>">Project name</a>
					<div class="nav-collapse collapse">
						<ul class="nav pull-right">
							<li><a href="#">Browse Items</a></li>
							<?php if (!$this->session->userdata('logged_in')): ?>
								<li><a href="<?php echo site_url() . 'login'; ?>">Sign in</a></li>
							<?php else: ?>
								<li><a href="<?php echo site_url() . 'members'; ?>"><?php echo sprintf('%s %s', $this->session->userdata('FirstName'), $this->session->userdata('LastName')); ?></a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>