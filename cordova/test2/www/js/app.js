var tab='newest';
var page=1;
var sort='hot';
$(function($){
      var myinfo=JSON.parse(localStorage.getItem('myInfo'));
      if(myinfo){
        if(myinfo[0].id){
          $('.load_reg').css('color','red');
        }
      }
      
      $(".bar-header-secondary").load("tpl/question_secbar.html");
      $('.panel_popup').load('tpl/popup_s_a.html');
      load_panel();
      getPop()
      $('.content').load('tpl/home-content.html',function(){home_load()})  
      $(document).on("touchstart", ".tab-item", function() {
        if($(this).hasClass('tag')){
            $(".bar-header-secondary").removeClass('hide').load("tpl/tag_bar.html");
            $('.top-title').text('所有标签');
            $(".open-popup").removeClass('hide');
            // $.get("tpl/popup_s_a.html",function(data){
            //   $('.page-group').after(data);
            // });
            // $('.panel_popup').load('tpl/popup_s_a.html');
            getPop()
            $('.content').load('tpl/tags.html',function(){
                tag_load()
            });
            load_panel()
          }else if($(this).hasClass('home')){
            $(".bar-header-secondary").removeClass('hide').load("tpl/question_secbar.html");
            $(".open-popup").removeClass('hide');
            $('.top-title').text('所有问题');
            $('.content').load('tpl/home-content.html',function(){
               home_load()
            })
            load_panel()
          }else if($(this).hasClass('person')){
            $('.top-title').text('个人中心');
            $('.panel_popup').load('tpl/popup_s_a.html');
            $(".bar-header-secondary,.open-popup").addClass('hide');
            if(myinfo){
              $('.content').load('tpl/person.html');
            }else{
              $('.content').load('tpl/nothing.html');
            }
            getPop()
            load_panel()
          }
          $('.tab-item').removeClass("active");
          $(this).addClass('active');
      });  
      // $(document).on('touchstart','.load_reg',function(){
      //   $('.reg_log').load('tpl/log.html');
      // })


        function page_dis(total,opt){
          var flag=true;
          var fl=true;
          $(".ask_tab.active .pagination,.one_tag.active .pagination").pagination(total, {
                    num_edge_entries: 1, //边缘页数
                    num_display_entries: 4, //主体页数
                    callback: opt==2?tagPageCallback:homePageCallback,
                    items_per_page:5 //每页显示1项
                  });
          function tagPageCallback(item){
            page=parseInt(item)+1;
              if(sort=='hot'){
                if(page==1 && fl){
                   fl=false;
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


      $(document).on('touchstart',".pagination>a",function(e){
            if($(e.currentTarget).text()!='Next' && $(e.currentTarget).text()!='Prev'){
              page=$(e.currentTarget).text();
              $(".tab.active .pagination a").removeClass('current');
              $(e.currentTarget).addClass('current');
               if($(e.currentTarget).text()=='1'){
                $('.tab.active .pagination a.prev').addClass('current');
                $('.tab.active .pagination a.next').removeClass('current');
              }
              if($(e.currentTarget).next('a').hasClass('next')){
                $('.tab.active .pagination a.next').addClass('current');
                $('.tab.active .pagination a.prev').removeClass('current');
              }
            } else if($(e.currentTarget).hasClass('next')){

                if($(e.currentTarget).hasClass('current')){
                  return false;
                }else{
                  $('.tab.active .pagination a.current').next('a').addClass('current');
                  $('.tab.active .pagination a.current').eq(0).removeClass('current')
                  if($('.tab.active .pagination a.current').next('a').hasClass('next')){
                    $('.tab.active .pagination a.current').next('a').addClass('current');
                    $('.tab.active .pagination a.prev').removeClass('current');
                  }
                  if($('.tab.active .pagination a.current').text()=='1'){
                    $('.tab.active .pagination a.current').eq(0).removeClass('current');
                  }
                }
                if(typeof (parseInt($('a.current').text())) !='number'){
                  page=parseInt($('.tab.active .pagination a.current').eq(1).text());
                }else{
                   page=parseInt($('.tab.active .pagination a.current').text());
                }
            }else if( $(e.currentTarget).hasClass('prev') ){

              if($(e.currentTarget).hasClass('current')){
                  return false;
                }else{
                  $('.tab.active .pagination a.current').prev('a').addClass('current');
                  $('.tab.active .pagination a.current').eq(1).removeClass('current')
                  if($('.tab.active .pagination a.current').next('a').next('a').hasClass('next')){
                    $('.tab.active .pagination a.current').next('a').next('a').removeClass('current')
                  }
                  if($('.tab.active .pagination a.current').prev('a').hasClass('prev')){
                    $('.tab.active .pagination a.current').prev('a').addClass('current');
                    $('.tab.active .pagination a.next').removeClass('current');
                  }
                    if(isNaN(parseInt($('.tab.active .pagination a.current').text()))){
                      page=1;
                    }else{
                       page=parseInt($('.tab.active .pagination a.current').text());
                    }
                }
            }
            ajax_load(page);
      })
      function ajax_load(p){
          page=p;
        if($('.tab-item.active').hasClass('home')){
          if($('.bar-header-secondary .tab-link.active').hasClass('newest')){
            tab='newest';
            $(".page #tab1>.content-block").load("tpl/card.html")
          }else if($('.bar-header-secondary .tab-link.active').hasClass('frequent')){
            tab='frequent';
            $(".page #tab1>.content-block").load("tpl/card.html")
          }else if($('.bar-header-secondary .tab-link.active').hasClass('act')){
            tab='act';
            $(".page #tab3>.content-block").load("tpl/card.html")
          }else if($('.bar-header-secondary .tab-link.active').hasClass('votes')){
            tab='votes';
            $(".page #tab4>.content-block").load("tpl/card.html")
          } 
        }else if($('.tab-item.active').hasClass('tag')) {
             if($('.bar-header-secondary .tab-link.active').hasClass('hot')){
              sort='hot'
              $(".page #tab1>.list-block").load("tpl/tag_list.html")
            }else if($('.bar-header-secondary .tab-link.active').hasClass('newest')){
              sort='newest';
              $(".page #tab1>.list-block").load("tpl/tag_list.html")
            }else if($('.bar-header-secondary .tab-link.active').hasClass('word')){
              sort='word';
              $(".page #tab3>.list-block").load("tpl/tag_list.html")
            }
        }
      }
      //标签页面内容加载
       function tag_load(){
        page=1
        $('#tab1>.list-block').load('tpl/tag_list.html',function(){
                $(document).one('touchmove','.list-block',function(){
                   page_dis($('#total').text(),2)
               })
        });
        $(document).on('touchstart','.bar-header-secondary a',function(e){
            if( $(e.currentTarget).hasClass('newest') ){
                  sort='newest';
              $("#tab2>.list-block").load("tpl/tag_list.html",function(){
                page_dis($('#total').text(),2)
              });
            }else  if( $(e.currentTarget).hasClass('hot') ){
              sort='hot';
              $("#tab1>.list-block").load("tpl/tag_list.html",function(){
                  page_dis($('#total').text(),2)
              });
            }else  if( $(e.currentTarget).hasClass('word') ){
              sort='word';
              $("#tab3>.list-block").load("tpl/tag_list.html",function(){
                page_dis($('#total').text(),2)
              }); 
            }
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
                  page_dis($('.total').eq(1).text(),1);
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
      function load_panel(){
        $.get("tpl/panel.html",function(data){
        $('.page-group').after(data);  
        var rs=JSON.parse(localStorage.getItem("userInfo"));
        if(myinfo){
          if(myinfo[0].id){

            $('#panel-right-demo').load("tpl/login.html")
          }
        }else{
          $('#panel-right-demo').load("tpl/unlog.html")
    }})
      }
      function getPop(){
      $.get("tpl/popup_s_a.html",function(data){
        $('.page-group').after(data);
      });
      }
  $('.panel_popup').load('tpl/popup_s_a.html');
  $(document).on("pageLoadComplete",function() {//加载问题详情模版
      $(".askinfo_list").load('tpl/askinfo_tmp.html',function(){
        askinfoAjax(aid);
      });
    });
  $(document).on('touchend','label.label-switch',function(){
      if($('label.label-switch>input').prop('checked')){
          $('.reward').removeClass('hide');
      }else{
        $('.reward').addClass('hide');
      }
  })           
})
