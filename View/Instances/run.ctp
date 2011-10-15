<div class="instances form">
<?php echo $this->Form->create('Instance');?>
	<fieldset>
		<legend><?php echo __('Run Instance'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden'));
		echo $this->Form->input('image_id', array(
			'type'=>'select',
			'label'=>__('OSイメージ',true),
			'options' => $images
		));
		echo $this->Form->input('instanceid', array(
			'label'=>__('インスタンスID'),
			'type'=>'text'
		));
		echo $this->Form->input('accounting_type', array(
			'type'=>'select',
			'label'=>__('課金方法',true),
			'options' => array(1=>'月額',2=>'従量'),
			'value'=>2
		));
		echo $this->Form->input('instance_type', array(
			'type'=>'select',
			'label'=>__('サーバータイプ',true),
			'options' => $instance_types
		));
		echo $this->Form->input('password', array(
			'label'=>__('パスワード'),
			'type'=>'password'
		));
		echo $this->Form->input('password_confirm', array(
			'label'=>__('パスワード(確認)'),
			'type'=>'password'
		));
		echo $this->Form->input('key_pair', array(
			'type'=>'select',
			'label'=>__('公開鍵',true),
			'options' => $key_pairs
		));
		echo $this->Form->input('security_group', array(
			'type'=>'select',
			'label'=>__('ファイアーウォール',true),
			'options' => $security_groups
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