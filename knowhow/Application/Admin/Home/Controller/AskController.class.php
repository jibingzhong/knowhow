<?php
namespace Home\Controller;
use Think\Controller;
class AskController extends Controller {
		function ask(){
// 			$m=D('Ask','Logic');
			$m=D('Answer','Logic');
			//print_r($m->queryTopAskByHot());
// 			print_r($m->queryTopAskByHotLastWeek());
			print_r($m->queryAnswer(1));
			//$m=D('Ask');
			//$sql="SELECT * FROM t_ask WHERE yearweek(publishTime)= yearweek(now()) ";
			//$sql="SELECT * FROM t_ask WHERE date_format(publishTime, '%Y%m%d') = date_format(NOW(),'%Y%m%d')";
			
			//print_r($m->query($sql));
		}
}