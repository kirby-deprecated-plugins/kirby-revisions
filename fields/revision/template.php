<style>
.mainbar .form .buttons {
	display: none;
}
.mainbar .form {
	padding-bottom: 0;
}

.revision-info {
	margin-bottom: 1.5em;
	background: #fff;
}

.revision-info table{
	border-collapse: collapse;
	border: 2px solid #ddd;
	width: 100%;
}
.revision-info th {
	text-align: left;
	padding: .5em;
	border: 1px solid #efefef;
	width: 1px;
	white-space: nowrap;
}
.revision-info td {
	padding: .5em;
	border: 1px solid #efefef;
}
</style>

<?php if( $language ) : ?>
	<?php /*
	<div class="revision-info">
		<table>
			<tr>
				<th>Changed fields:</th>
				<td>
					<?php echo $changes['total'] . '/' . count($items); ?>
				</td>
			</tr>
			<tr>
				<th>Inserts:</th>
				<td>
					<?php echo $changes['ins'] . '/' . count($items); ?>
				</td>
			</tr>
			<tr>
				<th>Deletions:</th>
				<td>
					<?php echo $changes['del'] . '/' . count($items); ?>
				</td>
			</tr>
		</table>
	</div>
	*/
	?>

	<div class="revision-content">
		<?php foreach( $items as $item ) : ?>
			<h2><?php echo $item['title']; ?></h2>
			<?php if( ! empty( $item['diff'] ) ) : ?>
				<div class="revision-part">
					<?php echo $item['diff']; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<div class="revision-action">
		<a href="<?php echo $url; ?>" class="btn btn-rounded btn-submit" target="_top">Rollback revision</a>
	</div>
<?php else : ?>
	No revision found in this language. Try to switch to another language.
<?php endif; ?>