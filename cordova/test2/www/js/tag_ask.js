// $(function(){
//     var tid=null;
//       $(document).on('touchstart','a.tid',function(e){
//          tid=e.target.dataset.tid;
//          $(window).one("pageLoadComplete",function() {//加载问题详情模版
//             $(".tag-ask").load('tpl/card.html',function(){
//               $.ajax({
//                 type:'post',
//                 url:"http://localhost/knowhow/Home/Ask/showOneAskInfo?aid="+tid,
//                 success:function(data){
//                   var source=$("#askinfotmp").html();
//                   if(source!=null){
//                     var tmp=Handlebars.compile(source);
//                     var rs=tmp(data);
//                     $(".askinfo_list").html(rs); 
//                   }
//                 }
//               })
//             }); 
//       })
//   })
// })