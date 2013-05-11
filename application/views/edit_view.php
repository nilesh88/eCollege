	<div class="container-fluid">
		<div class="row-fluid">
			<div class="items">
				<ul class="breadcrumb">
					<li><?php echo anchor('home', '<i class="icon-home"></i> Home'); ?> <span class="divider">/</span></li>
					<li><?php echo anchor('members', 'Dashboard'); ?> <span class="divider">/</span></li>
					<li class="active">Edit Profile</li>
				</ul>
				<ul class="nav nav-tabs">
					<li class="active"><?php echo anchor('settings/profile', 'Profile'); ?></li>
					<li><?php echo anchor('settings/password', 'Password'); ?></li>
				</ul>
				<?php echo form_open_multipart('settings/profile', 'class="form-horizontal"'); ?>
					<fieldset>
						<legend>Profile Details</legend>
						<br />
						<div class="row">
							<div class="span8">
								<div class="control-group">
									<label class="control-label" for="firstName">First Name:</label>
									<div class="controls">
										<input id="firstName" name="firstName" type="text" value="<?php echo $first_name; ?>" placeholder="First Name" />
										<?php echo form_error('firstName'); ?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="lastName">Last Name:</label>
									<div class="controls">
										<input id="lastName" name="lastName" type="text" value="<?php echo $last_name; ?>" placeholder="Last Name" />
										<?php echo form_error('lastName'); ?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="email">Email Address:</label>
									<div class="controls">
										<input id="email" name="email" type="text" value="<?php echo $email; ?>" placeholder="Email" disabled />
										<?php echo form_error('email'); ?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="userfile">Profile Picture:</label>
									<div class="controls">
										<input id="userfile" name="userfile" type="file" />
										<span class="help-block">How about an image of yourself?</span>
										<span class="help-block">Max file size: 2000 KB.</span>
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="well">
									<?php if (strlen($user_image)): ?>
									<p><img class="img-polaroid" src="<?php echo base_url(); ?>uploads/thumbs/128x128/<?php echo $user_image; ?>" alt="Item Image" /></p>
									<?php else: ?>
									<p><img class="img-polaroid" src="http://placehold.it/300x200" alt="Item Image" /></p>
									<?php endif; ?>
									<p>Your current profile picture.</p>
								</div>
							</div>
						</div>
					</fieldset>
					<div class="form-actions">
						<button class="btn" type="submit">Save changes</button>
					</div>
				<?php echo form_close(); ?>
				<footer>
					<p>Project <?php echo date('Y'); ?></p>
				</footer>
			</div>
		</div>
	</div>