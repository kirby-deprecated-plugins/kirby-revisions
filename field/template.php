<?php use JensTornell\Revisions as Revisions; ?>
<?php if( ! empty( $revisions ) ) : ?>
<table class="structure-table revisions">
	<tbody>
		<?php foreach( $revisions as $revision) : ?>
			<?php $filename = basename( $revision ); ?>
			<tr>
				<td>
					<a href="<?php echo Revisions\Content::url( $page, $filename ); ?>" target="_blank">
						<span class="revision-date">
							<i class="fa fa-calendar"></i>
							<?php echo Revisions\Content::date( $filename ); ?> 
						</span>
					
						<span class="revision-time">
							<i class="fa fa-clock-o"></i>
							<?php echo Revisions\Content::time( $filename ); ?>
						</span>

						<span class="revision-template">
							<i class="fa fa-file-code-o"></i>
							<?php echo Revisions\Content::template( $filename ); ?>
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