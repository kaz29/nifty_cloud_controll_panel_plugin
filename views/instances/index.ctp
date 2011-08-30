<div class="instances index">
	<h2><?php __('Instances');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php __('Instance Id');?></th>
			<th><?php __('Instance Type');?></th>
			<th><?php __('OS Image');?></th>
			<th><?php __('Status');?></th>
			<th><?php __('Launch Time');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($instances as $instance):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $instance['Instance']['id']; ?>&nbsp;</td>
		<td><?php echo $instance['Instance']['type']; ?>&nbsp;</td>
		<td><?php if ( array_key_exists($instance['Instance']['image_id'], $images)):
					echo $images[$instance['Instance']['image_id']]; 
				else:
					echo "Unknown";
				endif;?>&nbsp;</td>
		<td><?php echo $instance['Instance']['status']; ?>&nbsp;</td>
		<td><?php echo $instance['Instance']['launch_time']; ?>&nbsp;</td>
		<td class="actions">
			<?php 
				switch($instance['Instance']['status']){
				case 'running':
					echo $this->Html->link(__('Stop', true), array('action' => 'stop', $instance['Instance']['id']));
					break ;
				case 'stopped':
					echo $this->Html->link(__('Start', true), array('action' => 'start', $instance['Instance']['id']));
					break ;
				}
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
