var tsort='';
var p='';
var tid=null;
$(function(){    
      tsort='newest';
      p=1;
      $(document).on('touchstart','a.tid',function(e){
         tid=e.target.dataset.tid;
         var num=($(e.target).next())[0].dataset.asknum;
         tagname=$(e.target).text(); 
         $(window).one("pageLoadComplete",function() {//加载问题详情模版
         	$('.tagname').text(tagname);
            $(".tag_tab.active .card-container").load('tpl/tag-asks.html',function(){
              $.ajax({
                type:'post',
                url:"http://localhost/knowhow/index.php/Home/Ask/showAllAsksByTag?tsort="+tsort+"&tid="+tid+"&page="+p,
                success:function(data){
                  console.log(data);
                   var source=$("#tag-asks-tpl").html();
                  if(source!=null){
                    var tmp=Handlebars.compile(source);
                    var rs=tmp(data);
                    $(".tag_tab.active .card-container").html(rs); 
                  }
                  if(num>5){
                    page_dis(num);
                  }
                }
              })
            }); 
      })
  })
       function page_dis(total){
          var flag=true;
          $(".tag_tab.active .pagination").pagination(total, {
                    num_edge_entries: 1, //边缘页数
                    num_display_entries: 4, //主体页数
                    callback: tagasksCallback,
                    items_per_page:5 //每页显示1项
                  })
                  function tagasksCallback(index){
                      p=index+1
                      $(".tag_tab.active .card-container").load('tpl/tag-asks.html',function(){
                      $.ajax({
                        type:'post',
                        url:"http://localhost/knowhow/index.php/Home/Ask/showAllAsksByTag?tsort="+tsort+"&tid="+tid+"&page="+p,
                        success:function(data){
                          console.log(data);
                           var source=$("#tag-asks-tpl").html();
                          if(source!=null){
                            var tmp=Handlebars.compile(source);
                            var rs=tmp(data);
                            $(".tag_tab.active .card-container").html(rs); 
                          }
                        }
                      })
                    });
                  }
        }
    })
