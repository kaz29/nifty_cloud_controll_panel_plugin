<div class="instances form">
<?php echo $this->Form->create('Instance');?>
	<fieldset>
		<legend><?php __('Start Instance'); ?></legend>
		<div class="input text"><label for="InstanceId">Instance Id</label><?php e($this->data['Instance']['id']);?></div>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden'));
		echo $this->Form->input('instance_type', array(
			'type'=>'select',
			'label'=>__('サーバータイプ',true),
			'options' => $instance_types
		));
		echo $this->Form->input('accounting_type', array(
			'type'=>'select',
			'label'=>__('課金方法',true),
			'options' => array(1=>'月額',2=>'従量'),
			'value'=>2
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