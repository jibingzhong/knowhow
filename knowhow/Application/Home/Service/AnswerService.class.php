<?php
namespace Home\Service;
use Think\Model;

class AnswerService extends Model{
		/**
		  * 作者		戢炳忠
		  * 函数的描述  插入一条回复
		  * 参数列表
		  * 	$arr=>array(	
		  *			askid  '问题ID',
		  *			content  '回复内容',
		  *			uid  '用户ID',
		  * 	)
		  * 返回值	使用ADD方法，成功后返回此回复的ID
		  * 函数被访问的接口列表
		  * 	AnswerController
		  * */
		
	public function createAnswer($arr){
		$ans=D('Answer','Logic');
		return $ans->insertAnswer($arr);
	}
	
	
	public function showOneAskAswer($aid){
		$ans=D('Answer','Logic');
		return $ans->queryAnswerByVotes($aid);
	}
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据askid查询回复(需要分页)
	 * 参数列表	$askid=>问题ID
	 * 			$anstab=>votes newest排序
	 * 返回值		当前问题所有回复的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function showAnswerByTab($askid,$anstab='votes'){
		$ans=D('Answer','Logic');
		switch ($anstab){
			case 'votes':
			return $ans->queryAnswerByVotes($askid);
			case 'newest':
			return $ans->queryAnswerByTime($askid);
		}
		
	}
	
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据$uid查询本人的所有回复
	 * 参数列表	$uid=>用户ID
	 * 返回值		当前问题所有回复的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function showAnswerByUser($uid,$showpage=1,$perPage = 5){
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传$Answerid修改answer的赞 cai
	 * 参数列表	$ansid(回复ID)
	 * 			$opt 执行的操作
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AnswerController
	 * */
	public function optAnswer($aid,$ansid,$opt){
		$a=D('Answer','Logic');
		if($opt=='up'){
			return $a->updateUp($aid,$ansid);
		}else if($opt=='down'){
			return $a->updateDown($aid,$ansid);
		}
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述 	 up down后插入一个操作
	 * 参数列表	$arr
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function createAnsOpt($arr){
		$a=D('Answer','Logic');
		return $a->insertAnsOpt($arr);
	}

}

?>