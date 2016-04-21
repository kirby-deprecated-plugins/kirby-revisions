<style>
.revisions td a {
	cursor: pointer;
}
.revisions td a .revision-date i {
	margin-right: .5em;
}
.revisions td a .revision-time i {
	margin-left: 1em;
	margin-right: .2em;
}
.revisions td a .revision-template i {
	margin-left: 1em;
	margin-right: .2em;
}
</style>

<?php if( ! empty( $revisions ) ) : ?>
<table class="structure-table revisions">
	<tbody>
		<?php foreach( $revisions as $revision) : ?>
			<?php $filename = basename( $revision ); ?>
			<tr>
				<td>
					<a href="<?php echo PluginRevisionsContent::url( $page, $filename ); ?>" target="_blank">
						<span class="revision-date">
							<i class="fa fa-calendar"></i>
							<?php echo PluginRevisionsContent::date( $filename ); ?> 
						</span>
					
						<span class="revision-time">
							<i class="fa fa-clock-o"></i>
							<?php echo PluginRevisionsContent::time( $filename ); ?>
						</span>

						<span class="revision-template">
							<i class="fa fa-file-code-o"></i>
							<?php echo PluginRevisionsContent::template( $filename ); ?>
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