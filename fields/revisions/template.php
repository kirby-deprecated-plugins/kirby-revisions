<?php if( $first ) : ?>
<table class="revisions__table">
	<?php echo $headings; ?>
		<tbody>
			<?php echo $rows; ?>
			<?php echo $footer; ?>
		</tbody>
</table>

<?php else : ?>
No revisions found
<?php endif; ?>