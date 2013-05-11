<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Project</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
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
						<li><img class="media-object pull-left" src="<?php echo base_url(); ?>uploads/thumbs/32x32/<?php echo $this->session->userdata('User_Image'); ?>" alt="Profile Image" /><span class="navbar-text"><?php echo anchor('members', $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName')); ?></span></li>
						<?php else: ?>
						<li><img class="media-object pull-left" src="http://placehold.it/30x30" alt="No Profile Image" /><span class="navbar-text"><?php echo anchor('members', $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName')); ?></span></li>
						<?php endif; ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-cog icon-white icon-large"></i>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('members/edit', '<i class="icon-edit"></i> Edit Profile'); ?></li>
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
	<div class="jumbotron masthead">
		<div class="container">
			<h1>Project</h1>
			<p>A site for college students to buy and sell items</p>
			<?php if (empty($logged_in)): ?>
			<p><?php echo anchor('register', 'Get started', 'class="btn btn-success btn-large"'); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<div class="bs-docs-social">
		<div class="container">
			<span>Social Media Content</span>
		</div>
	</div>
	<div class="container">
		<div class="heading">
			<?php if (isset($num_rows)): ?>
			<h1>Newest Items</h1>
			<p class="heading-byline">Project currently has <?php echo $num_rows; ?> items posted.</p>
			<?php else: ?>
			<h1>Well ain't that something?</h1>
			<p class="heading-byline">Nothing appears to be posted.</p>
			<?php endif; ?>
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
						<p><i class="icon-calendar"></i> <strong>Posted:</strong> <?php echo date('M. d, Y h:i a', strtotime($row->posted)); ?></p>
						<p><i class="icon-money"></i> <strong>Price:</strong> 
							<?php if ($row->price > 0): ?>
							<?php echo '$' . $row->price; ?>
							<?php else: ?>
							<?php echo 'Free'; ?>
							<?php endif; ?>
						</p>
						<p><?php echo anchor('view/' . $row->id . '/' . url_title($row->item, '-', TRUE), 'View Details'); ?></p>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
		</ul>
		<?php endif; ?>
		<?php if (isset($pagination)): ?>
		<?php echo $pagination; ?>
		<?php endif; ?>
		<hr />
		<footer>
			<p class="pull-right"><?php echo anchor('https://twitter.com/rightlag', '@rightlag', 'target="blank"'); ?></p>
			<p>Project <?php echo date('Y'); ?></p>
		</footer>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.thumbnail h3').each(function(index, value) {
			var item = $(this).text();

			if (item.length > 25) {
				$(this).addClass('font-resize');
			}
		});
	});
	</script>
</body>
</html>