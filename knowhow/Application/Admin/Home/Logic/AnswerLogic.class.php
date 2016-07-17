<?php
namespace Home\Logic;
use Think\Model;

class AnswerLogic extends Model{
		/**
		  * 作者		戢炳忠
		  * 函数的描述  插入一个问题回复
		  * 参数列表
		  * 	$arr=>array(	
		  *			content    '回复内容',
		  *			'askid'	回复问题ID
		  * 	)
		  * 返回值	使用ADD方法，成功后返回此问题的ID
		  * 函数被访问的接口列表
		  * 	AskController
		  * */
		
	public function insertAnswer($arr){
		$ask=D('Answer');
		if($ask->create($arr)){
			$ask->add();
		}else {
			$ask->getError();
		}
	}
	
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据问题ID查询问题回复
	 * 参数列表
	 * 	$askid
	 * 返回值	使用ADD方法，成功后返回此问题的ID
	 * 函数被访问的接口列表
	 * 	AskController
	 * */
	
	public function queryAnswer($askid){
		$a=D('Answer');
		$u=D('Userinfo');
		$rs=$a->relation(true)->where("askid=$askid")->select();
		foreach ($rs as $key=>$val){
			foreach ($val[ansnotes] as $k1=>$v){
					$user=$u->field('id,name,reputation')->find($v[uid]);
					$rs[$key][ansnotes][$k1][user]=$user;
			}
		}
		return $rs;
	}
	
	
}

?>