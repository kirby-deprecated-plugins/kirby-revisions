<?php use JensTornell\Revisions as Revisions; ?>
<style>
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
<?php if( $first ) : ?>
	<div class="revisions-count">
		<?php echo $all->count(); ?> revisions
	</div>
	<table class="revisions__table">
		<?php echo $headings; ?>
		<tbody>
			<?php echo $rows; ?>
			<?php echo $footer; ?>
		</tbody>
	</table>
<?php else : ?>
	<?php echo l::get('no.revisions.found', 'No revisions found'); ?>
<?php endif; ?>