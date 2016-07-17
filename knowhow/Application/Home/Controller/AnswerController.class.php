<?php
namespace Home\Controller;
use Think\Controller;


class AnswerController extends Controller {
	
	
		function addAnswer(){
 			$val=I('post.content');
			$a=D('Answer','Service');
			$this->ajaxReturn($a->createAnswer($arr));
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
		function up_down($aid,$ansid,$opt) {
			$a=D('Answer','Service');
			$arr['askid']=$aid;
			$arr['ansid']=$ansid;
			$arr['uid']=session('uid');
			if($a->createAnsOpt($arr)){
				return $this->ajaxReturn($a->optAnswer($aid,$ansid,$opt));
			}
			
		}
}