$(function(){
    var myinfo=JSON.parse(localStorage.getItem('myInfo'));
    var aid=null;
      $(document).on('touchstart','a.aid',function(e){
         aid=e.target.dataset.aid;
         $(window).one("pageLoadComplete",function() {//加载问题详情模版
            $(".askinfo_list").load('tpl/askinfo_tmp.html',function(){
              $.ajax({
                type:'post',
                url:"http://localhost/knowhow/index.php/Home/Ask/showOneAskInfo?aid="+aid,
                success:function(data){
                  var source=$("#askinfotmp").html();
                  if(source!=null){
                    var tmp=Handlebars.compile(source);
                    var rs=tmp(data);
                    $(".askinfo_list").html(rs); 
                  }
                }
              })
            }); 
      })
  })

      opt('.askopt',1);
      opt('.ansopt',2);
      //问题 回复zan cai的Ajax
      function opt(t,p){ 
        $(document).on('touchstart',t,function(e){
          if(myinfo){
          var opt='';
          var url=null;
          if($(e.target).hasClass('zan')){
            opt='up';
          }else if($(e.target).hasClass('cai')){
            opt='down';
          }
          if(p==1){
            url='http://localhost/knowhow/Home/Ask/up_down?aid='+aid+'&opt='+opt;
          }else if(p==2){
            var ansid=($(e.currentTarget).parent())[0].dataset.ansid;
            url='http://localhost/knowhow/Home/Answer/up_down?aid='+aid+'&ansid='+ansid+'&opt='+opt;
          }
              $.ajax({
                type:'post',
                url:url,
                success:function(data){
                  if(data){
                    var zan=parseInt($(e.target).next().text())+1
                    $(e.target).next().text(zan);
                  }
                  $.toast('+1',2000,'up')
                },
                error:function(data,status){
                    if(status=='error'){
                      $.toast("您已经对该问题进行了操作,不能再次操作");
                    }
                }
              })
        }else{
          $.toast('请登录后再操作')
        }
      })
      }
      //回复 
      $(document).on('touchstart','.open-ans',function(){
          if(!myinfo){
            $.toast('请等录后再操作');
            $('.open-ans').removeClass('open-popup');
            return false;
          }
      })
      $(document).on('touchstart','.addAnswer',function(){
        if(myinfo){
        var val=$('#answer').val();
        $.ajax({
          type:'post',
          url:"http://localhost/index.php/knowhow/Home/Answer/addAnswer",
          data:{
            content:val,
            askid:aid
          },
          success:function(data){
              $.get('tpl/oneans.html',function(res){
                  var s=Handlebars.compile(res);
                  var rs=s(data);
                  var num=parseInt($('.ansnum').text())+1;
                  $('.anslist').prepend(rs);
                  $('.ansnum').text(num);
                  $('#answer').val('');
              })
          }
        })
      }else{
        $.toast('请登录后再操作');
        return false;
      }
    })
})
