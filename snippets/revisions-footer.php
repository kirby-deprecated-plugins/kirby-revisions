<?php use JensTornell\Revisions as Revisions; ?>
<tr>
	<td colspan="5" class="revisions__table__footer">
		<div>
			<div class="revisions__table__current">
				<a href="<?php echo $edit; ?>">
					<strong>Current:</strong> <?php echo $modified; ?>
				</a>
			</div>
			<?php if( $slug != 'revisions' && $count > 3 ) : ?>
				<div class="revisions__table__archive">
					<a href="<?php echo $revisions; ?>" class="revisions-more-button">
						<i class="fa fa-archive" aria-hidden="true"></i>
						<strong>Archive</strong> (<?php echo $count; ?>)
					</a>
				</div>
			<?php endif; ?>
			<div class="revisions__table__delete">
				<a href="<?php echo $flush; ?>" target="_top" onclick="return confirm('Delete all revisions on this page?')">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
					Delete all
				</a>
			</div>
		</div>
	</td>
</tr>