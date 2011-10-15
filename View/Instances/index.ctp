<div class="instances index">
	<h2><?php echo __('Instances');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Instance Id');?></th>
			<th><?php echo __('Instance Type');?></th>
			<th><?php echo __('OS Image');?></th>
			<th><?php echo __('Status');?></th>
			<th><?php echo __('Launch Time');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
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
					echo __("Unknown");
				endif;?>&nbsp;</td>
		<td><?php echo $instance['Instance']['status']; ?>&nbsp;</td>
		<td><?php echo $instance['Instance']['launch_time']; ?>&nbsp;</td>
		<td class="actions">
			<?php 
				switch($instance['Instance']['status']){
				case 'running':
					echo $this->Html->link(__('Stop', true), array('action' => 'stop', $instance['Instance']['id']));
					echo $this->Html->link(__('Change Attr', true), array('action' => 'attr', $instance['Instance']['id']));
					break ;
				case 'stopped':
					echo $this->Html->link(__('Start', true), array('action' => 'start', $instance['Instance']['id']));
					echo $this->Html->link(__('Terminate', true), array('action' => 'terminate', $instance['Instance']['id']));
					echo $this->Html->link(__('Change Attr', true), array('action' => 'attr', $instance['Instance']['id']));
					break ;
				}
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Create Instances', true), array('action' => 'run'));?></li>
	</ul>
</div>