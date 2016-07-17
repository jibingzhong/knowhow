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
			$ansid=$ask->add();
			return $ask->relation('userinfo')->where("id='$ansid'")->find();
		}else {
			return $ask->getError();
		}
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据问题ID查询问题回复,通过投票排序高->低
	 * 参数列表
	 * 	$askid
	 * 返回值	使用ADD方法，成功后返回此问题的ID
	 * 函数被访问的接口列表
	 * 	AskController
	 * */
	
	public function queryAnswerByVotes($askid,$showpage=1,$pagesize=10){
		$a=D('Answer');
		$u=D('Userinfo');
		$rs=$a->relation('userinfo')->where("askid=$askid")->order('(zan-cai) desc')->page($showpage,$pagesize)->select();
		foreach ($rs as $key=>$val){
			foreach ($val[ansnotes] as $k1=>$v){
					$user=$u->field('id,name,reputation')->find($v[uid]);
					$rs[$key][ansnotes][$k1][user]=$user;
			}
		}
		return $rs;
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据问题ID查询问题回复,通过发表时间排序近->远
	 * 参数列表
	 * 	$askid
	 * 返回值	使用ADD方法，成功后返回此问题的ID
	 * 函数被访问的接口列表
	 * 	AskController
	 * */
	
	public function queryAnswerByTime($askid){
		$a=D('Answer');
		$u=D('Userinfo');
		$rs=$a->relation(true)->where("askid=$askid")->order('publishTime desc')->select();
		foreach ($rs as $key=>$val){
			foreach ($val[ansnotes] as $k1=>$v){
				$user=$u->field('id,name,reputation')->find($v[uid]);
				$rs[$key][ansnotes][$k1][user]=$user;
			}
		}
		return $rs;
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传$aid,$ansid修改ask的赞
	 * 参数列表	$Askid(回复ID)
	 * $ansid 回复ID
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function updateUp($aid,$ansid){
		$a=D('Answer');
		return $a->where("id=$ansid and askid= $aid")->setInc('zan',1); // 回复的zan加1
	}
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传$aid,$ansid修改ans的cai
	 * 参数列表	$Askid(回复ID)
	 * $ansid 回复ID
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function updateDown($aid,$ansid){
		$a=D('Answer');
		return $a->where("id=$ansid and askid= $aid")->setInc('cai',1); // 回复的cai加1
	}
	
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  插入一个操作
	 * 参数列表 $arr
	 * 返回值	使用ADD方法，成功后返回此问题的ID
	 * 函数被访问的接口列表
	 * 	AskController
	 *
	 * */
	
	public function insertAnsOpt($arr){
		$a=D('AnsOpt');
		if($a->create($arr)){
			return $a->add();
		}
	}
}

?>