<?php
class StartInstanceShell extends Shell
{
	public $uses = array('NiftyCloudControllPanel.Instance');
	
	public function main()
	{
		if (!isset($this->params['id']) || !isset($this->params['instance_type']) || !isset($this->params['accounting_type'])) {
			echo "パラメータエラー\n";
			exit;
		}
		
		if ( $this->params['accounting_type'] != 1 && $this->params['accounting_type'] != 2 ) {
			echo "accounting_typeが不正です。\n";
			exit;
		}
		
		$data = array(
			'id' => $this->params['id'],
			'instance_type' => $this->params['instance_type'],
			'accounting_type' => $this->params['accounting_type'],
		);
		
		$this->Instance->create();
		$this->Instance->set($data);
		$result = $this->Instance->start();
		if ( $result === true ) {
			echo "サーバー:{$this->params['id']} を起動しました。\n";
		} else {
			echo "サーバー:{$this->params['id']} 起動時にエラーが発生しました。\n";
		}
	}
}