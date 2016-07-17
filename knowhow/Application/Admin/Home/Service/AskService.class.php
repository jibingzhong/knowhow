<?php
namespace Home\Service;
use Think\Model;

class AskService extends Model{
		/**
		  * 作者		戢炳忠
		  * 函数的描述  插入一个普通问题
		  * 参数列表
		  * 	$arr=>array(	
		  *			title varchar(255) not null '问题主题',
		  *			content text not null '问题内容',
		  *			publishTime datetime comment '发布时间',
		  *			uid int comment '用户ID',
		  * 	)
		  * 返回值	使用ADD方法，成功后返回此问题的ID
		  * 函数被访问的接口列表
		  * 	AskController
		  * */
		
	public function createAsk($arr){
		
	}
	
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  插入一条编辑后的问题信息
	 * 参数列表
	 * 	$arr=>array(
	 *			aid   '问题ID',
	 *			aftercontent   '修改后内容',
	 *			edittime  datetime comment '发布时间',
	 *			uid  '编辑人id',
	 * 	)
	 * 返回值	使用ADD方法，成功后返回此编辑问题的ID
	 * 函数被访问的接口列表
	 * 	AskController
	 * */	
	public function createAskinfo($arr){
	
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  查询所有问题并排序(包括标签，以及相关人物信息)
	 * 参数列表	$sort=
	 * 			active(按照编辑时间排序,默认),
	 * 			votes(按照投票时间排序),
	 * 			frequent(按照被点击次数排序),
	 * 			newest(按照最新发布时间排序),
	 * 			featured(有悬赏的排序)
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function showAllAsk($sort,$showpage=1,$perPage = 15){
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  按条件查询部分首页展示问题，有限制的展示(包括标签，以及相关人物信息)
	 * 参数列表	tab=interesting,hot,week,featured,month
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表     
	 *		AskController
	 * */
	public function showTopAsk($tab){
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据ASKID和TITLE查询一个问题的信息(包含发布者信息,用户，编辑信息，标签)
	 * 参数列表	$askid=>问题ID
	 * 			$title=>问题标题
	 * 返回值		问题信息,发布者，编辑信息内容
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function showOneAsk($askid,$title){
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据uid查询本人所发表的问题
	 * 参数列表	$uid=>用户
	 * 返回值		array
	 * 函数被访问的接口列表
	 *		UserController
	 * */
	public function showAskByUser($uid){
	}
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传条件数组修改问题
	 * 参数列表	$arr=>askid,修改的内容
	 * 返回值		使用save方法，返回被影响的条数
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function modifyAsk($arr){
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传$Askid修改ask的赞
	 * 参数列表	$Askid(回复ID)
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function zanAsk($Askid){
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传$Askid修改ask的踩
	 * 参数列表	$Askid(回复ID)
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function caiAsk($Answerid){
	}

}

?>