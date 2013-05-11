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
						<li><?php echo anchor('members', '<img src="' . base_url() . 'uploads/thumbs/32x32/' . $this->session->userdata('User_Image') . '" alt="Profile Image" />' . sprintf('%s %s', $this->session->userdata('FirstName'), $this->session->userdata('LastName'))); ?></li>
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
	<div class="container">
		<div class="page-header">
			<h1>Newest Items</h1>
		</div>
		<?php if (isset($rows)): ?>
		<ul class="thumbnails">
		<?php foreach ($rows as $row): ?>
			<li class="span4">
				<div class="thumbnail">
					<?php if (strlen($row->item_image)): ?>
					<img src="<?php echo base_url(); ?>uploads/thumbs/300x200/<?php echo $row->item_image; ?>" alt="Item Image" />
					<?php else: ?>
					<img src="http://placehold.it/300x200" alt="300x200" />
					<?php endif; ?>
					<div class="caption">
						<h3><?php echo $row->item; ?></h3>
						<p><?php echo date('M j, Y h:i a', strtotime($row->posted)); ?></p>
						<p>
							<?php if ($row->price > 0): ?>
							<?php echo '<span id="price-tag" class="label label-success">$' . $row->price . '</span>'; ?>
							<?php else: ?>
							<?php echo '<span id="price-tag" class="label label-success">Free</span>'; ?>
							<?php endif; ?>
						</p>
						<p><?php echo anchor('view/' . $row->id . '/' . url_title($row->item, '-', TRUE), 'View Details', 'class="btn"'); ?></p>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
		</ul>
		<?php else: ?>
		<p>No items appear to be posted.</p>
		<?php endif; ?>
		<?php if (isset($pagination)): ?>
		<?php echo $pagination; ?>
		<?php endif; ?>
		<footer>
			<p class="pull-right"><?php echo anchor('https://twitter.com/rightlag', '@rightlag', 'target="_blank"'); ?></p>
			<p>Project <?php echo date('Y'); ?></p>
		</footer>
	</div>
</body>
</html>