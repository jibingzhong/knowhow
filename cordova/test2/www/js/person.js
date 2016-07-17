$(function($){
	function getUid(name){
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");  
        var r = window.location.search.substr(1).match(reg);  
        if (r != null) return unescape(r[2]);  
        return null; 
	}
	var userid=getUid('userid');
	
	var userInfo=JSON.parse(localStorage.getItem('uerInfo'));
	if(userInfo&&userInfo[0].id==userid){
		$('.content').load('tpl/home_page_tmp.html',function(){
					var source=$('#home_page_tmp').html();
					var hand=Handlebars.compile(source);
					var html=hand(userInfo);
					$('.content').html(html);	
				})
	}else{
		$.ajax({
			type:'post',
			url:'http://localhost/knowhow/index.php/Home/User/showOneUser?userid='+userid,
			success:function(data){
				console.log(data)
				$('.content').load('tpl/home_page_tmp.html',function(){
					var source=$('#home_page_tmp').html();
					var hand=Handlebars.compile(source);
					var html=hand(data);
					$('.content').html(html);	
				})
				localStorage.setItem('uerInfo',JSON.stringify(data));
			}
		})
	}
	// var userInfo=JSON.parse(localStorage.getItem('uerInfo'))
})