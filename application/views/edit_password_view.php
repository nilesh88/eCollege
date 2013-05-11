	<div class="container-fluid">
		<div class="row-fluid">
			<div class="items">
				<ul class="breadcrumb">
					<li><?php echo anchor('home', '<i class="icon-home"></i> Home'); ?> <span class="divider">/</span></li>
					<li><?php echo anchor('members', 'Dashboard'); ?> <span class="divider">/</span></li>
					<li class="active">Edit Profile</li>
				</ul>
				<ul class="nav nav-tabs">
					<li><?php echo anchor('settings/profile', 'Profile'); ?></li>
					<li class="active"><?php echo anchor('settings/password', 'Password'); ?></li>
				</ul>
				<?php echo form_open('settings/password', 'class="form-horizontal"'); ?>
					<fieldset>
						<legend>Change Password</legend>
						<br />
						<div class="control-group">
							<label class="control-label" for="newPass">New Password:</label>
							<div class="controls">
								<input id="newPass" name="newPass" type="password" value="<?php echo set_value('newPass'); ?>" placeholder="New Password" />
								<?php echo form_error('newPass'); ?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="newPassConf">Confirm New Password:</label>
							<div class="controls">
								<input id="newPassConf" name="newPassConf" type="password" placeholder="Confirm New Password" />
								<?php echo form_error('newPassConf'); ?>
							</div>
						</div>
					</fieldset>
					<div class="form-actions">
						<button class="btn" type="submit">Change Password</button>
					</div>
				<?php echo form_close(); ?>
				<footer>
					<p>Project <?php echo date('Y'); ?></p>
				</footer>
			</div>
		</div>
	</div>