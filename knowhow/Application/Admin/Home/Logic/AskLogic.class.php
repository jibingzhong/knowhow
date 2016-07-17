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
		  * */
		
	public function insertAsk($arr){
		$ask=D('Ask');
		if($ask->create($arr)){
			$ask->add();
		}else {
			$ask->getError();
		}
	}
	
	private function sort($sql){
		$m=D('Ask');
		$rs=$m->query($sql);
		foreach ($rs as $key=>$val){
			$tag=($m->where("id=$val[id]")->relation(array('tags','username','answers'))->find());
			$rs[$key]['ansnum']=count($tag['answers']);
			$rs[$key]['userinfo']=$tag['username'];
			$rs[$key]['tag']=$tag['tags'];
		}
		return $rs;
	}
	/**
	 * 作者		  戢炳忠
	 * 函数的描述  根据回复、编辑、发布的最新时间查询所有首页展示问题
	 * 参数列表	null
	 * 参数列表	
	 * 返回值		所有问题的集合
	 * 函数被访问的接口列表     
	 *		AskController
	 * */
	public function queryTopAskByTime(){
		$sql="select id,title,content,zan,cai,viewCount,asktype,bounty,uid, acceptid,editTime,publishTime,answerTime,
			(case when ifnull(editTime,0)>(case when publishTime > ifnull(answerTime,0) 
			then publishTime else answerTime end) then  editTime else (case when publishTime > ifnull(answerTime,0) 
			then publishTime else answerTime end) end) as time from t_ask group by id order by time desc limit 100";
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
		$sql="select ts.id,ts.title,ts.content,ts.zan,ts.cai,ts.viewCount,ts.asktype,ts.bounty,ts.uid, ts.acceptid,ts.editTime,ts.publishTime,ts.answerTime,
		(case when ifnull(ts.editTime,0)>(case when ts.publishTime > ifnull(ts.answerTime,0) then ts.publishTime else ts.answerTime end) 
		then  ts.editTime else (case when ts.publishTime > ifnull(ts.answerTime,0) then ts.publishTime else ts.answerTime end) end) as time, 
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
		$sql="select ts.id,ts.title,ts.content,ts.zan,ts.cai,ts.viewCount,ts.asktype,ts.bounty,ts.uid, ts.acceptid,ts.editTime,ts.publishTime,ts.answerTime,
		(case when ifnull(ts.editTime,0)>(case when ts.publishTime > ifnull(ts.answerTime,0) then ts.publishTime else ts.answerTime end)
		then  ts.editTime else (case when ts.publishTime > ifnull(ts.answerTime,0) then ts.publishTime else ts.answerTime end) end) as time,
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
		$sql="select ts.id,ts.title,ts.content,ts.zan,ts.cai,ts.viewCount,ts.asktype,ts.bounty,ts.uid, ts.acceptid,ts.editTime,ts.publishTime,ts.answerTime,
		(case when ifnull(ts.editTime,0)>(case when ts.publishTime > ifnull(ts.answerTime,0) then ts.publishTime else ts.answerTime end)
		then  ts.editTime else (case when ts.publishTime > ifnull(ts.answerTime,0) then ts.publishTime else ts.answerTime end) end) as time,
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
	public function queryALlAskByFrequent(){
		$sql="select id,title,content,zan,cai,viewCount,uid,publishTime,acceptid from t_ask group by id order by  viewCount desc,publishTime desc";
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
	public function queryALlAskByVotes(){
		$sql="select id,title,content,zan,cai,viewCount,uid,publishTime,acceptid from t_ask group by id order by (zan-cai) desc,publishTime desc";
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
	public function queryAllAskByActive(){
		$sql="select id,title,content,zan,cai,viewCount,asktype,bounty,uid, acceptid,editTime,publishTime,answerTime,
			(case when ifnull(editTime,0)>(case when publishTime > ifnull(answerTime,0)
			then publishTime else answerTime end) then  editTime else (case when publishTime > ifnull(answerTime,0)
			then publishTime else answerTime end) end) as time from t_ask group by id order by time desc";
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
	public function queryAllAskByNewest(){
		$sql="select id,title,content,zan,cai,viewCount,uid, acceptid,publishTime from t_ask group by id order by publishTime desc";
		return $this->sort($sql);
	}
	
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
		$u=D('Userinfo');
		$ans=D('Answer');
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