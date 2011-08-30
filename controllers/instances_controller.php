<?php
class InstancesController extends AppController {

	var $name = 'Instances';

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
		$this->set('instances', $this->Instance->find('all'));
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
}
