<div class="instances form">
<?php echo $this->Form->create('Instance');?>
	<fieldset>
		<legend><?php echo __('Terminate Instance'); ?></legend>
		<div class="input text"><label for="InstanceId">Instance Id</label><?php echo  $this->data['Instance']['id'];?></div>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Instances', true), array('action' => 'index'));?></li>
	</ul>
</div>