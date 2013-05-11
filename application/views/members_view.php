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
									<img class="media-object pull-left" src="<?php echo site_url(); ?>uploads/thumbs/32x32/<?php echo $row->item_image; ?>" alt="Item Image" />
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