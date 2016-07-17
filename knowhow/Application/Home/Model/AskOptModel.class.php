<?php
namespace Home\Model;
use Think\Model\RelationModel;

class AskOptModel extends RelationModel{
	/**
	 * 作者		戢炳忠
	 * 表间关系 :
	 * 		userinfo=>ans与userinfo(问题对应的人)之间的关系(多对一)
	 * */
	protected $_auto=array(
			array('votetime','getTime',1,'callback')
	);
	function getTime(){
		return date('Y-m-d H:i:s',time());
	}
}

?>