<?php
namespace Home\Controller;
use Think\Controller;

class TestController extends Controller{
		public function aaa(){
			$m=D('Ask');

			$rs=$m->relation('asknotes')->select();
 			print_r($rs);
// 			$rs1=$n->relation('userinfo')->select();
			
		}	

}

?>