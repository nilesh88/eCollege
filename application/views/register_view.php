	<div class="container">
		<?php echo form_open('register', 'id="register" class="form-register"'); ?>
			<h2 class="form-register-heading">Register</h2>
			<?php if (isset($success)): ?>
				<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $success; ?></div>
			<?php endif; ?>
			<input class="input-block-level" name="firstName" type="text" placeholder="First Name" value="<?php echo set_value('firstName'); ?>" />
			<?php echo form_error('firstName'); ?>
			<input class="input-block-level" name="lastName" type="text" placeholder="Last Name" value="<?php echo set_value('lastName'); ?>" />
			<?php echo form_error('lastName'); ?>
			<input class="input-block-level" name="email" type="text" placeholder="Email address" value="<?php echo set_value('email'); ?>" />
			<?php echo form_error('email'); ?>
			<input class="input-block-level" name="password" type="password" placeholder="Password" />
			<?php echo form_error('password'); ?>
			<input class="input-block-level" name="password_confirm" type="password" placeholder="Password Confirm" />
			<?php echo form_error('password_confirm'); ?>
			<p>Already a member? Sign in <?php echo anchor('login', 'here'); ?></p>
			<button class="btn btn-large btn-success btn-block" type="submit">Register</button>
		<?php echo form_close(); ?>
		<div id="push"></div>
	</div>
</div>