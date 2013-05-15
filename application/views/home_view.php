		<div class="hero-unit">
			<div class="container">
				<div class="row">
					<div class="span6">
						<h1>Fast. Easy. Secure.</h1>
						<p>Project name helps college students buy and sell items with other college students. A unique form of social media combined with marketing.</p>
					</div>
					<div class="span6">
						<?php echo form_open('register', 'class="signup"'); ?>
							<input class="input-block-level" id="firstName" name="firstName" type="text" placeholder="First Name" />
							<input class="input-block-level" id="lastName" name="lastName" type="text" placeholder="Last Name" />
							<input class="input-block-level" id="email" name="email" type="text" placeholder="Student Email" />
							<input class="input-block-level" id="password" name="password" type="password" placeholder="Password" />
							<input class="btn btn-large btn-block btn-success" type="submit" value="Sign up!" />
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="home-marketing">
					<div class="span4">
						<h2>Register</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur est nulla, tincidunt ut egestas sed, luctus eget ante. In hac habitasse platea dictumst. Phasellus interdum, lacus sed ullamcorper pretium, ipsum tortor iaculis diam, ut ultricies felis mauris quis velit. Maecenas sodales quam sed tortor pharetra euismod.</p>
					</div>
					<div class="span4">
						<h2>Post Items</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur est nulla, tincidunt ut egestas sed, luctus eget ante. In hac habitasse platea dictumst. Phasellus interdum, lacus sed ullamcorper pretium, ipsum tortor iaculis diam, ut ultricies felis mauris quis velit. Maecenas sodales quam sed tortor pharetra euismod.</p>
					</div>
					<div class="span4">
						<h2>Be Social</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur est nulla, tincidunt ut egestas sed, luctus eget ante. In hac habitasse platea dictumst. Phasellus interdum, lacus sed ullamcorper pretium, ipsum tortor iaculis diam, ut ultricies felis mauris quis velit. Maecenas sodales quam sed tortor pharetra euismod.</p>
					</div>
				</div>
			</div>
			<hr class="featurette-divider" />
			<div class="row">
				<div class="span8">
					<h1 class="market">Newest Items</h1>
					<?php if (isset($rows)): ?>
						<?php foreach ($rows as $row): ?>
							<div class="media">
								<a class="pull-left" href="#">
									<?php if (!empty($row->item_image)): ?>
										<img class="media-object" src="<?php echo site_url() . 'uploads/thumbs/64x64/' . $row->item_image; ?>">
									<?php else: ?>
										<img class="media-object" data-src="holder.js/64x64">
									<?php endif; ?>
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#"><?php echo $row->item; ?></a></h4>
									<small>Posted on: <?php echo date('Y-m-d', strtotime($row->posted)); ?></small>
									<p><?php echo substr($row->description, 0, 140); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="span4">
					<blockquote>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						<small>Someone famous <cite title="Source Title">Source Title</cite></small>
					</blockquote>
				</div>
			</div>
			<hr class="featurette-divider" />
			<div id="push"></div>
		</div>
	</div>