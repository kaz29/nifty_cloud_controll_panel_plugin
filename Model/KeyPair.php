<?php
require_once(ROOT.DS.'vendors'.DS.'NiftyCloud'.DS.'services'.DS.'niftycloud.class.php');
class KeyPair extends AppModel {
	public 	$useTable = false;
	private $api = null;
	
	public function find($type, $conditions=array())
	{
		if (is_null($this->api)) {
			$config = Configure::read('nifty_cloud');
			$this->api = new NiftyCloud($config);
		}
		
		$result = false ;
		$api_result = $this->api->describe_key_pairs();
		if ( $this->api->isError() ) {
			$result = array();
		} else {
			$result = array();
			foreach($api_result->keySet->item as $item) {
				if ( $type === 'list' ) {
					$result[(string)$item->keyName] = (string)$item->keyName;
				} else {
					$result[] = array(
						$this->alias => array(
							'name'					=> (string)$item->keyName,
						)
					);
				}
			}
		}
		
		return $result;
	}
}