<?php foreach( $items as $item ) : ?>
	<tr>
		<td>
			<a href="<?php echo $item['edit']; ?>">
				<span class="revision-date">
					<?php echo $item['modified']; ?>
				</span>
			</a>
		</td>
		<td>
			<a href="<?php echo $item['edit']; ?>">
				<span class="revision-action">
					<?php echo $item['action']; ?>
				</span>
			</a>
		</td>
		<td>
			<a href="<?php echo $item['edit']; ?>">
				<span class="revision-template">
					<?php echo $item['template']; ?>
				</span>
			</a>
		</td>
		
		<td>
			<a href="<?php echo $item['edit']; ?>" style="font-weight: bold;">
				<span class="revisions__color--ins"><?php echo $item['stats']['ins_total']; ?></span>/
				<span class="revisions__color--del"><?php echo $item['stats']['del_total']; ?></span>
			</a>
		</td>
	</tr>
<?php endforeach; ?>