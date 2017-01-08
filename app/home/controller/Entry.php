<?php namespace app\home\controller;

use yykweb\yuming\Yuming;

class Entry {
	public function index() {
		$data = array(
				"entityname"=>"domain-check",
				"domainname"=>"youyike",
				"suffix"=>".com,.cn,.com.cn"
		);
		$order_id = rand(000000000,999999999);
		//echo $order_id;
		$domain = Yuming::get('check',$data,$order_id);
		if($domain['returncode'] == 200)
		{
			$arr = $domain['info']['record'];
			print_r($arr);
		}
	}
}