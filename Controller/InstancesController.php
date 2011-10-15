<?php
class InstancesController extends AppController {

	var $name = 'Instances';
	public $uses = array(
		'NiftyCloudControllPanel.Instance', 
		'NiftyCloudControllPanel.KeyPair',
		'NiftyCloudControllPanel.SecurityGroup',
	);
	
	function beforeFilter()
	{
			// OSイメージ一覧もAPIで取得可能ですが、今回は出来るだけ単純な構成にする為にプログラム内部で定義しています
		$images = array(
			1		=> 'CentOS 5.3 32bit Plain',
			2		=> 'CentOS 5.3 64bit Plain',
			3		=> 'Red Hat Enterprise Linux 5.3 32bit',
			4		=> 'Red Hat Enterprise Linux 5.3 64bit',
			6		=> 'CentOS 5.3 32bit Server',
			7		=> 'CentOS 5.3 64bit Server',
			12	=> 'Microsoft Windows Server 2008 R2',
			13	=> 'CentOS 5.6 64bit Plain',
			14	=> 'CentOS 5.6 64bit Server',
		);
		
		$instance_types = array(
			'mini'		=> 'mini 1vCPU（1GHz）/512MB',
			'small'		=> 'small 1vCPU（3GHz）/1GB',
			'small2'	=> 'small2 1vCPU（3GHz）/2GB',
			'small4'	=> 'small4 1vCPU（3GHz）/4GB',
			'medium'	=> 'medium 2vCPU（3GHz）/2GB',
			'medium4'	=> 'medium4 2vCPU（3GHz）/4GB',
			'medium8'	=> 'medium8 2vCPU（3GHz）/8GB',
			'large'		=> 'large 4vCPU（3GHz）/4GB',
			'large8'	=> 'large8 4vCPU（3GHz）/8GB',
			'large16'	=> 'large16 4vCPU（3GHz）/16GB',
			'large24'	=> 'large24 4vCPU（3GHz）/24GB',
			'large32'	=> 'large32 4vCPU（3GHz）/32GB',
		);
		
		$this->set(compact('images', 'instance_types'));
	}
	
	function index() 
	{
		$this->Instance->recursive = 0;
		$instances = $this->Instance->find('all');
		$this->set(compact('instances'));
	}
	
	public function stop($id=null)
	{
		if ( empty($this->data) ) {
			$this->data = array(
				'Instance' => array(
					'id' => $id,
				)
			);
			
		} else {
			$this->Instance->create();
			$this->Instance->set($this->data);
			$result = $this->Instance->stop();
			if ( $result === true ) {
				$this->Session->setFlash(__('The instance has been stopped', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instance could not be stop. Please, try again.', true));
			}
		}
	}
	
	public function start($id=null)
	{
		if ( empty($this->data) ) {
			$this->data = array(
				'Instance' => array(
					'id' => $id,
				)
			);
			
		} else {
			$this->Instance->create();
			$this->Instance->set($this->data);
			$result = $this->Instance->start();
			if ( $result === true ) {
				$this->Session->setFlash(__('The instance has been started', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instance could not be start. Please, try again.', true));
			}
		}
	}

	public function run($id=null)
	{
			// SSHキー一覧を取得
		$key_pairs = $this->KeyPair->find('list');
		if ( empty($key_pairs) ) {
				$this->Session->setFlash(__('Could not get key pairs.', true));
				$this->redirect(array('action' => 'index'));
		}
			// Firewall一覧を取得
		$security_groups = $this->SecurityGroup->find('list');
		if ( empty($security_groups) ) {
				$this->Session->setFlash(__('Could not get security groups.', true));
				$this->redirect(array('action' => 'index'));
		}		
		$this->set(compact('key_pairs', 'security_groups'));
		
		if ( $this->data ) {
			$this->Instance->create();
			$this->Instance->set($this->data);
			$result = $this->Instance->run();
			if ( $result === true ) {
				$this->Session->setFlash(__('The instance has been created', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instance could not be create. Please, try again.', true));
			}
		}
	}
	
	public function attr($id=null)
	{
		if ( empty($this->data) ) {
			$conditions = array(
				'id'		=> $id,
				'type'	=> 'disableApiTermination',
			);
			$result = $this->Instance->find('attr', $conditions);
			if ( $result === null ) {
				$this->Session->setFlash(__('Could not get instance attribute. Please, try again.', true));
				$this->redirect(array('action' => 'index'));
				return ;
			}
			$this->data = array(
				'Instance' => array(
					'id'		=> $id,
					'value'	=> $result,
				)
			);
			
		} else {
			$this->Instance->create();
			$this->Instance->set($this->data);
			$result = $this->Instance->attr();
			if ( $result === true ) {
				$this->Session->setFlash(__('The instance attribute has been changed', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instance attribute could not be change. Please, try again.', true));
			}
		}
	}
	
	public function terminate($id=null)
	{
		if ( empty($this->data) ) {
			$this->data = array(
				'Instance' => array(
					'id'		=> $id,
				)
			);
		} else {
			$this->Instance->create();
			$this->Instance->set($this->data);
			$result = $this->Instance->terminate();
			if ( $result === true ) {
				$this->Session->setFlash(__('The instance attribute has been terminated', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instance could not be terminate. Please, try again.', true));
			}
		}
	}
}
