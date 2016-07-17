var tab='newest';
var page=1;
var sort='hot';
$(function($){

      $(".bar-header-secondary").load("tpl/question_secbar.html");
      $('.content').load('tpl/home-content.html',function(){home_load()})  
      $(document).on("touchstart", ".tab-item", function() {
        if($(this).hasClass('tag')){
            $(".bar-header-secondary").load("tpl/tag_bar.html");
            $('.top-title').text('所有标签');
            $('.content').load('tpl/tags.html',function(){
                tag_load()
            });
          }else if($(this).hasClass('home')){
            $(".bar-header-secondary").load("tpl/question_secbar.html");
            $('.top-title').text('所有问题');
            $('.content').load('tpl/home-content.html',function(){
               home_load()
            })
          }
          $('.tab-item').removeClass("active");
          $(this).addClass('active');
      });  



        function page_dis(total,opt){
          var flag=true;
          $(".active .pagination").pagination(total, {
                    num_edge_entries: 1, //边缘页数
                    num_display_entries: 4, //主体页数
                    callback: opt==1?homePageCallback:tagPageCallback,
                    items_per_page:5 //每页显示1项
                  });
          function tagPageCallback(item){
            page=parseInt(item)+1;
              if(sort=='hot'){
                if(page==1&&flag){
                   flag=false;
                  return false;
                }else{
                $("#tab1>.list-block").load("tpl/tag_list.html");
                }
              }else if (sort=='newest') {
                $("#tab2>.list-block").load("tpl/tag_list.html");
              }else if(sort=="word"){
                $("#tab3>.list-block").load("tpl/tag_list.html");
              }
          }
          function homePageCallback(item){
            page=parseInt(item)+1;
              if(tab=='newest'){
                if(page==1&&flag){
                   flag=false;
                  return false;
                }else{
                  $("#tab1>.content-block").load("tpl/card.html");
                }
              }else if (tab=='frequent') {
                $("#tab2>.content-block").load("tpl/card.html");
              }else if(tab=="act"){
                $("#tab3>.content-block").load("tpl/card.html");
              }else if(tab=="votes"){
                $("#tab4>.content-block").load("tpl/card.html");
              }
          }
      }


      
      //标签页面内容加载
       function tag_load(){
        $('#tab1>.list-block').load('tpl/tag_list.html',function(){
                $(document).one('touchstart',function(){
                page_dis($('#total').text(),2)
            })
        });
        
        $('.bar-header-secondary .hot').on("touchstart",function(){
           sort='hot';
              $("#tab1>.list-block").load("tpl/tag_list.html",function(){
                  page_dis($('#total').text(),2)
              });
        })
        $('.bar-header-secondary .newest').on("touchstart",function(){
          sort='newest';
          $("#tab2>.list-block").load("tpl/tag_list.html",function(){
            page_dis($('#total').text(),2)
          });
        })
        $('.bar-header-secondary .word').on("touchstart",function(){
          sort='word';
          $("#tab3>.list-block").load("tpl/tag_list.html",function(){
            page_dis($('#total').text(),2)
        });
          
        })
      }
      //home页面内容加载

      function home_load(){
        

         $("#tab1>.content-block").load("tpl/card.html",function(){
            $("#tab1>.content-block").one('touchstart',function(){
                page_dis($('.total').eq(1).text(),1)             
            })
         })
        
         $(document).on('touchstart','.bar-header-secondary a',function(e){
           if( $(e.currentTarget).hasClass('newest') ){
              tab='newest';
              $("#tab1>.content-block").load("tpl/card.html",function(){
                  page_dis($('.total').eq(1).text(),1)
              });
            }else if( $(e.currentTarget).hasClass('frequent') ){
                 tab='frequent';
                 $("#tab2>.content-block").load("tpl/card.html",function(){
                    page_dis($('.total').eq(1).text(),1)
                  });
            }else if( $(e.currentTarget).hasClass('act') ){
                  tab='act';
              $("#tab3>.content-block").load("tpl/card.html",function(){
                  page_dis($('.total').eq(1).text(),1)
                });
            }else if( $(e.currentTarget).hasClass('votes') ){
                tab='votes';
                $("#tab4>.content-block").load("tpl/card.html",function(){
                  page_dis($('.total').eq(1).text(),1)
                });
            }
        })
      }
      
      $.get("tpl/panel.html",function(data){
        $('.page-group').after(data);  
        var rs=JSON.parse(localStorage.getItem("userInfo"));
        if(rs != undefined && rs.loginStatus==true){
            $('#panel-right-demo').load("tpl/login.html")
        }else{
          $('#panel-right-demo').load("tpl/unlog.html")
    }})
      $.get("tpl/popup_s_a.html",function(data){$('.page-group').after(data);});

  $(document).on("pageLoadComplete",function() {//加载问题详情模版
      $(".askinfo_list").load('tpl/askinfo_tmp.html',function(){
        askinfoAjax(aid);
      });
    });

})