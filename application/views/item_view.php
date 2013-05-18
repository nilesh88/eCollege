	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span3">
				<div class="well">
					<h3 class="modal-header">Seller Info</h3>
					<div class="media">
						<?php if (strlen($user_image)): ?>
						<img class="img-polaroid pull-left" src="<?php echo base_url(); ?>uploads/thumbs/64x64/<?php echo $user_image; ?>" alt="User Image" />
						<?php else: ?>
						<img class="img-polaroid pull-left" src="http://placehold.it/64x64" alt="64x64" />
						<?php endif; ?>
						<div class="media-body">
							<h4 class="media-heading"><?php echo $first_name . ' ' . $last_name; ?></h4>
							<p><small>Member since <?php echo date('M j, Y', strtotime($joined)); ?></small></p>
						</div>
					</div>
				</div>
			</div>
			<div class="span9 items">
				<?php if (empty($logged_in)): ?>
				<div class="alert alert-info animated fadeIn">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<i class="icon-warning-sign"></i> You must be logged in to view this sellers contact information.
				</div>
				<?php endif; ?>
				<div id="loader"><i class="icon-spinner icon-4x"></i></div>
				<?php if (strlen($item_image)): ?>
				<p><img class="img-polaroid" src="<?php echo base_url(); ?>uploads/thumbs/300x200/<?php echo $item_image; ?>" alt="Item Image" /></p>
				<?php else: ?>
				<p><img class="img-polaroid" src="http://placehold.it/300x200" alt="300x200" /></p>
				<?php endif; ?>
                                <script src="paypal.js?merchant=net.nil88@gmail.com"
                                        data-button="buynow"
                                        data-name="<?php echo $item; ?>"
                                        data-amount="<?php echo $price; ?>"
                                ></script>
				<table class="table table-striped">
					<tbody>
						<tr>
							<td><strong>Item:</strong></td>
							<td><?php echo $item; ?></td>
						</tr>
						<tr>
							<td><strong>Posted:</strong></td>
							<td><?php echo date('M j, Y h:i a', strtotime($posted)); ?></td>
						</tr>
						<tr>
							<td><strong>Price:</strong></td>
							<td>
								<?php if ($price > 0): ?>
								<?php echo '$' . $price; ?>
								<?php else: ?>
								<?php echo 'Free'; ?>
								<?php endif; ?>
							</td>
						</tr>
						<?php if (!empty($logged_in)): ?>
						<tr>
							<td><strong>Contact:</strong></td>
							<td><?php echo mailto("$email", $email); ?></td>
						</tr>
						<?php endif; ?>
						<tr>
							<td><strong>Category:</strong></td>
							<td><?php echo $category; ?></td>
						</tr>
						<tr>
							<td><strong>On Campus:</strong></td>
							<td>
								<?php if ($on_campus == 1): ?>
								<?php echo 'Yes'; ?>
								<?php else: ?>
								<?php echo 'No'; ?>
								<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td><strong>Description:</strong></td>
							<td><?php echo $description; ?></td>
						</tr>
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
		$('#loader').hide()
		.ajaxStart(function() {
			$(this).show();
		}).ajaxStop(function() {
			$(this).hide();
		});
	});
	</script>
        <script type="text/javascript" src ="<?php echo site_url() . 'assets/js/paypal.js'; ?>"></script>
        
        