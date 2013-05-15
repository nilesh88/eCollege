		<div class="container">
			<?php echo form_open('login', 'id="login" class="form-signin"'); ?>
				<h2 class="form-signin-heading">Sign in</h2>
					<?php if (isset($error)): ?>
				<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $error; ?></div>
				<?php endif; ?>
				<?php echo $this->session->flashdata('error'); ?>
				<input class="input-block-level" name="email" type="text" placeholder="Email address" value="<?php echo set_value('email'); ?>" />
				<?php echo form_error('email'); ?>
				<input class="input-block-level" name="password" type="password" placeholder="Password" />
				<?php echo form_error('password'); ?>
				<p>Forgot your password? <?php echo anchor('forgot', 'Click here'); ?></p>
				<button class="btn btn-large btn-success btn-block" type="submit">Sign in</button>
			<?php echo form_close(); ?>
		</div>
	</div>