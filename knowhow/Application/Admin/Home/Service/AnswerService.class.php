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
		
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据askid查询回复(需要分页)
	 * 参数列表	$askid=>问题ID
	 * 返回值		当前问题所有回复的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function showAnswer($askid,$showpage=1,$perPage = 20){
		
		
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
	 * 函数的描述  根据所传条件数组修改回复
	 * 参数列表	$arr=>$uid,id(回复ID),修改的内容
	 * 返回值		使用save方法，返回被影响的条数
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function updateAnswer($arr){
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传$Answerid修改answer的赞
	 * 参数列表	$Answerid(回复ID)
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AnswerController
	 * */
	public function zanAnswer($Answerid){
	}
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传$Answerid修改answer的踩
	 * 参数列表	$Answerid(回复ID)
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AnswerController
	 * */
	
	public function caiAnswer($Answerid){
		
	}
	
	
}

?>