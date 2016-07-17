<?php
namespace Home\Logic;

use Think\Model;

class AskLogic extends Model{
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
		  *
		  * */
	
	public function insertAsk($arr){
		$ask=D('Ask');
		if($ask->create($arr)){
			return $ask->add();
		}else {
			return $ask->getError();
		}
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  修改问题
	 * 参数列表
	 * 	$arr=>array(
	 * 	)
	 * 返回值	使用save方法，成功后返回修改了的条数
	 * 函数被访问的接口列表
	 * 	AskController
	 *
	 * */
	
	public function updateAsk($arr){
		$ask=D('Ask');
		if($ask->create($arr)){
			return $ask->save();
		}else {
			return $ask->getError();
		}
	}
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传$Askid修改ask的赞
	 * 参数列表	$Askid(回复ID)
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function updateUp($aid){
		$ask=D('Ask');
		return $ask->where("id=$aid")->setInc('zan',1); // 用户的zan加1	
	}
	/**
	 * 作者		戢炳忠
	 * 函数的描述  根据所传$Askid修改ask的赞
	 * 参数列表	$Askid(回复ID)
	 * 返回值		布尔值
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function updateDown($aid){
		$ask=D('Ask');
		return $ask->where("id=$aid")->setInc('cai',1); // 用户的cai加1
	}
	
	
	/**
	 * 作者		戢炳忠
	 * 函数的描述  插入一个操作
	 * 参数列表
	 * 返回值	使用ADD方法，成功后返回此问题的ID
	 * 函数被访问的接口列表
	 * 	AskController
	 *
	 * */
	
	public function insertAskOpt($arr){
		$ask=D('AskOpt');
		if($ask->create($arr)){
			return $ask->add();
		}
	}
	/**
	 * 作者		戢炳忠
	 * 函数的描述  插入一个再编辑
	 * 参数列表
	 * 	$arr=>array(
	 *			aid   '问题ID',
	 *			aftercontent   '修改后内容',
	 *			edittime   '发布时间',
	 *			uid  '编辑人id',
	 * 	)
	 * 返回值	使用ADD方法，成功后返回此问题的ID
	 * 函数被访问的接口列表
	 * 	AskController
	 *
	 * */
	
	public function insertAskinfo($arr){
		$ask=D('Askinfo');
		if($ask->create($arr)){
			return $ask->add();
		}else {
			return $ask->getError();
		}
	}
	
	private function sort($sql){
		$m=D('Ask');
		$rs=$m->query($sql);
		$total=$m->count('id');
		foreach ($rs as $key=>$val){
			$tag=($m->where("id=$val[id]")->relation(array('tags','username','answers'))->find());
			$rs[$key]['ansnum']=count($tag['answers']);
			$rs[$key]['userinfo']=$tag['username'];
			$rs[$key]['tag']=$tag['tags'];
			$rs[$key]['total']=$total;
		}
		return $rs;
	}
	/**
	 * 作者		  戢炳忠
	 * 函数的描述         根据回复、编辑、发布的最新时间查询所有首页展示问题
	 * 参数列表	null
	 * 参数列表	
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表     
	 *		AskController
	 * */
	public function queryTopAskByTime(){
		$sql="select id,title,content,zan,cai,viewCount,asktype,bounty,uid, acceptid,editTime,
		publishTime,answerTime,if(editTime>=answerTime,editTime,answerTime) as time from t_ask 
		group by id order by time desc limit 100";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		 戢炳忠
	 * 函数的描述  最近3天被查看数、被回答、被投票多少 最近查询所有首页展示问题
	 * 参数列表	null
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryTopAskByHot(){
		$sql="select ts.id,ts.title,ts.content,ts.zan,ts.cai,ts.viewCount,ts.asktype,ts.bounty,ts.uid, ts.acceptid,
		ts.editTime,ts.publishTime,ts.answerTime,if(ts.editTime>=ts.answerTime,ts.editTime,ts.answerTime) as time, 
		(select count(ta.id) from t_answer as ta where ta.askid=ts.id) as ansnum from t_ask as ts where DATE_SUB(CURDATE(),INTERVAL 3 DAY)<=date(ts.publishTime) group by id order by viewCount desc,
		ansnum desc, (ts.zan-ts.cai) desc";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		 戢炳忠
	 * 函数的描述  本周被查看数、被回答、被投票多少查询所有首页展示问题
	 * 参数列表	null
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryTopAskByHotLastWeek(){
		$sql="select ts.id,ts.title,ts.content,ts.zan,ts.cai,ts.viewCount,ts.asktype,ts.bounty,ts.uid, ts.acceptid,ts.editTime,
		ts.publishTime,ts.answerTime,if(ts.editTime>=ts.answerTime,ts.editTime,ts.answerTime) as time,
		(select count(ta.id) from t_answer as ta where ta.askid=ts.id) as ansnum from t_ask as ts where yearweek(ts.publishTime)= yearweek(now()) group by id order by viewCount desc,
		ansnum desc, (ts.zan-ts.cai) desc";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		 戢炳忠
	 * 函数的描述  本月被查看数、被回答、被投票多少查询所有首页展示问题
	 * 参数列表	null
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryTopAskByHotLastMonth(){
		$sql="select ts.id,ts.title,ts.content,ts.zan,ts.cai,ts.viewCount,ts.asktype,ts.bounty,ts.uid, ts.acceptid,
		ts.editTime,ts.publishTime,ts.answerTime,if(ts.editTime>=ts.answerTime,ts.editTime,ts.answerTime) as time,
		(select count(ta.id) from t_answer as ta where ta.askid=ts.id) as ansnum from t_ask as ts where DATE_FORMAT(ts.publishTime,'%Y%m')= DATE_FORMAT(CURDATE(),'%Y%m') group by id order by viewCount desc,
		ansnum desc, (ts.zan-ts.cai) desc";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		 戢炳忠
	 * 函数的描述  总查看数多少查询所有问题展示页面
	 * 参数列表	null
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryALlAskByFrequent($page,$pagesize){
		$p=($page-1)*$pagesize;
		$sql="select id,title,content,zan,cai,viewCount,uid,publishTime,acceptid from t_ask 
		group by id order by viewCount desc,publishTime desc limit $p,$pagesize";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		 戢炳忠
	 * 函数的描述  总投票数多少查询所有问题展示页面
	 * 参数列表	null
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryALlAskByVotes($page,$pagesize){
		$p=($page-1)*$pagesize;
		$sql="select id,title,content,zan,cai,viewCount,uid,publishTime,acceptid 
		from t_ask group by id order by (zan-cai) desc,publishTime desc limit $p,$pagesize";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		  戢炳忠
	 * 函数的描述  根据回复、编辑、发布的最新时间查询所有问题
	 * 参数列表	
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryAllAskByActive($page,$pagesize){
		$p=($page-1)*$pagesize;
		$sql="select id,title,content,zan,cai,viewCount,asktype,bounty,uid, acceptid,editTime,publishTime,answerTime,
			if(editTime>=answerTime,editTime,answerTime) as time from t_ask group by id order 
			by time desc limit $p,$pagesize";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		  戢炳忠
	 * 函数的描述  根据发布的最新时间查询所有问题
	 * 参数列表
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryAllAskByNewest($page,$pagesize){
		$p=($page-1)*$pagesize;
		$sql="select id,title,content,zan,cai,viewCount,uid, acceptid,publishTime
		from t_ask group by id order by publishTime desc limit $p,$pagesize";
		return $this->sort($sql);
	}
	/**************************************************************************/
	/**
	 * 作者		 戢炳忠
	 * 函数的描述  	通过标签总查看数多少查询所有问题展示页面
	 * 参数列表	$tid=>标签ID
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryALlAskByFrequentAndTag($tid,$page,$pagesize){
		$p=($page-1)*$pagesize;
		$sql="select ta.id,ta.title,ta.content,ta.zan,ta.cai,ta.viewCount,ta.uid,ta.publishTime,ta.acceptid 
		from t_ask as ta join t_ask_tag tat on(ta.id=tat.askid) where tat.tagid='$tid' group by id order 
		by viewCount desc,publishTime desc limit $p,$pagesize";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		 戢炳忠
	 * 函数的描述  通过标签总投票数多少查询所有问题展示页面
	 * 参数列表	null
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryALlAskByVotesAndTag($tid,$page,$pagesize){
		$p=($page-1)*$pagesize;
		$sql="select ta.id,ta.title,ta.content,ta.zan,ta.cai,ta.viewCount,ta.uid,ta.publishTime,ta.acceptid 
		from t_ask as ta join t_ask_tag tat on(ta.id=tat.askid) where tat.tagid='$tid' 
		group by ta.id order by (ta.zan-ta.cai) desc,ta.publishTime desc limit $p,$pagesize";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		  戢炳忠
	 * 函数的描述  通过标签根据回复、编辑、发布的最新时间查询所有问题
	 * 参数列表
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryAllAskByActiveAndTag($tid,$page,$pagesize){
		$p=($page-1)*$pagesize;
		$sql="select ta.id,ta.title,ta.content,ta.zan,ta.cai,ta.viewCount,ta.uid,ta.publishTime,ta.acceptid,ta.editTime,
		ta.publishTime,ta.answerTime,if(ta.editTime>=ta.answerTime,ta.editTime,ta.answerTime) as time from t_ask as ta 
		join t_ask_tag tat on(ta.id=tat.askid) where tat.tagid='$tid' group by ta.id order by time desc limit $p,$pagesize";
		return $this->sort($sql);
	}
	
	/**
	 * 作者		  戢炳忠
	 * 函数的描述  通过标签=>根据发布的最新时间查询所有问题
	 * 参数列表
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryAllAskByNewestAndTag($tid,$page,$pagesize){
		$p=($page-1)*$pagesize;
		$sql="select ta.id,ta.title,ta.content,ta.zan,ta.cai,ta.viewCount,ta.uid,ta.publishTime,ta.acceptid 
		from t_ask as ta join t_ask_tag tat on(ta.id=tat.askid) where tat.tagid='$tid' group by ta.id 
		order by ta.publishTime desc limit $p,$pagesize";
		return $this->sort($sql);
	}
	/**********************************************************************************************/
	/**
	 * 作者		  戢炳忠
	 * 函数的描述  根据ASKID获取某个问题的详细信息
	 * 参数列表	$askid=>问题ID
	 * 返回值		问题详细信息的集合
	 * 函数被访问的接口列表
	 *		AskController
	 * */
	public function queryOneAskByAskid($askid){
		$a=D('Ask');
		$rs=$a->relation(array('asknotes','askinfos','tags','userinfo'))->find($askid);
		foreach ($rs[asknotes] as $k1=>$asknote){
				$asknoteuid=$u->field('id,name,reputation,url')->find($asknote[uid]);
				$rs[asknotes][$k1][user]=$asknoteuid;
			}
		foreach ($rs[askinfos] as $k1=>$askinfo){
				$askinfouid=$u->field('id,name,reputation,url')->find($askinfo[uid]);
				$rs[askinfos][$k1][user]=$askinfouid;
			}
		return $rs;
	}
	
}

?>