
$(function () {
    var windowWidth = $(window).width();

    $("a[link*='http://']:not([link*='" + location.hostname + "'])").attr("target", "_blank");

    /* 菜单栏点击切换 */
    $("#navBtn").click(function () {
        var left = $("#navigation").offset().left;
        if (left == 0) {
            menuToggle("hide");
        } else {
            menuToggle("show");
        }
    });
    //小屏下点击菜单 菜单隐藏
    if (windowWidth <= 768) {
        $("#navigation").click(function () {
            menuToggle("hide");
        })
    }

    /* 定位锚点 */
    $("#navigation li").click(function(){
        var dataPathname = $(this).attr("data-pathname");
        if(dataPathname){
            window.location.href = "/#"+dataPathname;
            scrollAnimate(dataPathname);
            if (windowWidth <= 768) {
                menuToggle("hide");
            }
            return false
        }
    });

    var listMenu = $("#listMenu").length;
    if(listMenu>0){
        //初始化菜单高亮
        $("#listMenu li").eq(0).addClass("highlight");
        //初始设置菜单是否浮动
        setMenuFiexd();
        $(window).scroll(function(event){
            setMenuFiexd();
        })
    }
    //返回顶部按钮
    backTopToggle();
    $(window).scroll(function(event){
        backTopToggle();
    })
    $(".backTop").click(function(){
        $("html,body").animate({scrollTop: 0},500);
    })
})

//滚动条动画
function scrollAnimate(className){
    if(!className){return false};
    var $target = $("."+className);
    if($target.length>0){
        var targetOffset = $target.offset().top-150;
        $('html,body').animate({scrollTop: targetOffset},500);
    }
}

//菜单效果
function menuToggle(type) {
    if (type == "hide") {
        $("#navigation").animate({
            left: "100%"
        }, 300);
    } else {
        $("#navigation").animate({
            left: 0
        }, 300);
    }
}

//listMenu浮动函数
function setMenuFiexd (){
    var top = $(".hasMenu").offset().top;
    var scrollTop = $(window).scrollTop();
    if(top-scrollTop<=0){
        $("#listMenu").addClass("headerFiexd");
    }else{
        $("#listMenu").removeClass("headerFiexd");
    }
}

//滚动条滚动设置listMenu高亮
function menuHighlight(){
    var scrollTop = $(window).scrollTop();
    var height = $(window).height()/2;
    $("#listMenu li").each(function(){
        var className = $(this).attr("data-pathname");
        if(className){
            var top = $("."+className).offset().top;
            if(scrollTop>=top-height){
                setMenuHighLight($(this));
            }
        }
    })
}
//设置listMenu高亮
function setMenuHighLight(obj){
    $("#listMenu li").removeClass("highlight");
    obj.addClass("highlight");
}
//返回按钮显示隐藏
function backTopToggle(){
    var scrollTop = $(window).scrollTop();
    if(scrollTop>=200){
        $(".backTop").show();
    }else{
        $(".backTop").hide();
    }
}