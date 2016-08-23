<?php if( $pagination->total > 0 ) : ?>
	<div class="revisions-page-numbers">
		<div class="revisions-page-numbers-prev">
			<?php if( $pagination->prev_url ) : ?>
				<a href="<?php echo $pagination->prev_url; ?>" class="revisions-prev">
					<i class="icon fa fa-chevron-left"></i>
				</a>
			<?php endif; ?>
		</div>

		<div class="revisions-page-numbers-info">
			<?php if( $pagination->total/$pagination->limit > 1 ) : ?>
				<?php echo $pagination->current; ?>/<?php echo ceil($pagination->total/$pagination->limit); ?>
			<?php endif; ?>
		</div>

		<div class="revisions-page-numbers-next">
			<?php if( $pagination->next === true ) : ?>
				<a href="<?php echo $pagination->url . ( $pagination->current + 1 ); ?>" class="seo-next">
			 		<i class="icon fa fa-chevron-right"></i>
			 	</a>
			<?php endif; ?>
		</div>
	 </div>
<?php endif; ?>