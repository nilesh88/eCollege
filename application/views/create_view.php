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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/counter.js"></script>
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
					<li><?php echo anchor('members', 'Dashboard'); ?> <span class="divider">/</span></li>
					<li class="active">Create</li>
				</ul>
				<?php echo form_open_multipart('members/create', 'class="form-horizontal"'); ?>
					<fieldset>
						<legend>Item Details</legend>
						<br />
						<div class="control-group">
							<label class="control-label" for="item">Item:</label>
							<div class="controls">
								<input id="item" name="item" type="text" value="<?php echo set_value('item'); ?>" placeholder="Item" />
								<?php echo form_error('item'); ?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="price">Price:</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">$</span>
									<input class="input-small" id="price" name="price" type="text" value="<?php echo set_value('price') ?>" placeholder="Price" />
								</div>
								<?php echo form_error('price'); ?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="category">Category:</label>
							<div class="controls">
								<?php echo form_dropdown('category', $category_options, 'id="category"'); ?>
								<?php echo form_error('category'); ?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="userfile">Image File:</label>
							<div class="controls">
								<input id="userfile" name="userfile" type="file" />
								<span class="help-block">Image is not required but recommended.</span>
								<span class="help-block">Max file size: 2000 KB.</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="on_campus">On Campus?</label>
							<div class="controls">
								<?php echo form_checkbox('on_campus', 1, TRUE, 'id="on_campus"'); ?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="description">Description:</label>
							<div class="controls">
								<textarea class="span4" id="description" name="description" placeholder="Description" rows="8"><?php echo set_value('description'); ?></textarea>
								<?php echo form_error('description'); ?>
								<span class="help-block"><span id="remains">500</span> characters remaining.</span>
							</div>
						</div>
					</fieldset>
					<div class="form-actions">
						<button class="btn" type="submit">Create</button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
		<footer>
			<p>Project <?php echo date('Y'); ?></p>
		</footer>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {
		count_char($('#description').get(0));

		$('#description').keyup(function() {
			count_char(this);
		});
	});
	</script>
</body>
</html>