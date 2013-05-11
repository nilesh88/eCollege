<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Project</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css" />
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
						<li><span class="navbar-text"><?php echo anchor('login', 'Sign in'); ?> or <?php echo anchor('register', 'Register'); ?></span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<?php echo form_open('forgot', 'id="login" class="form-signin"'); ?>
			<h2 class="form-signin-heading">Password Reset</h2>
			<p>Please enter the email you registered your account with.</p>
			<input class="input-block-level" name="email" type="text" placeholder="Email address" value="<?php echo set_value('email'); ?>" />
			<?php echo form_error('email'); ?>
			<button id="signin" class="btn btn-large btn-primary btn-block" type="submit">Send Email</button>
		<?php echo form_close(); ?>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#login').submit(function() {
			$('#signin').html('<i class="icon-spinner icon-spin"></i>');
		});
	});
	</script>
</body>
</html>