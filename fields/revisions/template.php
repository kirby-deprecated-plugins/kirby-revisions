<style>
.revisions td a {
	cursor: pointer;
}

.revisions td .fa {
	margin-right: .5em;
}
.revisions-more {
	text-align: center;
}
.revisions-more-button {
	padding: .75em 1.5em !important;
	background: #fff;
	display: block;
}
</style>

<?php if( $query && $query->count() > 0 ) : ?>
<table class="structure-table revisions">
	<thead>
		<tr>
			<th>Updated</th>
			<th>Action</th>
			<th>Template</th>
			<th>Size</th>
		</tr>
	</thead>
	<?php if( $items ) : ?>
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
			<?php if( $query->count() > 3 ) : ?>
				<tr>
					<td colspan="4" class="revisions-more">
						<a href="<?php echo panel()->urls()->index() . '/pages/' . $field->page->id() . '/revisions/edit'; ?>" class="revisions-more-button">
							<i class="fa fa-archive" aria-hidden="true"></i>
							Archive (<?php echo $query->count(); ?>)
						</a>
					</td>
				</tr>
			<?php endif; ?>
		</tbody>
	<?php endif; ?>
</table>

<?php else : ?>
No revisions found
<?php endif; ?>