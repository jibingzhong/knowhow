<?php
namespace Home\Controller;
use Think\Controller;


class TagController extends Controller {
	
		function showAllTags($sort,$page=1,$pagesize=5){
			$a=D('Tag','Service');
			$list=$a->showAllTag($sort,$page,$pagesize);
 			$this->ajaxReturn($list);
		}
		
		function getAllTags(){
			$a=D('Tag','Service');
// 			dump($a->showAlltags());
			$this->ajaxReturn($a->showAlltags());
		}
		
}