<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Project</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php echo anchor('home', '<i class="icon-globe"></i> Project', 'class="brand"'); ?>
				<div class="nav-collapse collapse">
					<ul class="nav pull-right">
						<?php if (isset($logged_in) && $logged_in != FALSE): ?>
						<?php if (strlen($this->session->userdata('User_Image'))): ?>
						<li><img class="pull-left" src="<?php echo base_url(); ?>uploads/thumbs/32x32/<?php echo $this->session->userdata('User_Image'); ?>" alt="Profile Image" /><span class="navbar-text"><?php echo anchor('members', $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName')); ?></span></li>
						<?php else: ?>
						<li><img class="pull-left" src="http://placehold.it/30x30" alt="No Profile Image" /><span class="navbar-text"><?php echo anchor('members', $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName')); ?></span></li>
						<?php endif; ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-cog icon-white icon-large"></i>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('settings/profile', '<i class="icon-edit"></i> Edit Profile'); ?></li>
								<li class="divider"></li>
								<li><?php echo anchor('members/logout', '<i class="icon-off"></i> Logout'); ?></li>
							</ul>
						</li>
						<?php else: ?>
						<li><span class="navbar-text"><?php echo anchor('login', 'Sign in'); ?> or <?php echo anchor('register', 'Register'); ?></span></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span3">
				<div class="well">
					<h3 class="modal-header">Seller Info</h3>
					<div class="media">
						<?php if (strlen($user_image)): ?>
						<img class="img-polaroid pull-left" src="<?php echo base_url(); ?>uploads/thumbs/64x64/<?php echo $user_image; ?>" alt="User Image" />
						<?php else: ?>
						<img class="img-polaroid pull-left" src="http://placehold.it/64x64" alt="64x64" />
						<?php endif; ?>
						<div class="media-body">
							<h4 class="media-heading"><?php echo $first_name . ' ' . $last_name; ?></h4>
							<p><small>Member since <?php echo date('M j, Y', strtotime($joined)); ?></small></p>
						</div>
					</div>
				</div>
			</div>
			<div class="span9 items">
				<?php if (empty($logged_in)): ?>
				<div class="alert alert-info animated fadeIn">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<i class="icon-warning-sign"></i> You must be logged in to view this sellers contact information.
				</div>
				<?php endif; ?>
				<div id="loader"><i class="icon-spinner icon-4x"></i></div>
				<?php if (strlen($item_image)): ?>
				<p><img class="img-polaroid" src="<?php echo base_url(); ?>uploads/thumbs/300x200/<?php echo $item_image; ?>" alt="Item Image" /></p>
				<?php else: ?>
				<p><img class="img-polaroid" src="http://placehold.it/300x200" alt="300x200" /></p>
				<?php endif; ?>
				<table class="table table-striped">
					<tbody>
						<tr>
							<td><strong>Item:</strong></td>
							<td><?php echo $item; ?></td>
						</tr>
						<tr>
							<td><strong>Posted:</strong></td>
							<td><?php echo date('M j, Y h:i a', strtotime($posted)); ?></td>
						</tr>
						<tr>
							<td><strong>Price:</strong></td>
							<td>
								<?php if ($price > 0): ?>
								<?php echo '$' . $price; ?>
								<?php else: ?>
								<?php echo 'Free'; ?>
								<?php endif; ?>
							</td>
						</tr>
						<?php if (!empty($logged_in)): ?>
						<tr>
							<td><strong>Contact:</strong></td>
							<td><?php echo mailto("$email", $email); ?></td>
						</tr>
						<?php endif; ?>
						<tr>
							<td><strong>Category:</strong></td>
							<td><?php echo $category; ?></td>
						</tr>
						<tr>
							<td><strong>On Campus:</strong></td>
							<td>
								<?php if ($on_campus == 1): ?>
								<?php echo 'Yes'; ?>
								<?php else: ?>
								<?php echo 'No'; ?>
								<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td><strong>Description:</strong></td>
							<td><?php echo $description; ?></td>
						</tr>
					</tbody>
				</table>
				<footer>
					<p>Project <?php echo date('Y'); ?></p>
				</footer>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#loader').hide()
		.ajaxStart(function() {
			$(this).show();
		}).ajaxStop(function() {
			$(this).hide();
		});
	});
	</script>
</body>
</html>