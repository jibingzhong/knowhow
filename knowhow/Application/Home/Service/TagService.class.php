<?php
namespace Home\Service;
use Think\Model;

class TagService extends Model{
		/**
		  * 作者		戢炳忠
		  * 函数的描述  新增一个标签
		  * 参数列表
		  * 	$arr=>array(	
		  *			tagname   '标签名字',
		  *			tagdes  '标签描述',
		  *			uid  '用户ID',
		  * 	)
		  * 返回值	使用ADD方法，成功后返回此标签的ID
		  * 函数被访问的接口列表
		  * 	 AsknoteController
		  * */
		
	public function createTag($arr){
		
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述	查询所有标签以及对应的问题(同时需要将今天，以及本周此标签所相关问题的条数查出来)
	  ｛
	 	type:
	 	 
	  
	  ｝
	 * 返回值
	 * 函数被访问的接口列表     
	 *
	 * */
	public function showAllTag($sort,$page,$pagesize){
		$a=D('Tag','Logic');
		switch ($sort){
			case 'hot':
				return $a->queryAllTagByHot($page,$pagesize);
				break;
			case 'word':
				return $a->queryAllTagByName($page,$pagesize);
				break;
			case 'newest':
				return $a->queryAllTagByNewest($page,$pagesize);
				break;
		}
 		
 		
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述	查询一个标签对应的所有问题(同时需要将问题的其他标签展示)
	 * 参数列表	$tagname=>标签名
	 * 返回值		与标签相关的问题信息
	 * 函数被访问的接口列表
	 *		TagController
	 * */
	public function showOneTag($tagname){
	
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述	查询用户所创建的标签
	 * 参数列表	$uid=>用户名
	 * 返回值		与标签相关的问题信息
	 * 函数被访问的接口列表
	 *		UserController
	 * */
	public function showTagByUser($uid){
	
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述	查询用户所创建的标签
	 * 参数列表	$uid=>用户名
	 * 返回值		与标签相关的问题信息
	 * 函数被访问的接口列表
	 *		UserController
	 * */
	public function showAllTags(){
		$a=D('Tag','Logic');
		return $a->queryAllTags();
	}
}

?>