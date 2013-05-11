	<div class="container">
		<div class="page-header">
			<h1>Newest Items</h1>
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
						<p><?php echo date('M j, Y h:i a', strtotime($row->posted)); ?></p>
						<p>
							<?php if ($row->price > 0): ?>
							<?php echo '<span id="price-tag" class="label label-success">$' . $row->price . '</span>'; ?>
							<?php else: ?>
							<?php echo '<span id="price-tag" class="label label-success">Free</span>'; ?>
							<?php endif; ?>
						</p>
						<p><?php echo anchor('view/' . $row->id . '/' . url_title($row->item, '-', TRUE), 'View Details', 'class="btn"'); ?></p>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
		</ul>
		<?php else: ?>
		<p>No items appear to be posted.</p>
		<?php endif; ?>
		<?php if (isset($pagination)): ?>
		<?php echo $pagination; ?>
		<?php endif; ?>
		<footer>
			<p class="pull-right"><?php echo anchor('https://twitter.com/rightlag', '@rightlag', 'target="_blank"'); ?></p>
			<p>Project <?php echo date('Y'); ?></p>
		</footer>
	</div>