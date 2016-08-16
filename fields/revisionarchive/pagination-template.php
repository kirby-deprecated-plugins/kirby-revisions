<?php if( $pagination->total > 0 ) : ?>
	<style>
	.page-numbers {
		display: flex;
		margin-top: 1.5em;
	}
	.page-numbers a {
		padding: .5em 1em;
		display: block;
	}

	.page-numbers-prev,
	.page-numbers-next {
		width: 2em;
	}

	.page-numbers-info {
		flex: 1;
		text-align: center;
	}
	</style>

	<div class="page-numbers">
		<div class="page-numbers-prev">
			<?php if( $pagination->prev_url ) : ?>
				<a href="<?php echo $pagination->prev_url; ?>" class="revisions-prev">
					<i class="icon fa fa-chevron-left"></i>
				</a>
			<?php endif; ?>
		</div>

		<div class="page-numbers-info">
			<?php if( $pagination->total/$pagination->limit > 1 ) : ?>
				<?php echo $pagination->current; ?>/<?php echo ceil($pagination->total/$pagination->limit); ?>
			<?php endif; ?>
		</div>

		<div class="page-numbers-next">
			<?php if( $pagination->next === true ) : ?>
				<a href="<?php echo $pagination->url . ( $pagination->current + 1 ); ?>" class="seo-next">
			 		<i class="icon fa fa-chevron-right"></i>
			 	</a>
			<?php endif; ?>
		</div>
	 </div>
<?php endif; ?>