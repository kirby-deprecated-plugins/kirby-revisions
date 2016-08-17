<style>
.revisions {
	
}

.revisions-nav {
	display: flex;
}

.revision-page-of-pages {
	flex: 1;
	text-align: center;
	padding: 1em;
}

.revisions-nav a {
	display: block;
	padding: 1em 0;
}
.revisions-nav a:first-child {
	float: left;
	padding-right: 1em;
}
.revisions-nav a:last-child {
	float: right;
	padding-left: 1em;
}
.revisions-count {
	margin-bottom: .5em;
}
.revisions td a {
  cursor: pointer; }

    .revisions td .fa {
    	margin-right: .5em;
    }

	.sidebar {
		display: none !important;
	}
	.bars-with-sidebar-left:before {
		display: none;
	}
	.mainbar {
		width: 100%;
	}
.mainbar .form {
	padding-bottom: 0;
}
.mainbar .form .buttons {
	display: none;
}
</style>
<?php if( $query->count() > 0 ) : ?>
	<div class="revisions-count">
		<?php echo $query->count(); ?> revisions
	</div>
	<table class="structure-table revisions">
		<thead>
			<tr>
				<th>Updated</th>
				<th>Action</th>
				<th>Template</th>
				<th>Size</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $items as $item ) : ?>
			<tr>
				<td>
					<a href="<?php echo $item['edit_url']; ?>">
						<span class="revision-date">
							<i class="fa fa-clock-o"></i>
							<?php echo $item['modified']; ?>
						</span>
					</a>
				</td>
				<td>
					<a href="<?php echo $item['edit_url']; ?>">
						<span class="revision-action">
							<i class="fa fa-tag" aria-hidden="true"></i>
							<?php echo $item['action']; ?>
						</span>
					</a>
				</td>
				<td>
					<a href="<?php echo $item['edit_url']; ?>">
						<span class="revision-template">
							<i class="fa fa-file-code-o" aria-hidden="true"></i>
							<?php echo $item['template']; ?>
						</span>
					</a>
				</td>
				<td>
					<a href="<?php echo $item['edit_url']; ?>">
						<span class="revision-template">
							<i class="fa fa-file-o" aria-hidden="true"></i>
							<?php echo $item['size']; ?> bytes
						</span>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else : ?>
	<?php echo l::get('no.revisions.found', 'No revisions found'); ?>
<?php endif; ?>