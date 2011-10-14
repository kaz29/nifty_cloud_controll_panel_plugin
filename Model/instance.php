<?php
require_once(ROOT.DS.'vendors'.DS.'niftycloud'.DS.'services'.DS.'niftycloud.class.php');

class Instance extends AppModel {
	public $useTable = false;
	private $api = null;
	
	public function find($type)
	{
		if (is_null($this->api)) {
			$config = Configure::read('nifty_cloud');
			$this->api = new NiftyCloud($config);
		}
		
		$result = false ;
		$api_result = $this->api->describe_instances();
		if ( $this->api->isError() ) {
			$result = array();
		} else {
			$result = array();
			foreach($api_result->reservationSet->item as $item) {
				$launch_time = date('Y/m/d H:i:s',strtotime((string)$item->instancesSet->item->launchTime));
				$result[] = array(
					$this->alias => array(
						'id'					=> (string)$item->instancesSet->item->instanceId,
						'type'				=> (string)$item->instancesSet->item->instanceType,
						'image_id'		=> (string)$item->instancesSet->item->imageId,
						'global_ip'		=> (string)$item->instancesSet->item->dnsName,
						'local_ip'		=> (string)$item->instancesSet->item->privateDnsName,
						'status' 			=> (string)$item->instancesSet->item->instanceState->name,
						'launch_time' => $launch_time,
						'description' => (string)$item->instancesSet->item->description,
					)
				);
			}
		}
		
		return $result;
	}
	
	public function stop()
	{
		if (is_null($this->api)) {
			$config = Configure::read('nifty_cloud');
			$this->api = new NiftyCloud($config);
		}
		
		$params = array(
			'InstanceId'	=> $this->data[$this->alias]['id'],
			'Force'				=> $this->data[$this->alias]['type'],
		);
		
		$api_result = $this->api->stop_instances($params);
		return !$this->api->isError();
	}
	
	public function start()
	{
		if (is_null($this->api)) {
			$config = Configure::read('nifty_cloud');
			$this->api = new NiftyCloud($config);
		}

		$params = array(
			'InstanceId'			=> array($this->data[$this->alias]['id']),
			'InstanceType'		=> array($this->data[$this->alias]['instance_type']),
			'AccountingType'	=> array($this->data[$this->alias]['accounting_type']),
		);
		
		$api_result = $this->api->start_instances($params);
		return !$this->api->isError();
	}
}
