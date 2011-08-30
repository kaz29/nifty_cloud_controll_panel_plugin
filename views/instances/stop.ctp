<div class="instances form">
<?php echo $this->Form->create('Instance');?>
	<fieldset>
		<legend><?php __('Stop Instance'); ?></legend>
		<div class="input text"><label for="InstanceId">Instance Id</label><?php e($this->data['Instance']['id']);?></div>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden'));
		echo $this->Form->input('type', array(
			'type'=>'select',
			'label'=>__('停止方法',true),
			'options' => array(false=>'normal',true=>'immediate')
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Instances', true), array('action' => 'index'));?></li>
	</ul>
</div>