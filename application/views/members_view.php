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
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="items">
				<ul class="breadcrumb">
					<li><?php echo anchor('home', '<i class="icon-home"></i> Home'); ?> <span class="divider">/</span></li>
					<li class="active">Dashboard</li>
				</ul>
				<div class="page-header">
					<?php echo anchor('members/create', 'New Item', 'class="btn pull-right new-item"'); ?>
					<h1>Hey, <?php echo $this->session->userdata('FirstName'); ?></h1>
				</div>
				<?php echo $this->session->flashdata('message'); ?>
				<table id="items" class="table table-striped">
					<thead>
						<tr>
							<th>Item</th>
							<th>Posted</th>
							<th>Price</th>
							<th>Category</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (isset($rows)): ?>
							<?php foreach ($rows as $row): ?>
							<tr>
								<td>
									<?php if (strlen($row->item_image)): ?>
									<img class="media-object pull-left" src="<?php echo base_url(); ?>uploads/thumbs/32x32/<?php echo $row->item_image; ?>" alt="Item Image" />
									<?php endif; ?>
									<?php echo anchor('view/' . $row->id . '/' . url_title($row->item, '-', TRUE), $row->item); ?>
								</td>
								<td><?php echo date('m-d-Y', strtotime($row->posted)); ?></td>
								<td>
									<?php if ($row->price > 0): ?>
									<?php echo '$' . $row->price; ?>
									<?php else: ?>
									<?php echo 'Free'; ?>
									<?php endif; ?>
								</td>
								<td><?php echo $row->category; ?></td>
								<td>
									<div class="btn-group">
										<?php echo anchor('members/update/' . $row->id, '<i class="icon-pencil"></i>', 'class="edit btn" title="Edit"'); ?>
										<?php echo anchor('members/delete/' . $row->id, '<i class="icon-trash"></i>', 'class="delete btn" title="Delete"'); ?>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php else: ?>
						<tr>
							<td colspan="5">You currently do not have any items posted.</td>
						</tr>
						<?php endif; ?>
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
		$('.delete').click(function() {
			var conf = confirm('Are you sure you want to delete this item?');

			return conf;
		});
	});
	</script>
</body>
</html>