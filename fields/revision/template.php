<style>
.mainbar .form .buttons {
	display: none;
}
.mainbar .form {
	padding-bottom: 0;
}

.revisions__subline {
	font-size: 1.5em;
	margin-bottom: 1em;
}
.revisions__dates {
	color: #777;
	font-style: italic;
	margin-bottom: 1.5em;
}

.revisions__colors {
	
}
.revisions__misc {
	display: flex;
}

.revisions__misc >* {
	padding: .5em 1.5em !important;
	border-right: 1px solid #ddd;
}

.revisions__table tbody th {
	text-align: right;
	width: 1px;
}
.revision-content {
	margin-top: 1em;
	margin-bottom: 1.5em;
}
</style>

<?php if( $language ) : ?>

<div class="revisions__sidebar">
	<div class="revisions__sidebar__items">
		<h2 class="hgroup hgroup-single-line hgroup-compressed cf">
			<span class="hgroup-title">Revision info</span>
		</h2>
		<ul class="nav nav-list sidebar-list">
			<li>
				<div>
					<i class="icon icon-left fa fa-file-code-o" aria-hidden="true"></i>
					<strong>Template:</strong> <?php echo ucfirst( $revision->revision_template() ); ?>
				</div>
			</li>
			<li>
				<div>
					<i class="icon icon-left fa fa-plug" aria-hidden="true"></i>
					<strong>Action:</strong> <?php echo ucfirst( $revision->revision_action() ); ?>
				</div>
			</li>

			<li>
				<div>
					<i class="icon icon-left fa fa-code-fork" aria-hidden="true"></i>
					<strong>Diff:</strong>

					<strong><span class="revisions__color--ins">
						<?php echo $items['ins_total']; ?>
					</span>/
					<span class="revisions__color--del">
						<?php echo $items['del_total']; ?>
					</span></strong>
				</div>
			</li>
		</ul>
	</div>
 </div>

<div class="revisions__subline">
	<strong>Fields</strong>
	<span class="revisions__color--bright">(<?php echo count( $items['values'] ) - count( $items_missing_in_blueprint ); ?>)</span>
</div>

	<div class="revision-content">
		<?php foreach( $items['values'] as $key => $item ) : ?>
			<?php if( in_array( $key, $blueprint_keys ) ) : ?>
				<h2><?php echo $item['title']; ?></h2>
				<?php if( ! empty( $item['value'] ) ) : ?>
					<div class="revision-part">
						<?php echo $item['value']; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

<?php if( ! empty( $items_missing_in_blueprint ) ) : ?>
	<div class="revisions__fields__missing">
		<div class="revisions__subline">
			<i class="fa fa-exclamation-triangle"></i>
			<strong class="revisions__color--del">Fields missing in the blueprint</strong>
			<span class="revisions__color--del">(<?php echo count( $items_missing_in_blueprint ); ?>)</span>
		</div>

		Fields in this section are missing in the blueprint, but are still restored on rollback.

		<div class="revision-content">
			<?php foreach( $items_missing_in_blueprint as $item ) : ?>
				<h2><?php echo $item['title']; ?></h2>
				<?php if( ! empty( $item['value'] ) ) : ?>
					<div class="revision-part">
						<?php echo $item['value']; ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

	<div class="revisions__actions">
		<div class="revision-delete">
			<a href="<?php echo $delete_url; ?>" class="btn btn-rounded btn-submit btn-negative" target="_top" onclick="return confirm('Delete this revision?')">Delete</a>
		</div>
		<div class="revisions__color--del">
			<?php if( ! $items['template_equal'] ) : ?>
				<i class="fa fa-exclamation-triangle"></i>
				<strong>Original template:</strong> <?php echo ucfirst( $page->intendedTemplate() ); ?>
			<?php endif; ?>
		</div>
		<div class="revision-rollback">
			<a href="<?php echo $rollback_url; ?>" class="btn btn-rounded btn-submit" target="_top">Rollback</a>
		</div>
	</div>
<?php else : ?>
	No revision found in this language. Try to switch to another language.
<?php endif; ?>