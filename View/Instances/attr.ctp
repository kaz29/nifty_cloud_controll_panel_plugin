<div class="instances form">
<?php echo $this->Form->create('Instance');?>
	<fieldset>
		<legend><?php echo __('Change Instance Attribute'); ?></legend>
		<div class="input text"><label for="InstanceId">Instance Id</label><?php echo  $this->data['Instance']['id'];?></div>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden'));
		echo $this->Form->input('value', array(
			'type'=>'select',
			'label'=>(__('APIからの削除禁止',true).(($this->data['Instance']['value'])?'(禁止中:Enable)':'(解除中:Disable)')),
			'options' => array(false=>__('Disable'),true=>__('Enable'))
		));
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