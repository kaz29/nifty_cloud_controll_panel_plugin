<?php
class StopInstanceShell extends Shell
{
	public $uses = array('NiftyCloudControllPanel.Instance');
	
	public function main()
	{
		Configure::write(0);
		if (!isset($this->params['id']) ) {
			echo "パラメータエラー\n";
			exit;
		}
		
		$data = array(
			'id' => $this->params['id'],
			'type' => isset($this->params['force']),
		);

		$this->Instance->create();
		$this->Instance->set($data);
		$result = $this->Instance->stop();
		if ( $result === true ) {
			echo "サーバー:{$this->params['id']} を停止しました。\n";
		} else {
			echo "サーバー:{$this->params['id']} 停止時にエラーが発生しました。\n";
		}
	}
}