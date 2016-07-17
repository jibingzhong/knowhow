<?php
namespace Home\Controller;
use Think\Controller;


class AskController extends Controller {
	
	
		function addOneAsk(){
			$a=D('Ask','Service');
			$t=D('AskTag');
			$data=I('post.');
			$arr['title']=$data['title'];
			$arr['content']=$data['content'];
			$arr['uid']=session('uid');
			$askid=$a->createAsk($arr);
			$sql="insert into t_ask_tag(askid,tagid) values";
			forEach($data['type'] as $val){
				$sql.="('$askid','$val'),";
			}
			$sql=rtrim($sql,',');
			$this->ajaxReturn($t->execute($sql));
		}
		/**
		  * 作者		戢炳忠
		  * 函数的描述 根据不同排序展示所有问题
		  * 参数列表
		  * 	$sort=》排序方式	
		  *		$page=1 =》分页展示，默认为第一页
		  *		$pagesize=5 =》分页默认展示条数
		  * 返回值	返回所有问题的结果集
		  * 函数被访问的接口列表
		  * 	
		  * */
		function showAllAsks($sort,$page=1,$pagesize=5){
			$a=D('Ask','Service');
			$list=$a->showAllAsk($sort,$page,$pagesize);
			$this->ajaxReturn($list);
		}
		
		/**
		 * 作者		戢炳忠
		 * 函数的描述 根据tid不同排序展示所有问题
		 * 参数列表
		 * 	$sort=》排序方式
		 *		$page=1 =》分页展示，默认为第一页
		 *		$pagesize=5 =》分页默认展示条数
		 * 返回值	返回所有问题的结果集
		 * 函数被访问的接口列表
		 *
		 * */
		function showAllAsksByTag($tsort,$tid,$page=1,$pagesize=5){
			$a=D('Ask','Service');
			$list=$a->showAllAskByTag($tsort,$tid,$page,$pagesize);
// 			print_r($list);
			$this->ajaxReturn($list);
		}
		/**
		 * 作者		戢炳忠
		 * 函数的描述 根据aid展示单个问题
		 * 参数列表
		 * 
		 * 	$aid=》问题ID
		 * 
		 * 返回值	返回单个问题的结果集
		 * 函数被访问的接口列表
		 *
		 * */
		function showOneAskInfo($aid){
			$ask=D('Ask','Service');
			$ans=D('Answer','Service');
			$rs=$ask->showOneAsk($aid);
			$rs1=$ans->showOneAskAswer($aid);
			$rs['answers']=$rs1;
			$rs['ansnum']=count($rs1);
			$this->ajaxReturn($rs);
		}
		
		/**
		 * 作者		戢炳忠
		 * 函数的描述 赞踩
		 * 参数列表
		 *
		 * 	$aid=》问题ID
		 * 	$opt=>执行的何种操作
		 *
		 * 返回值	返回操作结果
		 * 函数被访问的接口列表
		 *
		 * */
		function up_down($aid,$opt) {
			$a=D('Ask','Service');
			$arr['askid']=$aid;
			$arr['uid']=session('uid');
			if($a->createAskOpt($arr)){
				return $this->ajaxReturn($a->optAsk($aid,$opt));
			}
			
		}
}