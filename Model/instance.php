<?php

require_once(ROOT.DS.'vendors'.DS.'NiftyCloud'.DS.'services'.DS.'niftycloud.class.php'); 

class Instance extends AppModel {
	public $useTable = false;
	private $api = null;
	
	public function find($type, $conditions=array())
	{
		if (is_null($this->api)) {
			$config = Configure::read('nifty_cloud');
			$this->api = new NiftyCloud($config);
		}
		
		$result = false ;
		
		switch($type) {
		case 'attr':
			$result = null;
			if ( isset($conditions['id']) && isset($conditions['type']) ) {
				$params = array(
					'InstanceId'	=> $conditions['id'],
					'Attribute'		=> $conditions['type'],
				);
				$api_result = $this->api->describe_instance_attribute($params);
				if ( !$this->api->isError() ) {
					$result = (((string)$api_result->{$conditions['type']}->value) === 'true')?true:false;
				}
			}
			break ;
		default:
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
			break ;
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

	public function run()
	{
		if (is_null($this->api)) {
			$config = Configure::read('nifty_cloud');
			$this->api = new NiftyCloud($config);
		}

		$params = array(
			'ImageId'					=> $this->data[$this->alias]['image_id'],
			'KeyName'					=> $this->data[$this->alias]['key_pair'],
			'InstanceType' 		=> $this->data[$this->alias]['instance_type'],
			'InstanceId'			=> $this->data[$this->alias]['instanceid'],
			'AccountingType'	=> $this->data[$this->alias]['accounting_type'],
			'Password'				=> $this->data[$this->alias]['password'],
			'SecurityGroup' 	=> $this->data[$this->alias]['security_group'],
		);
		$api_result = $this->api->run_instances($params);
		return !$this->api->isError();
	}

	public function attr()
	{
		if (is_null($this->api)) {
			$config = Configure::read('nifty_cloud');
			$this->api = new NiftyCloud($config);
		}

		$params = array(
			'InstanceId'	=> $this->data[$this->alias]['id'],
			'Attribute'		=> 'disableApiTermination',
			'Value'				=> ($this->data[$this->alias]['value'])?'true':'false',
		);
		$api_result = $this->api->modify_instance_attribute($params);
		return !$this->api->isError();
	}

	public function terminate()
	{
		if (is_null($this->api)) {
			$config = Configure::read('nifty_cloud');
			$this->api = new NiftyCloud($config);
		}

		$params = array(
			'InstanceId'	=> $this->data[$this->alias]['id'],
		);
		$api_result = $this->api->terminate_instances($params);
		return !$this->api->isError();
	}
}

