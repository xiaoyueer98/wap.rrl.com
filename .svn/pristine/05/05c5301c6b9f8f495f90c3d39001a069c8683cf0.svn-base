document.addEventListener("touchmove", function (e) {e.preventDefault();}, false);
window.onload = function(){
    setTimeout(function(){
        var myScroll1 = new IScroll('.wap', {mouseWheel: true, click: true});
        var myScroll2 = new IScroll('#c', {mouseWheel: true, click: true});
        var myScroll3 = new IScroll('#m', {mouseWheel: true, click: true});
        var myScroll4 = new IScroll('#cn1', {mouseWheel: true, click: true});
        var myScroll5 = new IScroll('#cn2', {mouseWheel: true, click: true});
        var myScroll6 = new IScroll('#cn3', {mouseWheel: true, click: true});
        var myScroll7 = new IScroll('.xy_scrol2', {mouseWheel: true, click: true});
        var myScroll8 = new IScroll('.xy_scrol1', {mouseWheel: true, click: true});
        var myScroll9 = new IScroll('.ys', {mouseWheel: true, click: true});
        var myScroll9 = new IScroll('.ys2', {mouseWheel: true, click: true});
    },200)
};
$(document).ready(function(){
    /*-------------slider-------------*/
    // $('#slider').slider({
    //     loop:true,
    //     showArr:false,
    //     showDot:true,
    //     imgZoom:true
    // });
    /*---------侧边栏滑动效果----------*/
    $('.headder>.nav_btn').click(function(){
        if($(this).hasClass("current")){
            $('.index_con').animate({translate: '0,0'},300);
            $('.left_nav').animate({translate: '-100%,0'},300)
            $(this).removeClass("current");
        }else{
            $('.index_con').animate({translate: '70%,0'},300);
            $('.left_nav').animate({translate: '0,0'},300)
            $(this).addClass("current");
        };
    });

    //定义兼容各终端单击事件
    var evt = $.os.phone ? "tap" : "click";

    $(".wap2 nav li").on('click',function(){
        $(this).addClass('m').siblings().removeClass('m');
        var index1 = $( this ).index();
        $( '.wap2 .dis_none' ).eq(index1).show().siblings('.dis_none').hide();
        $(window).resize();
    });

    $(".wap4 nav li").on('click',function(){
        $(this).addClass('m').siblings().removeClass('m');
        var index1 = $( this ).index();
        $( '.wap4 .aa' ).eq(index1).show().siblings('.aa').hide();
        $(window).resize();
        
    });

    $( '#c ul li' ).on( 'click', function(){
        var index = $( this ).index();
        $(this).css({'background':'#f6f7f7'}).siblings().css({'background':'#ffffff'})
        $( '.index_con .date_wap' ).eq(index).animate({translate: '0,0'},10).siblings('.date_wap').animate({translate: '-100%,0'},10);
        $('.index_con').animate({translate: '0,0'},300);
        $('.left_nav').animate({translate: '-100%,0'},300);
        $('.headder>.nav_btn').removeClass("current");
        var myScroll6 = new IScroll('#m', {mouseWheel: true, click: true, useTransform:true});
    });

    /*----------------Touch事件---------------*/
    $('.index_con').swipeRight(function(){
        $('.index_con').animate({translate: '70%,0'},300);
        $('.left_nav').animate({translate: '0,0'},300);
    });
    $('.index_con').swipeLeft(function(){
         $('.index_con').animate({translate: '0,0'},300);
        $('.left_nav').animate({translate: '-100%,0'},300);
    });
    $('.left_nav').swipeLeft(function(){
         $('.index_con').animate({translate: '0,0'},300);
        $('.left_nav').animate({translate: '-100%,0'},300);
    });
})

